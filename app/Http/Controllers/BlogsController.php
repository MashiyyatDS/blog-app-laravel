<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{

    public function create(Request $request)
    {
        $user = $request->user();
        $blog = Blog::create($request->all() + ['user_id' => $user->id]);
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
        $blog = Blog::with('tags')->findOrFail($id);
        return response()->json(['blog' => $blog]);
    }

    public function blogs($paginate, $category)
    {
        $blogs = Blog::orderBy('created_at', 'DESC')
                     ->where(['category' => $category])
                     ->with('tags')
                     ->with('user')
                     ->paginate($paginate);
        return response()->json(['blogs' => $blogs]);
    }

    public function viewBlog($slug)
    {
        $blog = Blog::with('tags')->where(['slug' => $slug])->first();
        if($blog) {
            return response()->json(['blog' => $blog]);
        } else {
            return response()->json(['message' => 'Blog not found'], 404);
        }
    }

}
