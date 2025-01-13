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
                <p class="text-2xl font-semibold">120</p>
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
                <p class="text-2xl font-semibold">854</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                <i class="fas fa-dollar-sign text-xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm text-gray-600">Revenue</h2>
                <p class="text-2xl font-semibold">$24,567</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg p-6 shadow-sm">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-500">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-sm text-gray-600">Growth</h2>
                <p class="text-2xl font-semibold">+12.5%</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Recent Activity</h3>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user text-blue-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">New user registered</p>
                        <p class="text-xs text-gray-500">2 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-green-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">New order received</p>
                        <p class="text-xs text-gray-500">15 minutes ago</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold">New review posted</p>
                        <p class="text-xs text-gray-500">1 hour ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Sales Overview</h3>
        </div>
        <div class="p-6">
            <div class="h-64 flex items-center justify-center">
                <p class="text-gray-500">Chart placeholder - Implement your chart here</p>
            </div>
        </div>
    </div>
</div>
@endsection
