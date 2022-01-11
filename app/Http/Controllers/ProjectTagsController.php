<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTag;
use App\Models\Project;

class ProjectTagsController extends Controller
{
    public function create(Request $request)
    {
        foreach($request->tags as $tag)
        {
            $tag = ProjectTag::create([
                'tag' => $tag,
                'project_id' => $request->project_id
            ]);
        }
        return response()->json(['message' => 'Project tags addded']);
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->tags()->delete();
        foreach($request->tags as $tag) 
        {
            $tag = ProjectTag::create([
                'tag' => $tag,
                'project_id' => $id
            ]);
        }
        return response()->json(['message' => 'Project tags updated']);
    }
}
