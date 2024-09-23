<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClothingController;
use App\Http\Controllers\WadrobesController;
use App\Http\Controllers\WadrobesCategoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->apiResource('wadrobes', WadrobesController::class);

Route::middleware('auth:sanctum')->apiResource('wadrobe_categories', WadrobesCategoriesController::class);

Route::middleware('auth:sanctum')->apiResource('wadrobe_categories_clothing', ClothingController::class);

Route::middleware('auth:sanctum')->get('/wadrobes', [WadrobesController::class, 'index']);

Route::middleware('auth:sanctum')->get('/wadrobe_categories', [WadrobesCategoriesController::class, 'index']);
Route::middleware('auth:sanctum')->get('/wadrobe_categories_clothing', [ClothingController::class, 'index']);


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
