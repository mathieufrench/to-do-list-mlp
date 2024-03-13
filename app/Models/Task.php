<?php

namespace App\Models;

use Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public function createTask(
        String $taskTitle
    ): Task|Array|Null
    {

        if (empty($taskTitle)) {
            // Task title cannot be empty
            return null;
        }

        try {
            $task = new Task();
            $task->title = $taskTitle;
            $task->save();
            return $task;
        } catch(\Exception $e){
            // Logging out here, but would trigger a service or something usually for an external logging provider API
            Log::error($e->getMessage());
            return [
                'error' => 'An error occurred while creating the task.'
            ];
        }

    } 
}


