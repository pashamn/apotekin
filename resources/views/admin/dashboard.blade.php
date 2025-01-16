@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg p-6 shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm text-gray-600">Total Users</h2>
                <p class="text-2xl font-semibold">{{ $totalUsers }}</p> <!-- Mengambil dari controller -->
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500">
                <i class="fas fa-shopping-cart text-xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm text-gray-600">Total Orders</h2>
                <p class="text-2xl font-semibold">{{ $totalOrders }}</p> <!-- Mengambil dari controller -->
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Recent Users</h3>
        </div>
        <div class="p-6">
            <ul class="space-y-4">
                @foreach ($recentUsers as $user)
                    <li>
                        <p class="text-sm font-semibold">{{ $user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Recent Orders</h3>
        </div>
        <div class="p-6">
            <ul class="space-y-4">
            @foreach ($recentOrders as $order)
    <li>
        <p class="text-sm font-semibold">Order #{{ $order->id }}</p>
        <p class="text-xs text-gray-500">
            By {{ $order->user->name ?? 'Unknown User' }} - 
            {{ $order->created_at ? $order->created_at->diffForHumans() : 'No Date' }}
        </p>
    </li>
@endforeach

            </ul>
        </div>
    </div>
</div>
@endsection
