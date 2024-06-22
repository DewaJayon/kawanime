<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Genre;
use App\Models\GenreOption;
use App\Models\LiveAction;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LiveActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.live-action.index', [
            'title'         => 'Dashboard | Live Action',
            'liveActions'   => LiveAction::with('category')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.live-action.create', [
            'title'         => 'Create Live Action',
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

        $slug = SlugService::createSlug(LiveAction::class, 'slug', $request->title);

        if ($request->file('video')) {
            $video = $request->file('video');
            $vid   = $input['video'] = time() . '.' . $video->getClientOriginalExtension();

            $videoPath = Storage::path('live-action');

            if (!file_exists($videoPath)) {
                mkdir($videoPath, 0777, true);
            }

            $video->move($videoPath, $vid);
        }

        if ($request->file('thumbnail')) {
            $image  = $request->file('thumbnail');
            $img    = $input['thumbnail'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('live-action-thumbnail');

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
            'video'         => 'live-action/' . $vid,
            'thumbnail'     => 'live-action-thumbnail/' . $img,
            'release_date'  => $request->release_date,
        ];

        $liveAction = LiveAction::create($movieParams);

        if ($request->genre) {
            $genres = $request->genre;
            DB::transaction(function () use ($genres, $liveAction) {
                foreach ($genres as $genre) {
                    $genreOptionParams = [
                        'genre_id'          => $genre,
                        'live_action_id'    => $liveAction->id,
                    ];
                    GenreOption::create($genreOptionParams);
                }
            });
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LiveAction $liveAction)
    {
        $genre = [];
        foreach ($liveAction->genreOption as $item) {
            $genre[] = $item->genre->name;
        }

        return view('dashboard.live-action.show', [
            'title'         => 'Live Action',
            'liveAction'    => $liveAction,
            'genres'        => $genre
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiveAction $liveAction)
    {

        return view('dashboard.live-action.edit', [
            'title'         => 'Edit Live Action',
            'liveAction'    => $liveAction,
            'categories'    => Category::all(),
            'genres'        => Genre::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LiveAction $liveAction)
    {
        $rules = [
            'title'         => 'required|max:255',
            'release_date'  => 'required|date',
            'duration'      => 'required|max:255',
            'category_id'   => 'required',
            'description'   => 'required',
        ];

        $validate = $request->validate($rules);

        if ($request->title != $liveAction->title) {
            $slug = SlugService::createSlug(LiveAction::class, 'slug', $request->title);
            $validate['slug'] = $slug;
        }

        if ($request->file('video')) {
            $video = $request->file('video');
            $vid   = $input['video'] = time() . '.' . $video->getClientOriginalExtension();

            $videoPath = Storage::path('live-action');

            if (!file_exists($videoPath)) {
                mkdir($videoPath, 0777, true);
            }

            $video->move($videoPath, $vid);

            $validate['video'] = 'live-action/' . $vid;
        }

        if ($request->file('thumbnail')) {
            $image  = $request->file('thumbnail');
            $img    = $input['thumbnail'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('live-action-thumbnail');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(230, 325)->save($destinationPath . '/' . $img);

            $validate['thumbnail'] = 'live-action-thumbnail/' . $img;
        }

        LiveAction::where('id', $liveAction->id)->update($validate);

        if ($request->genre) {
            $genres = $request->genre;
            DB::transaction(function () use ($genres, $liveAction) {
                GenreOption::where('live_action_id', $liveAction->id)->delete();
                foreach ($genres as $genre) {
                    $genreOptionParams = [
                        'genre_id'          => $genre,
                        'live_action_id'    => $liveAction->id,
                    ];
                    GenreOption::create($genreOptionParams);
                }
            });
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiveAction $liveAction)
    {
        try {
            GenreOption::where('live_action_id', $liveAction->id)->delete();
            LiveAction::destroy($liveAction->id);
            if ($liveAction->thumbnail) {
                Storage::delete($liveAction->thumbnail);
            }

            if ($liveAction->video) {
                Storage::delete($liveAction->video);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Live Action gagal dihapus!');
        }

        return redirect()->route('live-action.index')->with('success', 'Live Action telah dihapus!');
    }
}
