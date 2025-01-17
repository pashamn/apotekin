<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product; // Pastikan nama model sesuai dengan model Anda

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori
        $categories = Categories::all();

        // Ambil produk berdasarkan kategori yang dipilih, atau default ke produk terbaru
        $selectedCategory = $request->get('category_id'); // Ambil parameter category_id dari request
        $products = Product::when($selectedCategory, function ($query) use ($selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->latest()->take(10)->get(); // Sesuaikan jumlah produk yang ingin ditampilkan

        return view('home', compact('categories', 'products', 'selectedCategory'));
    }

    public function showProduct($id)
    {
        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Kirim data produk ke view 'show.blade.php'
        return view('show', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Ambil produk yang sesuai dengan kata kunci
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->get();
    
        // Jika permintaan adalah AJAX, kembalikan data JSON
        if ($request->ajax()) {
            return response()->json($products);
        }
    
        // Jika bukan AJAX, kembalikan view dengan hasil pencarian
        return view('search-results', [
            'products' => $products,
            'query' => $query,
        ]);
    }
}