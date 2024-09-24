<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClothesController;
use App\Http\Controllers\API\CategoriesController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', action: [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/password/reset', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset', [AuthController::class, 'resetPassword']);

Route::middleware(['auth:sanctum'])->group(function () {
Route::apiResource('categories', CategoriesController::class);
Route::apiResource(name: 'clothes', controller: ClothesController::class);
Route::delete('categories/{id}', [CategoriesController::class, 'destroy']);
});