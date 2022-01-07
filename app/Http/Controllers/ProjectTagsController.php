<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTag;

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
}
