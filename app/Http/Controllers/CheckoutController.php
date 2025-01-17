<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $subtotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);
        $shipping = 10.000; // Biaya pengiriman tetap
        $total = $subtotal + $shipping;

        return view('checkout', compact('carts', 'subtotal', 'shipping', 'total'));
    }

    private function generateOrderNumber()
    {
        $prefix = 'APKN'; // Prefix untuk invoice
        $year = date('Y');
        $month = date('m');
        
        // Mengambil counter terakhir untuk bulan ini
        $lastOrder = Order::whereYear('created_at', $year)
                         ->whereMonth('created_at', $month)
                         ->latest()
                         ->first();
        
        if ($lastOrder) {
            // Jika ada order di bulan ini, ambil nomor terakhir dan tambah 1
            $lastNumber = intval(substr($lastOrder->order_number, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada order di bulan ini, mulai dari 0001
            $newNumber = '0001';
        }
        
        // Format: INV-YYYYMM-XXXX
        $orderNumber = $prefix . '-' . $year . $month . '-' . $newNumber;
        
        return $orderNumber;
    }

    public function storeOrder(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'shipping_phone' => 'required|string',
            'notes' => 'nullable|string',
            'subtotal' => 'required|numeric',
        ]); // Dihapus payment_method dari validasi
    
        DB::beginTransaction();
    
        try {
            // Calculate total with shipping
            $shipping = 10000;
            $total = $validated['subtotal'] + $shipping;

            $orderNumber = $this->generateOrderNumber();
    
            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
                'shipping_phone' => $validated['shipping_phone'],
                'notes' => $validated['notes'] ?? null,
            ]);
    
            // Get cart items
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
    
            // Validate if cart is not empty
            if ($cartItems->isEmpty()) {
                throw new \Exception('Cart is empty');
            }
    
            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->quantity * $item->product->price,
                ]);
            }
    
            // Clear the cart
            Cart::where('user_id', auth()->id())->delete();
    
            DB::commit();
    
            return redirect('/')->with('success', 'Pesanan berhasil dibuat!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the error for debugging
            \Log::error('Checkout Error: ' . $e->getMessage());
            
            return redirect()->route('cart.view')
                ->with('error', 'Terjadi kesalahan saat memproses pesanan.');
        }
    }
}