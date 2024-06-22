<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\LiveAction;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countAnime         = Anime::count();
        $countMovie         = Movie::count();
        $countLiveAction    = LiveAction::count();

        return view('dashboard.index', [
            'title'             => 'Dashboard',
            'jumlahAnime'       => $countAnime,
            'jumlahMovie'       => $countMovie,
            'jumlahLiveAction'  => $countLiveAction
        ]);
    }
}
