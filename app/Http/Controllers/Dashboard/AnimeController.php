<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.anime.index', [
            'title'     => 'Dashboard | Anime',
            'animes'    => Anime::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.anime.create', [
            'title'         => 'Dashboard | Anime',
            'categories'    => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'         => 'required|max:255',
            'studio'        => 'required|max:255',
            'description'   => 'required',
            'airing_date'   => 'required|date',
            'thumbnail'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'category'      => 'required',
        ]);

        if ($request->file('thumbnail')) {
            $image  = $request->file('thumbnail');
            $img    = $input['thumbnail'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('anime-thumbnail');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(230, 325)->save($destinationPath . '/' . $img);
        }


        if ($request->status == null) {
            $status = Anime::STATUS_FINISHED;
        } else {
            $status = Anime::STATUS_ONGOING;
        }

        $slug = SlugService::createSlug(Anime::class, 'slug', $request->title);

        $animeParams = [
            'title'         => $request->title,
            'slug'          => $slug,
            'studio'        => $request->studio,
            'description'   => $request->description,
            'status'        => $status,
            'airing_date'   => $request->airing_date,
            'thumbnail'     => $img,
            'category_id'   => $request->category,
        ];

        Anime::create($animeParams);

        return redirect()->route('anime.index')->with('success', 'Anime telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
        return view('dashboard.anime.show', [
            'title'         => 'Dashboard | ' . $anime->title,
            'anime'         => $anime,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anime $anime)
    {
        return view('dashboard.anime.edit', [
            'title'         => 'Dashboard | ' . $anime->title,
            'anime'         => $anime,
            'categories'    => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anime $anime)
    {
        $rules = [
            'title'         => 'required|max:255',
            'studio'        => 'required|max:255',
            'description'   => 'required',
            'airing_date'   => 'required|date',
            'thumbnail'     => 'image|mimes:jpeg,jpg,png|max:2048',
            'category_id'   => 'required',
        ];

        $validate = $request->validate($rules);

        if ($request->status == null) {
            $validate['status'] = Anime::STATUS_FINISHED;
        } else {
            $validate['status'] = Anime::STATUS_ONGOING;
        }

        if ($request->title != strtolower($anime->title)) {
            $validate['slug']  = SlugService::createSlug(Anime::class, 'slug', $request->title);
        } else {
            $validate['slug'] = $anime->slug;
        }

        if ($request->file('thumbnail')) {
            if ($request->old_thumbnail) {
                Storage::delete($request->old_thumbnail);
            }

            $image  = $request->file('thumbnail');
            $img    = $input['thumbnail'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('anime-thumbnail');

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(230, 325)->save($destinationPath . '/' . $img);
            $validate['thumbnail'] = $img;
        }

        Anime::where('id', $anime->id)->update($validate);

        return redirect()->route('anime.index')->with('success', 'Anime telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anime $anime)
    {

        try {
            Anime::destroy($anime->id);
            if ($anime->thumbnail) {
                Storage::delete($anime->thumbnail);
            }
        } catch (\Exception $e) {
            return redirect()->route('anime.index')->with('error', 'Anime gagal dihapus!');
        }

        return redirect()->route('anime.index')->with('success', 'Anime telah dihapus!');
    }
}
