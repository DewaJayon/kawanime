<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countAnime = Anime::count();

        return view('dashboard.index', [
            'title'         => 'Dashboard',
            'jumlahAnime'   => $countAnime
        ]);
    }
}
