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

        <a href="/" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back
        </a>

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
                        <input type="radio" name="filter" value="processing" class="form-radio" {{ request('filter') === 'processing' ? 'checked' : '' }}>
                        <span class="ml-2">Processing</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="filter" value="completed" class="form-radio" {{ request('filter') === 'completed' ? 'checked' : '' }}>
                        <span class="ml-2">Completed</span>
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
                        <td class="p-4">Rp {{ number_format($order->total_amount,  0, ',', '.') }}</td>
                        <td class="p-4">
                            @switch($order->status)
                                @case('pending')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Pending</span>
                                    @break
                                @case('processing')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Processing</span>
                                    @break
                                @case('completed')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Completed</span>
                                    @break
                                @case('cancelled')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">Cancelled</span>
                                    @break
                            @endswitch
                        </td>
                        <td class="p-4 text-right">
                            <div class="relative inline-block">
                                <button class="p-2 hover:bg-gray-100 rounded-full dropdown-toggle">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden dropdown-menu">
                                    <a href="{{ route('my.orders.details', $order->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Order details</a>
                                    @if($order->status !== 'cancelled' && $order->status !== 'completed')
                                    <form action="{{ route('my.orders.cancel', $order->id) }}" method="POST" class="block">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100">Cancel order</button>
                                    </form>
                                    @endif
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

        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                toggle.nextElementSibling.classList.toggle('hidden');
            });
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-toggle')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
