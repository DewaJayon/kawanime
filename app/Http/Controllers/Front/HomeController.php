<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Episode;
use App\Models\LiveAction;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home', [
            'title'         => 'KawaNime',
            'episodes'      => Episode::with(['anime', 'anime.genreOption', 'anime.genreOption.genre'])->latest()->paginate(8),
            'movies'        => Movie::with(['genreOption', 'genreOption.genre'])->latest()->paginate(8),
            'liveActions'   => LiveAction::with(['category', 'genreOption', 'genreOption.genre'])->latest()->paginate(8),
            'banners'       => Banner::where('status', 1)->get(),
        ]);
    }
}
