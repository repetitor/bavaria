<?php

namespace App\Virtual;

/**
 * @OA\Schema(
 *  type="object",
 *  title="Todo",
 *  required={"title", "description"}
 * )
 */
class Todo
{
    /**
     * @OA\Property(
     *  title="Title",
     *  example="To visit gym"
     * )
     */
    public string $title;

    /**
     * @OA\Property(
     *  title="Description",
     *  example="To do 3 different excercices"
     * )
     */
    public string $description;
}
