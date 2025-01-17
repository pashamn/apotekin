<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
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

    public function orderDetails($id)
    {
        $orderitem = Order::where('user_id', auth()->id())
                     ->with('orderItems.product') // Include order items
                     ->findOrFail($id);

        $order = Order::where('user_id', auth()->id())
                    ->with('orderItems') // Include order items
                    ->findOrFail($id);
        $kirim = 10000;
                     
        return view('order-detail', compact('orderitem','order','kirim')); // Changed from 'user.order-details' to 'order-details'
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

    public function fetchOrderItems($id)
    {
        $order = Order::where('user_id', auth()->id())
                     ->with('orderItems')
                     ->findOrFail($id);

        return response()->json(["order_items" => $order->orderItems]);
    }
}
