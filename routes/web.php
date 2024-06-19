<?php

use App\Http\Controllers\Dashboard\AnimeController;
use App\Http\Controllers\Dashboard\AnimeEpisodeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GenreController;
use App\Http\Controllers\Dashboard\MovieController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ListAnimeController;
use App\Http\Controllers\Front\ListMovieController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\WatchController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'register'  => false,
    'reset'     => false,
    'verify'    => false,
]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/watch/{episode:slug}', [WatchController::class, 'index'])->name('watch');
Route::get('/watch/movie/{movie:slug}', [WatchController::class, 'movie'])->name('watch.movie');
Route::get('/list-anime', [ListAnimeController::class, 'index'])->name('list-anime');
Route::get('/anime-detail/{anime:slug}', [ListAnimeController::class, 'show'])->name('anime-detail');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/list-movie', [ListMovieController::class, 'index'])->name('list-movie');
Route::get('/movie-detail/{movie:slug}', [ListMovieController::class, 'show'])->name('movie-detail');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/anime', AnimeController::class);
    Route::resource('/dashboard/genre', GenreController::class)->except(['show', 'create']);
    Route::resource('/dashboard/category', CategoryController::class)->except(['show', 'create']);
    Route::resource('/dashboard/movie', MovieController::class);

    Route::get('/dashboard/anime/{anime}/episode', [AnimeEpisodeController::class, 'index'])->name('dashboard.anime.episode');
    Route::get('/dashboard/anime/{anime}/episode/create', [AnimeEpisodeController::class, 'create'])->name('dashboard.anime.episode.create');
    Route::post('/dashboard/anime/{anime}/episode', [AnimeEpisodeController::class, 'store'])->name('dashboard.anime.episode.store');
    Route::get('/dashboard/anime/{anime}/episode/{episode}/edit', [AnimeEpisodeController::class, 'edit'])->name('dashboard.anime.episode.edit');
    Route::put('/dashboard/anime/{anime}/episode/{episode}', [AnimeEpisodeController::class, 'update'])->name('dashboard.anime.episode.update');
    Route::delete('/dashboard/anime/{anime}/episode/{episode}', [AnimeEpisodeController::class, 'destroy'])->name('dashboard.anime.episode.destroy');
});

Route::get('/test', function () {
    return view('welcome');
});
