<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('front.home', [
            'title'     => 'KawaNime',
            'episodes'  => Episode::with('anime')->latest()->take(6)->get(),
        ]);
    }
}
