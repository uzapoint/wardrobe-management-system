<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\AuthenticateUserController;
use App\Http\Controllers\ItemController;

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

Route::post('/register', [RegisterUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [PasswordResetController::class, 'changePassword'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', [VerificationController::class, "verify"])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'sendNotification'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');
Route::post('/sanctum/token', [AuthenticateUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');


Route::apiResource("items", ItemController::class)->middleware('auth:sanctum');
