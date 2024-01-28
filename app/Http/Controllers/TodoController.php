<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * List of todoTasks
     *
     * @OA\Get(
     *  path="/api/todos",
     *  tags={"TodoTasks"},
     *
     *  @OA\Parameter(
     *      name="per_page",
     *      in="query",
     *      example="10",
     *      required=false
     *   ),
     *
     *  @OA\Parameter(
     *      name="next_cursor",
     *      in="query",
     *      example="eyJ0b2Rvcy5pZCI6MSwiX3BvaW50c1RvTmV4dEl0ZW1zIjp0cnVlfQ",
     *      required=false
     *   ),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     */
    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $todos = Todo::cursorPaginate(
            perPage: $request->per_page,
            cursor: $request->next_cursor,
        );

        return TodoResource::collection($todos);
    }

    /**
     * Store todoTask
     *
     * @OA\Post (
     *  path="/api/todos",
     *  tags={"TodoTasks"},
     *
     *  @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Todo")),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     */
    public function store(TodoRequest $request): TodoResource
    {
        $todo = Todo::create($request->validated());

        return new TodoResource($todo);
    }

    /**
     * Show todoTask
     *
     * @OA\Get (
     *  path="/api/todos/{id}",
     *  tags={"TodoTasks"},
     *
     *  @OA\Parameter(name="id", in="path", example=1, required=true),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     */
    public function show(Todo $todo): TodoResource
    {
        return new TodoResource($todo);
    }

    /**
     * Update todoTask
     *
     * @OA\Patch (
     *  path="/api/todos/{id}",
     *  tags={"TodoTasks"},
     *
     *  @OA\Parameter(name="id", in="path", example=1, required=true),
     *
     *  @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/Todo")),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     */
    public function update(TodoRequest $request, Todo $todo): TodoResource
    {
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->save();

        return new TodoResource($todo);
    }

    /**
     * Delete todoTask
     *
     * @OA\Delete (
     *  path="/api/todos/{id}",
     *  tags={"TodoTasks"},
     *
     *  @OA\Parameter(name="id", in="path", example=1, required=true),
     *
     *  @OA\Response(response="200", description="OK", @OA\JsonContent()),
     *  @OA\Response(response="default", description="Error", @OA\JsonContent()),
     * )
     */
    public function destroy(Todo $todo): \Illuminate\Http\Response
    {
        if ($todo->delete()) {
            return response()->noContent();
        }

        return response()->noContent(404);
    }
}
