<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // You can create a user for authentication if needed
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_can_display_all_tasks()
    {
        // Create some tasks
        $tasks = Task::factory()->count(5)->create();

        // Simulate GET request to index method
        $response = $this->get(route('tasks.index'));

        // Assert response status
        $response->assertStatus(200);

        // Assert tasks are displayed
        $response->assertSee($tasks->first()->title);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        // Create category for task
        $category = Category::factory()->create();

        // Simulate POST request to store method
        $response = $this->post(route('tasks.store'), [
            'title' => 'Test Task',
            'category_id' => $category->id,
            'description' => 'Test Description',
            'status' => 'pending',
        ]);

        // Assert task is created
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);

        // Assert redirection
        $response->assertRedirect(route('tasks.index'));
    }
}
