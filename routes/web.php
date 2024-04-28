<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;

Route::get('/', [IndexController::class, 'home'])->name('homepage');
Route::get('/category', [IndexController::class, 'category'])->name('category');
Route::get('country', [IndexController::class, 'country'])->name('country');
Route::get('episode', [IndexController::class, 'episode'])->name('episode');
Route::get('movie', [IndexController::class, 'movie'])->name('movie');
Route::get('watch', [IndexController::class, 'watch'])->name('watch');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class);
Route::resource('country', CountryController::class);
Route::resource('episode', EpisodeController::class);
Route::resource('movie', MovieController::class);
Route::resource('genre', GenreController::class);