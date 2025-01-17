<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MyOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query()
            ->where('user_id', auth()->id());
        
        // Filter berdasarkan status
        if ($request->filter && $request->filter !== 'all') {
            $query->where('status', $request->filter);
            
        }
        
        $orders = $query->orderBy('created_at', 'desc')
                       ->paginate(10);
        
        return view('my-orders', compact('orders')); // Changed from 'user.my-orders' to 'my-orders'
    }

    public function orderAgain($id)
    {
        $order = Order::where('user_id', auth()->id())
                     ->findOrFail($id);
                     
        // Logic untuk membuat order baru berdasarkan order sebelumnya
        
        return redirect()->back()->with('success', 'New order created successfully');
    }

    public function orderDetails($id)
    {
        $order = Order::where('user_id', auth()->id())
                     ->findOrFail($id);
                     
        return view('order-details', compact('order')); // Changed from 'user.order-details' to 'order-details'
    }

    public function cancelOrder($id)
    {
        $order = Order::where('user_id', auth()->id())
                     ->findOrFail($id);

        if ($order->status !== 'confirmed') {
            return redirect()->back()->with('error', 'This order cannot be cancelled');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Order cancelled successfully');
    }
}
