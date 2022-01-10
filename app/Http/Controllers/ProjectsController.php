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
        $project = Project::with('tags')->findOrFail($id);
        return response()->json(['project' => $project]);
    }

    public function projects($limit)
    {
        $projects = Project::orderBy('created_at', 'DESC')->with('tags')->with('user')->paginate($limit);
        return response()->json(['projects' => $projects]);
    }

    public function search($name)
    {
        $projects = Project::where('title', 'LIKE' , "%".$name."%")->paginate(5);
        return response()->json(['projects' => $projects]);
    }

    public function viewProject($slug)
    {
        $project = Project::with('tags')->where(['slug' => $slug])->first();
        if($project) {
            return response()->json(['project' => $project]);
        } else {
            return abort(404);
        }
    }

}
