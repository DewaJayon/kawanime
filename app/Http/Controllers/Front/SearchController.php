<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\LiveAction;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $inputSearch = $request->search;

        $search = [
            'animes'        => Anime::where('title', 'like', "%$inputSearch%")->get(),
            'episodes'      => Episode::where('title', 'like', "%$inputSearch%")->get(),
            'movies'        => Movie::with('genreOption', 'genreOption.genre')->where('title', 'like', "%$inputSearch%")->get(),
            'liveActions'   => LiveAction::with('genreOption', 'genreOption.genre')->where('title', 'like', "%$inputSearch%")->get(),
        ];

        if ($inputSearch == "") {
            return redirect()->route('home');
        }

        if (count($search['animes']) == 0 && count($search['episodes']) == 0 && count($search['movies']) == 0 && count($search['liveActions']) == 0) {
            $notFound = "Pencarian Tidak Ditemukan";
            return view('front.search', [
                'title'     => 'Cari anime',
                'notFound'  => $notFound
            ]);
        }

        $anime = [];
        foreach ($search['animes'] as $item) {
            $anime[] = $item;
        }

        $episode = [];
        foreach ($search['episodes'] as $item) {
            $episode[] = $item;
        }

        $movie = [];
        foreach ($search['movies'] as $item) {
            $movie[] = $item;
        }

        $liveAction = [];
        foreach ($search['liveActions'] as $item) {
            $liveAction[] = $item;
        }

        return view('front.search', [
            'title'         => 'Cari anime',
            'search'        => $search,
            'anime'         => $anime,
            'episode'       => $episode,
            'movie'         => $movie,
            'liveAction'    => $liveAction,
            'notFound'      => '',
        ]);
    }
}
