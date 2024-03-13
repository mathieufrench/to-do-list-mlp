<?php

namespace App\Models;

use Log;
use App\Enum\TaskStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public function allTasksForUser
    (
        User $user
    ): Builder {
        return Task::where('user_id', $user->id)
            ->where('status', '!=', 'removed');
    }

    public function createTask(
        array $form_fields
    ): Task|Array
    {

        try {
            $task = new Task();
            $task->title = $form_fields['task_title'];
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


