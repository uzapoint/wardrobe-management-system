<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserClotheController;

Route::middleware(['api', 'auth:sanctum'])->group(function () 
{
    Route::get('index', [UserClotheController::class, 'store']);
    Route::post('create-user-clothes', [UserClotheController::class, 'store']);
    Route::post('update-user-clothes', [UserClotheController::class, 'update']);
    Route::get('delete-user-clothes/{userClothe}', [UserClotheController::class, 'destroy']);
});

Route::middleware('api', 'auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
