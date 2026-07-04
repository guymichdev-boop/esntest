<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function getTasks(Request $request): JsonResponse
    {
        if($request->has('filter') && $request->query('filter') != 'all'){
            $tasks = Task::oldest()
            ->where('is_completed', '=', $request->query('filter'))
            ->get();
        }else{
            $tasks = Task::oldest()->get();
        }

        return response()->json(['data' => $tasks]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:tasks,title',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $task = Task::create($validator->validated());

        return response()->json([
            'data' => $task
        ], 201);
    }

    public function toggle(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'is_completed' => 'required|boolean'
        ]);

        $task->update([
            'is_completed' => $validated['is_completed']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Task status updated successfully!'
        ]);
    }

    public function destroy(Task $task): JsonResponse 
    {
       $deleted = $task->delete();

        if ($deleted) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Deleted successfully',
            ], 200);
        }

        return response()->json([
                'status'  => 'error',
                'message' => 'Failed to delete task',
            ], 500);
    }

    public function update(Request $request, Task $task): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $updated = $task->update($validated);

        if ($updated) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Task updated successfully',
            ], 200);
        }

        return response()->json([
            'status'  => 'error',
            'message' => 'Failed to update task',
        ], 500);
    }
}
