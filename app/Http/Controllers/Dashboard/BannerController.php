<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.banner.index', [
            'title'     => 'Dashboard | Banner',
            'banners'   => Banner::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.banner.create', [
            'title'         => 'Dashboard | Banner',
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
            'category'      => 'required',
            'description'   => 'required',
            'url'           => 'required',
            'image'         => 'required|mimetypes:image/png,image/jpg,image/jpeg',
        ]);

        if ($request->status == null) {
            $status =  Banner::STATUS_INACTIVE;
        } else {
            $status =  Banner::STATUS_ACTIVE;
        }

        if ($request->file('image')) {
            $image = $request->file('image');
            $img   = $input['image'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('banner');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(1172, 564)->save($destinationPath . '/' . $img);
        }

        $bannerParams = [
            'category_id'   => $request->category,
            'title'         => $request->title,
            'description'   => $request->description,
            'url'           => $request->url,
            'image'         => 'banner/' . $img,
            'status'        => $status,
        ];

        Banner::create($bannerParams);

        return redirect()->route('banner.index')->with('success', 'Banner telah ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('dashboard.banner.show', [
            'title'         => 'Dashboard | Banner',
            'banner'        => $banner,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('dashboard.banner.edit', [
            'title'         => 'Dashboard | Banner',
            'banner'        => $banner,
            'categories'    => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $rusles = [
            'title'         => 'required|max:255',
            'category_id'      => 'required',
            'description'   => 'required',
            'url'           => 'required',
        ];

        $validate = $request->validate($rusles);

        if ($request->status == null) {
            $status =  Banner::STATUS_INACTIVE;
        } else {
            $status =  Banner::STATUS_ACTIVE;
        }

        if ($request->file('image')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }

            $image = $request->file('image');
            $img   = $input['image'] = time() . '.' . $image->getClientOriginalExtension();

            $imagePath = Storage::path('banner');

            $destinationPath    = $imagePath;
            $imgFile            = Image::make($image->getRealPath());
            $imgFile->resize(1172, 564)->save($destinationPath . '/' . $img);

            $validate['image'] = 'banner/' . $img;
        }

        Banner::where('id', $banner->id)->update($validate);

        return redirect()->route('banner.index')->with('success', 'Banner telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        try {
            Banner::destroy($banner->id);
            if ($banner->image) {
                Storage::delete($banner->image);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Banner gagal dihapus!');
        }

        return redirect()->back()->with('success', 'Banner telah dihapus!');
    }
}
