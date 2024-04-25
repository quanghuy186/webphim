<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/category', [IndexController::class, 'category'])->name('category');
Route::get('country', [IndexController::class, 'country'])->name('country');
Route::get('episode', [IndexController::class, 'episode'])->name('episode');
Route::get('movie', [IndexController::class, 'movie'])->name('movie');
Route::get('watch', [IndexController::class, 'watch'])->name('watch');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');