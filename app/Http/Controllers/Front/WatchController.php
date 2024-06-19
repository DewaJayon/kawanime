<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Movie;

class WatchController extends Controller
{
    public function index(Episode $episode)
    {
        $anime      = $episode->anime;
        $eps        = $episode->where('anime_id', $episode->anime_id)->findOrFail($episode->id);
        $allEps     = $episode->where('anime_id', $episode->anime_id)->get();

        $genres     = [];
        foreach ($anime->genreOption as $item) {
            $genres[] = $item->genre->name;
        }

        return view('front.watch.watch', [
            'title'     => $episode->title,
            'anime'     => $anime,
            'episode'   => $eps,
            'episodes'  => $allEps,
            'genres'    => $genres
        ]);
    }

    public function movie(Movie $movie)
    {
        $genres     = [];
        foreach ($movie->genreOption as $item) {
            $genres[] = $item->genre->name;
        }

        return view('front.watch.watch-movie', [
            'title'     => $movie->title,
            'movie'     => $movie,
            'genres'    => $genres
        ]);
    }
}
