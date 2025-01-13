<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Memuat produk beserta kategori terkait
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.produk.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::all(); // Ambil semua kategori
        return view('admin.produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('products', 'public');

        // Simpan produk
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        // Memuat semua kategori untuk dropdown
        $categories = Categories::all(); 
        return view('admin.produk.edit', compact('product', 'categories'));
    }
    
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id', // Validasi kategori
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
        ]);
    
        // Update data produk
        $data = $request->only(['name', 'price', 'description', 'category_id']);
    
        // Jika ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
    
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');
        }
    
        $product->update($data);
    
        // Redirect ke halaman produk dengan pesan sukses
        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil dihapus.');
    }
}