<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTasks(): JsonResponse
    {
        $tasks = Task::oldest()->paginate(10);

        return response()->json($tasks);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
        ]);
        $task = Task::create($validated);
        
        if(!$task->id){
            return response()->json([
                'status'  => 'error',
                'message' => 'Problem creating task',
                'data'    => $validated 
            ], 500);
        }

       return response()->json([
            'status'  => 'success',
            'message' => 'Created successfully!',
            'data'    => $task 
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
}
