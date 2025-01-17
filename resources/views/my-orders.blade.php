<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-sm">
            <!-- Filter Section -->
            <div class="p-4 border-b">
                <div class="flex gap-4">
                    <span class="text-gray-600">Show:</span>
                    <label class="inline-flex items-center">
                        <input type="radio" name="filter" value="all" class="form-radio" {{ request('filter', 'all') === 'all' ? 'checked' : '' }}>
                        <span class="ml-2">All</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="filter" value="confirmed" class="form-radio" {{ request('filter') === 'confirmed' ? 'checked' : '' }}>
                        <span class="ml-2">Confirmed</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="filter" value="in_transit" class="form-radio" {{ request('filter') === 'in_transit' ? 'checked' : '' }}>
                        <span class="ml-2">In Transit</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="filter" value="cancelled" class="form-radio" {{ request('filter') === 'cancelled' ? 'checked' : '' }}>
                        <span class="ml-2">Cancelled</span>
                    </label>
                </div>
            </div>

            <!-- Orders Table -->
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="p-4 text-left text-gray-600">ORDER ID</th>
                        <th class="p-4 text-left text-gray-600">DUE DATE</th>
                        <th class="p-4 text-left text-gray-600">PRICE</th>
                        <th class="p-4 text-left text-gray-600">STATUS</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">
                            <a href="{{ route('my.orders.details', $order->id) }}" class="text-blue-600 hover:underline">
                                #{{ $order->order_number }}
                            </a>
                        </td>
                        <td class="p-4">{{ $order->created_at->format('d M Y') }}</td>
                        <td class="p-4">${{ number_format($order->price, 2) }}</td>
                        <td class="p-4">
                            @switch($order->status)
                                @case('pre-order')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Pre-order</span>
                                    @break
                                @case('in_transit')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">In transit</span>
                                    @break
                                @case('confirmed')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Confirmed</span>
                                    @break
                                @case('cancelled')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Cancelled</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex justify-end items-center gap-2">
                                @if($order->status === 'confirmed')
                                    <form action="{{ route('my.orders.again', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-gray-600 hover:text-blue-600">
                                            Order again
                                        </button>
                                    </form>
                                    <form action="{{ route('my.orders.cancel', $order->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Cancel order
                                        </button>
                                    </form>
                                @endif
                                <div class="relative inline-block">
                                    <button class="p-2 hover:bg-gray-100 rounded-full">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No orders found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="p-4 flex items-center justify-between border-t">
                <div class="text-sm text-gray-600">
                    Showing {{ $orders->firstItem() ?? 0 }}-{{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }}
                </div>
                <div class="flex gap-2">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="filter"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                window.location.href = `{{ route('my.orders') }}?filter=${e.target.value}`;
            });
        });
    </script>
</body>
</html>