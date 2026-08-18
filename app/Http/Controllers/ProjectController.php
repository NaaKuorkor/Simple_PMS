<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    //Show all projects
    public function index()
    {
        $projects = Project::all();

        return view('main', compact('projects'));
    }

    //Show form to create project
    public function create()
    {
        $project = new Project();

        return view('projects.project_form', compact('project'));
    }

    //Save data of a new project
    public function store(Request $request)
    {

        try {
            $deets = $request->validate([
                'project_title' => 'string|required',
                'description' => 'string|nullable',
                'start_date' => 'date|required',
                'end_date' => 'date|required',
                'status' => 'string|required'
            ]);

            $user_id = Auth::user()->user_id;

            $project_id = 'PR' . rand(100, 999);

            Project::create([
                'project_id' => $project_id,
                'user_id' => $user_id,
                'project_title' => $deets['project_title'],
                'description' => $deets['description'],
                'start_date' => $deets['start_date'],
                'end_date' => $deets['end_date'],
                'status' => $deets['status'],
                'createuser' => Auth::user()->email,
                'createdate' => now(),
                'modifyuser' => Auth::user()->email,
                'modifydate' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Project created successfully!'
            ]);
        } catch (Exception $e) {
            Log::error('Failed to create a new project', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Project creation failed'
            ]);
        }
    }

    //Show a particular project
    public function show(Project $project)
    {
        return view('projects.project_form', compact('project'));
    }

    //How view for editing a record
    public function edit(Project $project)
    {
        return view('projects.project_form', compact('project'));
    }

    //Save edit made to a project
    public function update(Request $request, Project $project)
    {
        try {
            $deets = $request->validate([
                'project_title' => 'string|required',
                'description' => 'string|nullable',
                'start_date' => 'date|required',
                'end_date' => 'date|required|after_or_equal:start_date',
                'status' => 'string|required'
            ]);


            $project->update($deets);

            return response()->json([
                'status' => 'success',
                'message' => 'Project successfully updated'
            ]);
        } catch (Exception $e) {
            Log::error('Failed to update project details', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Project update failed'
            ]);
        }
    }

    //Delete a project
    public function destroy(Project $project)
    {
        try {
            $project->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Project deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Deletion failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Deletion failed!'
            ]);
        }
    }
}
