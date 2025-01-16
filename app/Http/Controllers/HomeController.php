<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Product; // Pastikan nama model sesuai dengan model Anda

class HomeController extends Controller
{
    public function index()
    {
        

        // Ambil produk dari database
        $categories = Categories::all();
        $products = Product::latest()->take(10)->get(); // Sesuaikan dengan nama tabel Anda

        return view('home', compact('categories', 'products'));
    }

    public function showProduct($id)
    {
        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Kirim data produk ke view 'show.blade.php'
        return view('show', compact('product'));
    }
}