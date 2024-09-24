<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone_number' => 'required|string|max:15|unique:users,phone_number',
                'password' => 'required|string|min:8',
                'gender' => 'sometimes|nullable|string',
            ]);
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone_number' => $validated['phone_number'],
                'gender' => $validated['gender'],
                'password' => Hash::make($validated['password']),
            ]);
            return response()->json(['success' => true, 'message' => 'User registered successfully', 'data' => $user], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors occurred',
                'errors' => $e->validator->errors(), // Return the errors
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        if ($request->user()->status == 'inactive'){
            return response()->json(['message' => 'Inactive Account'], 403);
        }


        $token = $request->user()->createToken('api_token')->plainTextToken;
        $user = auth()->user();
        return response()->json(['token' => $token,'user_details' =>[
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'gender' => $user->gender,
            'status' => $user->status,
        ] ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
