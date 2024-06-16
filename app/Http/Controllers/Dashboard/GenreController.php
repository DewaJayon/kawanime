<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.genre.index', [
            'title'     => 'Dashboard | Genre',
            'genres'    => Genre::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
        ]);

        Genre::create([
            'name'  => $request->name,
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre telah ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('dashboard.genre.index', [
            'title'     => 'Dashboard | Genre',
            'genre'     => $genre,
            'genres'    => Genre::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name'  => 'required',
        ]);

        Genre::where('id', $genre->id)->update([
            'name'  => $request->name,
        ]);

        return redirect()->route('genre.index')->with('success', 'Genre telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        try {
            Genre::destroy($genre->id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Genre gagal dihapus!');
        }

        return redirect()->back()->with('success', 'Genre telah dihapus!');
    }
}
