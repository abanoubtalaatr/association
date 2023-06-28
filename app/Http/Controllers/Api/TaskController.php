<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(Task $task)
    {
        if (auth('api-users')->user()->task_level == 0) {
            auth('api-users')->user()->update(['task_level' => 1]);
        }
        return new UserResource(auth('api-users')->user());
    }
}
