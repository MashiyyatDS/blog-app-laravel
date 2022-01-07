<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{

    public function create(Request $request)
    {
        $blog = Blog::create($request->all());
        return response()->json(['blog' => $blog]);
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        return response()->json(['message' => 'Blog deleted']);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());
        return response()->json(['blog' => $blog]);
    }

    public function find($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json(['blog' => $blog]);
    }

    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->paginate(12);
        return response()->json(['blogs' => $blogs]);
    }

}
