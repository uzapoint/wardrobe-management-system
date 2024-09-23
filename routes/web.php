<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// routes for the clothController
Route::get('/clothes', 'App\Http\Controllers\Api\ClothController@index');
Route::post('/clothes', 'App\Http\Controllers\Api\ClothController@create');
Route::put('/clothes/{id}', 'App\Http\Controllers\Api\ClothController@update');
Route::delete('/clothes/{id}', 'App\Http\Controllers\Api\ClothController@destroy');