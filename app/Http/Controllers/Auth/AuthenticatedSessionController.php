<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    

     public function store(LoginRequest $request): JsonResponse
     {
         $request->authenticate();
     
         // Generate a new token for the user
         $token = $request->user()->createToken('Wardrobe')->plainTextToken;
     
         return response()->json([
             'message' => 'Login successful',
             'token' => $token, // Return the generated token
         ]);
     }
    
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
