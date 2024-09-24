<?php

// app/Http/Controllers/API/AuthController.php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailNotification;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Authenticate the user
        Auth::login($user);

        // Generate a personal access token
        $token = $user->createToken('registerToken');
        $accessToken = $token->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'token' => $accessToken,
        ], 201);
    }

    /**
     * Login a user.
     */    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
        
        $credentials = $request->only('email', 'password');

        // Check if the email exists in the database
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials'], status: 401);
        }

        // Generate a personal access token
        $token = $user->createToken('loginToken');
        $accessToken = $token->plainTextToken;

        // If both email and password are correct, generate an API token
        return response()->json(['success' => true, 'user' => $user->only('name', 'email'), 'token' => $accessToken, 'message' => 'User logged in successfully'], 200);
    }
    

    /**
     * Logout a user.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['success' => true, 'message' => 'Logged out successfully']);
    }

    /**
     * Send password reset link to the user's email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(rules: ['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);
            Mail::to($user->email)->send(new EmailNotification($token));
            return response()->json(['success' => true, 'message' => 'Password reset link sent']);
        }

        return response()->json(['success' => false, 'message' => 'Email not found'], 404);
    }

        /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email not found'], 404);
        }

        // Assuming token validation logic is implemented
        // Here you should verify the token and update the password
        $user->password = Hash::make($request->password); // Use Hash::make here
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password reset successfully']);
    }
}
