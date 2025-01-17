<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Memuat pesanan beserta relasi user dan produk
        $orders = Order::with(['user', 'orderItems'])
            ->latest()
            ->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all(); // Ambil semua produk
        return view('admin.order.createorder', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'user_id' => $request->user_id,
            'status' => $request->status,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'total_amount' => 0,
        ]);

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'total_amount' => 0, // akan diupdate setelah menambahkan produk
        ]);

        // Attach produk ke pesanan dengan quantity
        $totalAmount = 0;
        foreach ($request->products as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index];
            $subtotal = $product->price * $quantity;
            
            $order->products()->attach($productId, [
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal
            ]);
            
            $totalAmount += $subtotal;
        }

        // Update total amount
        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('admin.order')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function edit(Order $order)
    {
        $users = User::all();
        $products = Product::all();
        $order->load('products'); // Eager load products
        return view('admin.order.edit', compact('order', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1'
        ]);

        // Update order details
        $order->update([
            'status' => $request->status,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method
        ]);

        // Sync products and quantities
        $order->products()->detach(); // Remove existing products
        
        $totalAmount = 0;
        foreach ($request->products as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index];
            $subtotal = $product->price * $quantity;
            
            $order->products()->attach($productId, [
                'quantity' => $quantity,
                'price' => $product->price,
                'subtotal' => $subtotal
            ]);
            
            $totalAmount += $subtotal;
        }

        // Update total amount
        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('admin.order')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        // Delete the order and its relationships
        $order->products()->detach();
        $order->delete();
        
        return redirect()->route('admin.order')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    public function show(Order $order)
    {
        // Eager load relasi orderItems dan product dari setiap item
        $order->load(['orderItems.product', 'user']);
    
        return view('admin.order.detailorder', compact('order'));
    }
    
}