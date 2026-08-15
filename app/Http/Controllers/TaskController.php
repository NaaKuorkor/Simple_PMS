<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index($project_id)
    {
        $tasks = Task::where('project_id', $project_id);

        return $tasks;
    }

    public function create()
    {
        return view('tasks.task_form');
    }

    /*public function show(Task $task)
    {
        return Task::where('id', $id)->firstOrFail();
    }*/

    public function store(Request $request, Project $project)
    {

        try {

            $deets = $request->validate([

                'task_desc' => 'required|string',
                'status' => 'required|string|max:9',
            ]);

            $project->tasks->create([
                'project_id' => $project->project_id,
                'task_desc' =>  $deets['task_desc'],
                'status' =>  $deets['status'],
                'createuser' => Auth::user()->email,
                'createdate' => now(),
                'modifyuser' => Auth::user()->email,
                'modifydate' => now(),
            ]);

            return response()->json([
                'status' => "success",
                'message' => "Task created successfully"
            ]);
        } catch (Exception $e) {
            Log::error('Task setup failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Task setup failed'
            ]);
        }
    }

    public function edit(Task $task)
    {
        return view('tasks.task_form', compact($task));
    }

    public function update(Request $request, $id)
    {

        try {
            $deets = $request->validate([
                'task_desc' => 'required|string',
                'status' => 'required|string|max:9',
            ]);

            $task = Task::where('id', $id)->firstOrFail();

            $task->update($deets);

            return response()->json([]);
        } catch (Exception $e) {
            Log::error('Task update failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Task deleted successfully!'
            ]);
        } catch (Exception $e) {
            Log::error('Task deletion failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Task deletion failed'
            ]);
        }
    }
}
