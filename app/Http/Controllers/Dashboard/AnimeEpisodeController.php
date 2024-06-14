<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Episode;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeEpisodeController extends Controller
{
    public function index(Anime $anime)
    {
        $episodes   = Episode::where('anime_id', $anime->id)->get();

        return view('dashboard.anime.episode.index', [
            'title'         => 'Episode | ' . $anime->title,
            'episodes'      => $episodes,
            'anime'         => $anime
        ]);
    }

    public function create(Anime $anime)
    {
        return view('dashboard.anime.episode.create', [
            'title'         => 'Create Episode | ' . $anime->title,
            'anime'         => $anime
        ]);
    }

    public function store(Request $request, Anime $anime)
    {
        $request->validate([
            'title'         => 'required|max:255',
            'episode'       => 'required|max:255',
            'duration'      => 'required|max:255',
            'video'         => 'mimetypes:video/mp4,video/x-m4v,video/*'
        ]);

        $slug = SlugService::createSlug(Episode::class, 'slug', $request->title);

        if ($request->file('video')) {
            $video = $request->file('video');
            $vid   = $input['video'] = time() . '.' . $video->getClientOriginalExtension();

            $videoPath = Storage::path('anime-episode');

            if (!file_exists($videoPath)) {
                mkdir($videoPath, 0777, true);
            }
            $video->move($videoPath, $vid);
        }

        if ($request->file('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumb    = $input['thumbnail'] = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = Storage::path('episode-thumbnail');

            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0777, true);
            }

            $thumbnail->move($thumbnailPath, $thumb);
        }

        $params = [
            'title'         => $request->title,
            'slug'          => $slug,
            'episode'       => $request->episode,
            'duration'      => $request->duration,
            'video'         => 'anime-episode/' . $vid,
            'anime_id'      => $anime->id,
            'thumbnail'     => $request->file('thumbnail') ? 'episode-thumbnail/' . $thumb : null,
        ];

        Episode::create($params);
    }

    public function edit(Anime $anime, Episode $episode)
    {
        return view('dashboard.anime.episode.edit', [
            'title'         => 'Edit Episode | ' . $anime->title,
            'episode'       => $episode,
            'anime'         => $anime
        ]);
    }

    public function update(Request $request, Anime $anime, Episode $episode)
    {
        $rules = [
            'title'         => 'required|max:255',
            'episode'       => 'required|max:255',
            'duration'      => 'required|max:255',
        ];

        $request->validate($rules);

        $slug = SlugService::createSlug(Episode::class, 'slug', $request->title);

        if ($request->file('video')) {

            if ($request->old_video) {
                Storage::delete($request->old_video);
            }

            $video = $request->file('video');
            $vid   = $input['video'] = time() . '.' . $video->getClientOriginalExtension();

            $videoPath = Storage::path('anime-episode');
            $video->move($videoPath, $vid);
        }

        if ($request->file('thumbnail')) {
            if ($request->old_thumbnail) {
                Storage::delete($request->old_thumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $thumb    = $input['thumbnail'] = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnailPath = Storage::path('episode-thumbnail');

            $thumbnail->move($thumbnailPath, $thumb);
        }

        $params = [
            'title'         => $request->title,
            'slug'          => $slug,
            'episode'       => $request->episode,
            'duration'      => $request->duration,
            'video'         => $request->file('video') ? 'anime-episode/' . $vid : $episode->video,
            'thumbnail'     => $request->file('thumbnail') ? 'episode-thumbnail/' . $thumb : $episode->thumbnail,
        ];

        Episode::where('id', $episode->id)->update($params);
    }

    public function destroy(Anime $anime, Episode $episode)
    {
        try {
            Storage::delete($episode->video);
            Storage::delete($episode->thumbnail);
            Episode::destroy($episode->id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Episode gagal dihapus!');
        }

        return redirect()->back()->with('success', 'Episode telah dihapus!');
    }
}
