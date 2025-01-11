<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.produk.index', compact('products')); // Sesuaikan path ke admin.produk.index
    }

    public function create()
    {
        return view('admin.produk.create'); // Sesuaikan path ke admin.produk.create
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        Product::create($request->all());
        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.produk.edit', compact('product')); // Sesuaikan path ke admin.produk.edit
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $product->update($request->all());
        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil dihapus.');
    }
}