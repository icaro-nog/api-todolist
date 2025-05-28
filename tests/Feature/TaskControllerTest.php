<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task as TaskModel;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_task_successfully()
    {
        $taskData = [
            'title' => 'Task Title', // required
            'description' => 'Description Task',
            'status' => 2 // between 1 and 3
        ];

        $response = $this->postJson('/api/task', $taskData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'task' => [
                         'id',
                         'title',
                         'description',
                         'status'
                     ]
                 ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Task Title',
            'description' => 'Description Task',
            'status' => 2
        ]);
    }

    /** @test */
    public function it_creates_a_task_unsuccesfully(){
        
        // Case 1: nothing send
        $response = $this->postJson('/api/task', []);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'The title field is required.',
                     'errors' => [
                         'title' => [
                            "The title field is required."
                         ]
                     ]
                 ]);
                 
        // Case 2: status out of valid range         
        $taskData = [
            'title' => 'Task Title',
            'description' => 'Description Task',
            'status' => 99 // invalid
        ];

        $response = $this->postJson('/api/task', $taskData);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'The status field must be between 1 and 3.',
                     'errors' => [
                         'status' => [
                            "The status field must be between 1 and 3."
                         ]
                     ]
                 ]);
    }

    /** @test */
    public function it_get_tasks_by_status_successfully(){

        // Case 1: search tasks by status
        $statusTask = 2;

        $response = $this->get("/api/tasks/status/{$statusTask}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'tasks' => [
                        '*' => [
                            'id',
                            'title',
                            'description',
                            'status'
                        ]
                     ]
                 ]);
    }

    /** @test */
    public function it_get_tasks_by_status_unsuccesfully(){

        // Case 1: search tasks with status out of valid range 
        $statusTask = 99;

        $response = $this->get("/api/tasks/status/{$statusTask}");

        $response->assertStatus(400)
                 ->assertJson([
                     'error' => 'Invalid status value',
                 ]);
    }

    /** @test */
    public function it_edit_task_successfully(){

        // create task
         $task = TaskModel::factory()->create([
            'title' => 'Title',
            'description' => 'Description',
            'status' => 1,
        ]);

        // Case 1: edit task
        $idTask = 1;

        $response = $this->putJson("/api/task/{$idTask}", [
            'status' => 3
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'task' => [
                        'id',
                        'title',
                        'description',
                        'status'
                     ]
                 ]);
    }

    /** @test */
    public function it_edit_task_unsuccessfully(){

        // create task
         $task = TaskModel::factory()->create([
            'title' => 'Title',
            'description' => 'Description',
            'status' => 1,
        ]);

        // Case 1: invalid id
        $idTask = 99;

        $response = $this->putJson("/api/task/{$idTask}", [
            'status' => 3
        ]);

        $response->assertStatus(404);

        // Case 2: invalid status
        $response = $this->putJson("/api/task/{$task->id}", [
            'status' => 99
        ]);

        $response->assertStatus(422)
                 ->assertJson([
                     'message' => 'The status field must be between 1 and 3.',
                     'errors' => [
                         'status' => [
                            "The status field must be between 1 and 3."
                         ]
                     ]
                 ]);
    }

    /** @test */
    public function it_delete_task_successfully(){

        // create task
         $task = TaskModel::factory()->create([
            'title' => 'Title',
            'description' => 'Description',
            'status' => 1,
        ]);

        // Case 1: delete task with valid id
        $response = $this->delete("/api/task/{$task->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     "message" => "Task deleted successfully."
                 ]);

    }

    /** @test */
    public function it_delete_task_unsuccessfully(){

        // Case 1: delete task with invalid id
        $response = $this->delete("/api/task/99");

        $response->assertStatus(404)
                 ->assertJson([
                     "error" => "Task not found."
                 ]);

    }
}
