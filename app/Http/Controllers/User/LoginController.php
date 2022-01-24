<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email', 'password'), $request->remmember)) {
            return response()->json(['message' => 'Invalid user credentials'], 403);
        }
        $user = User::where(['email' => $request->email])->first();
        $user->tokens()->delete();
        $token = $user->createToken('user_token')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function currentUser(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }

    public function dashboard() 
    {
        $blogs = Blog::where(['category' => 'blog'])->count();
        $artworks = Blog::where(['category' => 'artwork'])->count();
        $projects = Project::count();
        return response()->json([
            'blogs' => $blogs,
            'artworks' => $artworks,
            'projects' => $projects
        ]);
    }

    public function updateUser(Request $request)
    {
        $user = $request->user();
        $user->update($request->all());
        return response()->json(['user' => $user]);
    }

    public function resetPassword(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if(Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
            return response()->json(['message' => 'Password updated']);
        } else {
            return response()->json(['message' => 'Invalid user password'], 422);
        }
    }
}
