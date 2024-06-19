<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class ListMovieController extends Controller
{
    public function index()
    {
        return view('front.list-movie', [
            'title'     => 'List Movie',
            'movies'    => Movie::latest()->paginate(12),
        ]);
    }

    public function show(Movie $movie)
    {
        $genres     = [];
        foreach ($movie->genreOption as $item) {
            $genres[] = $item->genre->name;
        }

        return view('front.detail.movie-detail', [
            'title'     => $movie->title,
            'movie'     => $movie,
            'genres'    => $genres
        ]);
    }
}
