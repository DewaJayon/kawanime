<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Models\GenreOption;
use App\Models\Movie;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.movie.index', [
            'title'     => 'Dashboard | Movie',
            'movies'    => Movie::with('category')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.movie.create', [
            'title'         => 'Dashboard | Movie',
            'categories'    => Category::all(),
            'genres'        => Genre::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|max:255',
            'release_date'  => 'required|date',
            'duration'      => 'required|max:255',
            'category'      => 'required',
            'description'   => 'required',
            'video'         => 'required|mimetypes:video/mp4,video/x-m4v,video/*',
            'thumbnail'     => 'required|mimetypes:image/png,image/jpg,image/jpeg',
        ]);

        $slug = SlugService::createSlug(Movie::class, 'slug', $request->title);

        if ($request->file('video')) {
            $video = $request->file('video');
            $vid   = $input['video'] = time() . '.' . $video->getClientOriginalExtension();

            $videoPath = Storage::path('movie');

            if (!file_exists($videoPath)) {
                mkdir($videoPath, 0777, true);
            }

            $video->move($videoPath, $vid);
        }

        if ($request->file('thumbnail')) {
            $image  = $request->file('thumbnail');
            $img    = $input['thumbnail'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('movie-thumbnail');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(230, 325)->save($destinationPath . '/' . $img);
        }

        $movieParams = [
            'title'         => $request->title,
            'category_id'   => $request->category,
            'slug'          => $slug,
            'description'   => $request->description,
            'duration'      => $request->duration,
            'video'         => 'movie/' . $vid,
            'thumbnail'     => 'movie-thumbnail/' . $img,
            'release_date'  => $request->release_date,
        ];

        $movie = Movie::create($movieParams);

        if ($request->genre) {
            $genres = $request->genre;
            DB::transaction(function () use ($genres, $movie) {
                foreach ($genres as $genre) {
                    $genreOptionParams = [
                        'genre_id'  => $genre,
                        'movie_id'  => $movie->id,
                    ];
                    GenreOption::create($genreOptionParams);
                }
            });
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {

        $genre = [];
        foreach ($movie->genreOption as $item) {
            $genre[] = $item->genre->name;
        }

        return view('dashboard.movie.show', [
            'title'     => 'Dashboard | Movie',
            'movie'     => $movie,
            'genres'    => $genre
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('dashboard.movie.edit', [
            'title'         => 'Dashboard | Movie',
            'movie'         => $movie,
            'categories'    => Category::all(),
            'genres'        => Genre::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $rules = [
            'title'         => 'required|max:255',
            'release_date'  => 'required|date',
            'duration'      => 'required|max:255',
            'category_id'   => 'required',
            'description'   => 'required',
        ];

        if ($request->slug != $movie->slug) {
            $rules['slug'] = SlugService::createSlug(Movie::class, 'slug', $request->title);
        }

        $validate = $request->validate($rules);

        if ($request->file('video')) {

            if ($request->old_video) {
                Storage::delete($request->old_video);
            }

            $video = $request->file('video');
            $vid   = $input['video'] = time() . '.' . $video->getClientOriginalExtension();

            $videoPath = Storage::path('movie');
            $video->move($videoPath, $vid);

            $validate['video'] = 'movie/' . $vid;
        }

        if ($request->file('thumbnail')) {

            if ($request->old_thumbnail) {
                Storage::delete($request->old_thumbnail);
            }

            $image  = $request->file('thumbnail');
            $img    = $input['thumbnail'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('movie-thumbnail');

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(230, 325)->save($destinationPath . '/' . $img);

            $validate['thumbnail'] = 'movie-thumbnail/' . $img;
        }

        Movie::where('id', $movie->id)->update($validate);

        if ($request->genre) {
            $genres = $request->genre;
            DB::transaction(function () use ($genres, $movie) {
                GenreOption::where('movie_id', $movie->id)->delete();
                foreach ($genres as $genre) {
                    $genreOptionParams = [
                        'genre_id'  => $genre,
                        'movie_id'  => $movie->id,
                    ];
                    GenreOption::create($genreOptionParams);
                }
            });
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        try {
            DB::transaction(function () use ($movie) {
                GenreOption::where('movie_id', $movie->id)->delete();
                Movie::destroy($movie->id);
                if ($movie->thumbnail) {
                    Storage::delete($movie->thumbnail);
                }
                if ($movie->video) {
                    Storage::delete($movie->video);
                }
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Movie gagal dihapus!');
        }

        return redirect()->route('movie.index')->with('success', 'Movie telah dihapus!');
    }
}
