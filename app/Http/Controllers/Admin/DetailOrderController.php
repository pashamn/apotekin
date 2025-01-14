<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\User;

class DetailOrderController extends Controller
{
    /**
     * Show the details of a specific order.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
{
    $order = Order::with('user')->findOrFail($id);
    $detail = OrderItem::with('product')->where('order_id', '=', $id)->get();
    return view('admin.order.detailorder', compact('order', 'detail'));
}

    
}
