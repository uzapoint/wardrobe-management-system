<?php



// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Authcontroller;

use App\Http\Controllers\Api\ClothController;
use Illuminate\Support\Facades\Route;


// User Registration
Route::post('register', [Authcontroller::class, 'register']);

// User Login
Route::post('login', [Authcontroller::class, 'login']);

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {
    // Clothing Items Routes
    Route::get('clothes', [ClothController::class, 'index']); // List all clothes
    Route::post('clothes', [ClothController::class, 'store']); // Add a new clothing item
    Route::get('clothes/{id}', [ClothController::class, 'show']); // View a specific clothing item
    Route::put('clothes/{id}', [ClothController::class, 'update']); // Update a clothing item
    Route::delete('clothes/{id}', [ClothController::class, 'destroy']); // Delete a clothing item
});

// Optional: You can also add a route to handle user logout if needed
Route::middleware('auth:sanctum')->post('logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Logged out successfully']);
});
