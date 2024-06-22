<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\LiveAction;

class ListLiveActionController extends Controller
{
    public function index()
    {
        return view('front.list.live-action', [
            'title'         => 'List Live Action',
            'liveActions'   => LiveAction::with('genreOption', 'genreOption.genre')->paginate(10),
        ]);
    }

    public function show(LiveAction $liveAction)
    {
        $genres     = [];
        foreach ($liveAction->genreOption as $item) {
            $genres[] = $item->genre->name;
        }

        return view('front.detail.live-action', [
            'title'         => $liveAction->title,
            'liveAction'    => $liveAction,
            'genres'        => $genres
        ]);
    }
}
