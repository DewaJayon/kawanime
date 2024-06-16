<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Episode;

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

        return view('front.watch', [
            'title'     => $episode->title,
            'anime'     => $anime,
            'episode'   => $eps,
            'episodes'  => $allEps,
            'genres'    => $genres
        ]);
    }
}
