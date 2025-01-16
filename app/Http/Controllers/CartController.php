<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; // Ganti sesuai model Anda

class CartController extends Controller
{
    public function view()
    {
        // Ambil item keranjang dari database atau session
        $cartItems = Cart::where('user_id', auth()->id())->get();
        
        // Hitung total harga
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'total'));
    }
}
