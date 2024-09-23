<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClothController;
use App\Http\Controllers\Api\AuthenticationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/user', [AuthenticationController::class, 'user']);
    
//Clothing routes
Route::get('/all-clothes', [ClothController::class, 'index'])->name('clothes.index');
Route::post('/clothes/store', [ClothController::class, 'store'])->name('clothes.store');

Route::post('/clothes/update/{id}', [ClothController::class, 'update'])->name('clothes.update');
Route::delete('/clothes/destroy/{id}',[ClothController::class,'destroy'])->name('clothes.destroy');

});

