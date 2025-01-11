<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories; // Pastikan ini sesuai dengan nama model
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Categories::create($request->all());
        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Categories $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Categories $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category->update($request->all());
        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
