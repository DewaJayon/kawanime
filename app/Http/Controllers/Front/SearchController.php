<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use App\Models\Movie;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $inputSearch = $request->search;

        // $search = Anime::where(function ($query) use ($inputSearch) {
        //     $query->where('title', 'like', '%' . $inputSearch . '%');
        // })->with(['episode' => function ($query) use ($inputSearch) {
        //     $query->where('title', 'like', '%' . $inputSearch . '%');
        // }])->get();

        $search = [
            'animes'    => Anime::where('title', 'like', "%$inputSearch%")->get(),
            'episodes'  => Episode::where('title', 'like', "%$inputSearch%")->get(),
            'movies'    => Movie::with('genreOption', 'genreOption.genre')->where('title', 'like', "%$inputSearch%")->get(),
        ];

        if (count($search['animes']) == 0 && count($search['episodes']) == 0 && count($search['movies']) == 0) {
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

        return view('front.search', [
            'title'     => 'Cari anime',
            'search'    => $search,
            'anime'     => $anime,
            'episode'   => $episode,
            'movie'     => $movie,
            'notFound'  => '',
        ]);
    }
}
