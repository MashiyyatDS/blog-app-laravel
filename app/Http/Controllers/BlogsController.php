<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;

class BlogsController extends Controller
{

    public function create(BlogRequest $request)
    {
        $blog = $request->user()->blogs()->create($request->all());
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
        if($category == "all") {
            $blogs = Blog::orderBy('created_at', 'DESC')
                         ->with('tags')
                         ->with('user')
                         ->paginate($paginate);
            return response()->json([
                'blogs' => $blogs,
                'blogCount' => Blog::count()
            ]);
        }else {
            $blogs = Blog::orderBy('created_at', 'DESC')
                         ->where(['category' => $category])
                         ->with('tags')
                         ->with('user')
                         ->paginate($paginate);
            return response()->json(['blogs' => $blogs]);
        }
    }

    public function viewBlog($slug)
    {
        $blog = Blog::with('user')->with('tags')->where(['slug' => $slug])->first();
        if($blog) {
            return response()->json(['blog' => $blog]);
        } else {
            return response()->json(['message' => 'Blog not found'], 404);
        }
    }

}
