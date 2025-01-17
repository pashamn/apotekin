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
            // Upload gambar
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/products'), $imageName);
            
            // Simpan produk
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
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|numeric|min:0',
        ]);

        try {
            $oldImage = $product->image;
            
            // Update data produk
            $data = $validated;
            unset($data['image']); // Hapus image dari array data jika tidak ada upload baru

            // Jika ada gambar baru yang diunggah
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('products', 'public');
                
                // Hapus gambar lama setelah upload berhasil
                if ($oldImage && Storage::exists('public/' . $oldImage)) {
                    Storage::delete('public/' . $oldImage);
                }
            }

            $product->update($data);

            return redirect()->route('admin.produk')
                ->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi error dan ada upload gambar baru, hapus gambar baru
            if (isset($data['image']) && Storage::exists('public/' . $data['image'])) {
                Storage::delete('public/' . $data['image']);
            }
            
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui produk.')
                ->withInput();
        }
    }

    public function edit(Product $product)
    {
        $categories = Categories::all();
        return view('admin.produk.edit', compact('product', 'categories'));
    }
    

    public function destroy(Product $product)
    {
        // Hapus gambar jika ada
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
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