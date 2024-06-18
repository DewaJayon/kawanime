<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {

        $inputSearch = $request->search;

        $search = Anime::where(function ($query) use ($inputSearch) {
            $query->where('title', 'like', '%' . $inputSearch . '%');
        })->with(['episode' => function ($query) use ($inputSearch) {
            $query->where('title', 'like', '%' . $inputSearch . '%');
        }])->get();

        return view('front.search', [
            'title' => 'Cari anime',
            'search' => $search,
        ]);
    }
}
