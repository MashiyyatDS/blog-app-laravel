<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tags;
use App\Models\Blog;

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

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->tags()->delete();
        foreach($request->tags as $tag)
        {
            $tag = Tags::create([
                'tag' => $tag,
                'blog_id' => $blog->id
            ]);
        }
        return response()->json(['message' => 'Blog tags updated']);
    }
}
