<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () 
{
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() 
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //USERS---------------------------------
        Route::get('users/{role}', [App\Http\Controllers\UserController::class, 'index']);
        Route::post('create-user', [App\Http\Controllers\UserController::class, 'store']);
        Route::get('edit-user/{user}', [App\Http\Controllers\UserController::class, 'edit']);
        Route::post('update-user', [App\Http\Controllers\UserController::class, 'update']);
        Route::post('reset-password', [App\Http\Controllers\UserController::class, 'resetPassword']);
        Route::get('logout', [App\Http\Controllers\UserController::class, 'logout']);

    //CLOTH TYPES--------------------
        Route::get('user-cloth-types', [App\Http\Controllers\UserClothTypeController::class, 'index']);
        Route::post('create-user-cloth-type', [App\Http\Controllers\UserClothTypeController::class, 'store']);
        Route::post('update-user-cloth-type', [App\Http\Controllers\UserClothTypeController::class, 'update']);
        Route::get('delete-user-cloth-type/{clothType}', [App\Http\Controllers\UserClothTypeController::class, 'destroy']);

    //USER CLOTHES--------------------
        Route::get('user-clothes', [App\Http\Controllers\UserClotheController::class, 'index']);
        Route::post('create-user-cloth', [App\Http\Controllers\UserClotheController::class, 'store']);
        Route::post('update-user-cloth', [App\Http\Controllers\UserClotheController::class, 'update']);
        Route::get('activate-user-cloth/{userClothe}', [App\Http\Controllers\UserClotheController::class, 'activate']);
        Route::get('deactivate-user-cloth/{userClothe}', [App\Http\Controllers\UserClotheController::class, 'deactivate']);
        Route::get('delete-user-cloth/{userClothe}', [App\Http\Controllers\UserClotheController::class, 'destroy']);
});
