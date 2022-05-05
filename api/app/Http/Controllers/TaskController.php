<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::with('project')->get();

        return response()->json(
            [
                'code' => 0,
                'data' => $tasks
            ]
        );
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        return response()->json(
            [
                'code' => 0,
                'data' => $task,
                'validation_errors' => []
            ]
        );
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json(
            [
                'code' => 0,
                'data' => $task
            ]
        );
    }


    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json(
            [
                'code' => 0,
                'data' => $task,
                'validation_errors' => []
            ]
        );
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json(
            [
                'code' => 0,
                'data' => null,
                'validation_errors' => []
            ]
        );
    }
}
