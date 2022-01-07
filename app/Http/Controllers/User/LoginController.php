<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
