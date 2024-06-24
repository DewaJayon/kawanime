<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;

class ListAnimeController extends Controller
{

    public function index()
    {
        return view('front.list.anime', [
            'title'     => 'List Anime',
            'animes'    => Anime::latest()->paginate(8),
        ]);
    }

    public function show(Anime $anime)
    {
        $episode = Episode::where('anime_id', $anime->id)->first();
        $genre   = [];
        foreach ($anime->genreOption as $item) {
            $genre[] = $item->genre->name;
        }
        return view('front.detail.anime', [
            'title'     => $anime->title,
            'anime'     => $anime,
            'episode'   => $episode,
            'genres'    => $genre
        ]);
    }
}
