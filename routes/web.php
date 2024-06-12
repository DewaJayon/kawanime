<?php

use App\Http\Controllers\Dashboard\AnimeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ListAnimeController;
use App\Http\Controllers\Front\WatchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/watch/{episode:slug}', [WatchController::class, 'index'])->name('watch');
Route::get('/list-anime', [ListAnimeController::class, 'index'])->name('list-anime');
Route::get('/anime-detail/{anime:slug}', [ListAnimeController::class, 'show'])->name('anime-detail');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/anime', AnimeController::class);
});

Route::get('/test', function () {
    return view('welcome');
});
