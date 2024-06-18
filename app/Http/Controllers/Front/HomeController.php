<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Episode;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home', [
            'title'     => 'KawaNime',
            'episodes'  => Episode::with('anime')->latest()->paginate(8),
        ]);
    }
}
