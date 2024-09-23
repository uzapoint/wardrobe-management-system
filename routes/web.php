<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClothesController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Clothing routes
Route::get('/all-clothes', [ClothesController::class, 'index'])->name('clothes.index');
Route::post('/clothes/store', [ClothesController::class, 'store'])->name('clothes.store');
Route::get('/clothes/create', [ClothesController::class, 'create'])->name('clothes.create');
Route::get('/clothes/edit/{id}', [ClothesController::class, 'edit'])->name('clothes.edit');
Route::post('/clothes/update/{id}', [ClothesController::class, 'update'])->name('clothes.update');
Route::delete('/clothes/destroy/{id}',[ClothesController::class,'destroy'])->name('clothes.destroy');
