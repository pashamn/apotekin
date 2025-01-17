<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function view()
    {
        // Mengambil data cart berdasarkan user yang sedang login
        $carts = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        // Menghitung subtotal, savings, dan total
        $subtotal = $carts->sum(fn ($cart) => $cart->product->price * $cart->quantity);

        $total = 0 + $subtotal;

        // Mengirim data ke view
        return view('cart', [
            'carts' => $carts,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $productId = $validated['product_id'];
        $cart = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();
    
        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }
    
        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang.']);
    }

    public function update(Request $request, Cart $cart)
    {
        \Log::info('Cart update request received', [
            'cart_id' => $cart->id,
            'quantity' => $request->quantity
        ]);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        $total = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get()
            ->sum(function($cart) {
                return $cart->quantity * $cart->product->price;
            });

        return response()->json([
            'success' => true,
            'total' => $total
        ]);
    }
}