<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
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
        ];

        $anime = [];
        foreach ($search['animes'] as $item) {
            $anime[] = $item;
        }

        $episode = [];
        foreach ($search['episodes'] as $item) {
            $episode[] = $item;
        }

        return view('front.search', [
            'title'     => 'Cari anime',
            'search'    => $search,
            'anime'     => $anime,
            'episode'   => $episode
        ]);
    }
}
