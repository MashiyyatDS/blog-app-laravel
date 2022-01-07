<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    
    public function create(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json(['project' => $project]);
    }

    public function delete($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Project deleted']);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json(['project' => $project]);
    }

    public function find($id)
    {
        $project = Project::findOrFail($id);
        return response()->json(['project' => $project]);
    }

    public function projects()
    {
        $projects = Project::orderBy('created_at', 'DESC')->paginate(8);
        return response()->json(['projects' => $projects]);
    }


}
