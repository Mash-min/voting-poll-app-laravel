<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Invalid user credentials']);
        }

        $user = User::where('username', $request->username)->first();
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
