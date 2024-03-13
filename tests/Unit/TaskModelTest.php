<?php

namespace Tests\Unit;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskModelTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public Task $task;
    protected function setUp(): void
    {
        parent::setUp();
        $this->tasks = new Task();
    }

    public function test_task_can_be_created_successfully_with_valid_title()
    {
        $taskTitle = $this->faker->sentence();
        $task = $this->task->createTask($taskTitle);
        $this->assertNotNull($task);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertDatabaseHas('tasks', [
            'title' => $taskTitle,
        ]);
    }
}