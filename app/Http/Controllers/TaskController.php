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

    public function create() {}

    public function show() {}

    public function store(Request $request, $id)
    {

        try {
            $project = Project::where('project_id', $id)->firstOrFail();

            $deets = $request->validate([
                //'project_id' => 'required|string',
                'task_desc' => 'required|string',
                'status' => 'required|string|max:9',
            ]);

            Task::create([
                'project_id' => $project->project_id,
                'task_desc' =>  $deets['task_desc'],
                'status' =>  $deets['status'],
                'createuser' => Auth::user()->email,
                'createdate' => now(),
                'modifyuser' => Auth::user()->email,
                'modifydate' => now(),
            ]);

            return response()->json([]);
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

    public function edit() {}

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

    public function destroy() {}
}
