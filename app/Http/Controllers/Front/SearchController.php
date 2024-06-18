<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search()
    {
        return view('front.search', [
            'title' => 'Cari anime',
            'search' => Episode::latest()->with('anime')->search(request(['search']))->paginate(12),
        ]);
    }
}
