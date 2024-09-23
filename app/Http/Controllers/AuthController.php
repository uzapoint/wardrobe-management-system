<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('authToken')->accessToken;
            return response(['token' => $token], 200);
        } else {
            return response(['error' => 'Unauthenticated'], 401);
        }
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('authToken')->accessToken;
        return response(['token' => $token], 200);
    }

    public function user(Request $request)
    {
        return response(['user' => auth()->user()], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['message' => 'Successfully logged out'], 200);
    }
}
