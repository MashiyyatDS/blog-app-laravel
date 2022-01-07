<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;

class TagsController extends Controller
{

    public function create(Request $request)
    {
        foreach($request->tags as $tag) {
            $tag = Tags::create([
                'tag' => $tag,
                'blog_id' => $request->blog_id
            ]);
        }
        return response()->json(['message' => 'Blog Tags added']);
    }
}
