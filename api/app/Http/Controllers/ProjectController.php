<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{

    public function index(): JsonResponse
    {
        $projects = Project::with('tasks')->get();

        return response()->json(
            [
                'code' => 0,
                'data' => $projects
            ]
        );
    }

    public function store(ProjectRequest $request): JsonResponse
    {
        $project = Project::create($request->validated());

        return response()->json(
            [
                'code' => 0,
                'data' => $project,
                'validation_errors' => []
            ],205
        );
    }

    public function show(Project $project): JsonResponse
    {
        return response()->json(
            [
                'code' => 0,
                'data' => $project
            ]
        );
    }


    public function update(ProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->validated());

        return response()->json(
            [
                'code' => 0,
                'data' => $project,
                'validation_errors' => []
            ]
        );
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->tasks()->delete();
        $project->delete();

        return response()->json(
            [
                'code' => 0,
                'data' => null,
                'validation_errors' => []
            ]
        );
    }
}
