<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.category.index', [
            'title'         => 'Dashboard | Category',
            'categories'    => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:categories'
        ]);

        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);

        Category::create([
            'name'  => $request->name,
            'slug'  => $slug
        ]);

        return redirect()->route('category.index')->with('success', 'Category berhasil dibuat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.index', [
            'title'         => 'Dashboard | Category',
            'categories'    => Category::all(),
            'category'      => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|unique:categories,name,' . $category->id
        ];

        if ($request->slug != $category->slug) {
            $rules['slug'] = SlugService::createSlug(Category::class, 'slug', $request->name);
        }

        $request->validate($rules);

        Category::where('id', $category->id)->update([
            'name'  => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            Category::destroy($category->id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Category gagal dihapus!');
        }

        return redirect()->back()->with('success', 'Category telah dihapus!');
    }
}
