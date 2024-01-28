<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    const URI = '/api/todos/';

    public function test_list(): void
    {
        $response = $this->get(self::URI);

        $response->assertStatus(200);
    }

    public function test_save(): void
    {
        $response = $this->postJson(
            self::URI,
            ['title' => 'to play', 'description' => 'football']
        );

        $response->assertStatus(201);
    }

    public function test_show(): void
    {
        $task = $this->postJson(
            self::URI,
            ['title' => 'to play', 'description' => 'football']
        );

        $response = $this->get(self::URI . $task['data']['id']);

        $response->assertStatus(200);
    }

    public function test_delete_success(): void
    {
        $task = $this->postJson(
            self::URI,
            ['title' => 'to play', 'description' => 'football']
        );

        $response = $this->delete(self::URI . $task['data']['id']);

        $response->assertStatus(204);
    }

    public function test_delete_fail(): void
    {
        $response = $this->delete(self::URI . '0');

        $response->assertStatus(404);
    }

    public function test_update(): void
    {
        $task = $this->postJson(
            self::URI,
            ['title' => 'to play', 'description' => 'football']
        );

        $response = $this->patchJson(
            self::URI . $task['data']['id'],
            ['title' => 'to play - update', 'description' => 'football new']
        );

        $response->assertStatus(200);
    }
}
