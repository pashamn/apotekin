<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <a href="{{ route('my.orders') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to My Orders
        </a>
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4">Order #{{ $order->order_number }}</h2>
            <p class="text-gray-600">Status: {{ $order->status }}</p>
            <table class="w-full mt-4 border">
                <thead>
                    <tr>
                        <th class="p-4 text-left">Item Name</th>
                        <th class="p-4 text-left">Quantity</th>
                        <th class="p-4 text-left">Price</th>
                        <th class="p-4 text-left">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderitem->orderItems as $item)
                    <tr>
                        <td class="p-4">{{ $item->product->name ?? 'N/A' }}</td>
                        <td class="p-4">{{ $item->quantity }}</td>
                        <td class="p-4">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="p-4">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr style="margin: 10px 0; border: 1px gray-100;">
            <h3 class="text-lg  mb-4">Biaya Pengiriman : Rp {{ number_format($kirim, 0, ',', '.') }}</h3>
            <h2 class="text-lg font-semibold mb-4">Total Orders : Rp {{ number_format($order->total_amount, 0, ',', '.') }}</h2>
        </div>
    </div>
</body>
</html>
