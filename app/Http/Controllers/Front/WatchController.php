<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function index(Episode $episode)
    {
        $anime      = $episode->anime;
        $eps        = $episode->where('anime_id', $episode->anime_id)->findOrFail($episode->id);
        $allEps     = $episode->where('anime_id', $episode->anime_id)->get();

        return view('front.watch', [
            'title'     => $episode->title,
            'anime'     => $anime,
            'episode'   => $eps,
            'episodes'  => $allEps,
        ]);
    }
}
