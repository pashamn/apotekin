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
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required|numeric|min:0',
        ]);

        try {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/products'), $imageName);
            
            Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'category_id' => $validated['category_id'],
                'image' => 'products/'.$imageName,
                'stock' => $validated['stock'],
            ]);

            return redirect()->route('admin.produk')
                ->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika terjadi error, hapus gambar yang sudah diupload
            if (isset($imagePath) && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menambah produk.')
                ->withInput();
        }
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|numeric|min:0',
        ]);


        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $imagePath = public_path('storage/' . $product->image);
            if (file_exists($imagePath) && !is_dir($imagePath)) {
                unlink($imagePath);
            }
            $request->image->move(public_path('storage/products'), $imageName);
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'image' => 'products/'.$imageName
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'stock' => $request->stock
            ]);
        }    

        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function edit(Product $product)
    {
        $categories = Categories::all();
        return view('admin.produk.edit', compact('product', 'categories'));
    }
    

    public function destroy(Product $product)
    {
        // Hapus gambar jika ada
        $imagePath = public_path('storage/'.$product->image);
            if (file_exists($imagePath) && !is_dir($imagePath)) {
                unlink($imagePath);
            }
        
        $product->delete();
        return redirect()->route('admin.produk')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.produk.show', compact('product'));
    }
}