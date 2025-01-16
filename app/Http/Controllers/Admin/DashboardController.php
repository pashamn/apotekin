<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil statistik untuk dashboard
        $totalUsers = User::count();
        $totalOrders = Order::count();
        
        // Mengambil data terbaru
        $recentOrders = Order::with('user')
                            ->latest()
                            ->take(5)
                            ->get();
        
        $recentUsers = User::latest()
                          ->take(5)
                          ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'recentOrders',
            'recentUsers'
        ));
    }

    public function produk()
    {
        return view('admin.produk.index');
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function order()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    public function categories()
    {
        return view('admin.categories.index');
    }

    public function analis()
    {
        return view('admin.analis.index');
    }

    public function seting()
    {
        return view('admin.seting.index');
    }
}