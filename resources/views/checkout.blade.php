<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Sneekpeeks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('cart.view') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Cart
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column - Order Summary -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Order Summary</h2>
                <p class="text-gray-500 mb-6">Check your items. And select a suitable shipping method.</p>

                <div class="bg-white rounded-lg p-6 mb-6">
                    @foreach($carts as $cart)
                    <div class="flex items-center mb-4 pb-4 border-b last:border-b-0">
                        <img src="{{ asset('storage/' . $cart->product->image) }}" alt="{{ $cart->product->name }}" 
                             class="w-24 h-24 object-cover rounded-lg">
                        <div class="ml-4">
                            <h3 class="font-bold">{{ $cart->product->name }}</h3>
                            <p class="text-gray-500">Quantity: {{ $cart->quantity }}</p>
                            <p class="font-bold">${{ number_format($cart->product->price * $cart->quantity, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Shipping Methods -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Shipping Methods</h3>
                    <div class="space-y-4">
                        <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer border-blue-500">
                            <div class="flex items-center">
                                <img src="https://www.fedex.com/content/dam/fedex-com/logos/logo.png" alt="Fedex" class="h-8">
                                <div class="ml-4">
                                    <div class="font-bold">Fedex Delivery</div>
                                    <div class="text-gray-500">Delivery: 2-4 Days</div>
                                </div>
                            </div>
                            <input type="radio" name="shipping_method" value="fedex" checked class="w-5 h-5">
                        </label>
                        <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer">
                            <div class="flex items-center">
                                <img src="https://www.dhl.com/content/dam/dhl/global/core/images/logos/dhl-logo.svg" alt="DHL" class="h-8">
                                <div class="ml-4">
                                    <div class="font-bold">DHL Delivery</div>
                                    <div class="text-gray-500">Delivery: 2-4 Days</div>
                                </div>
                            </div>
                            <input type="radio" name="shipping_method" value="dhl" class="w-5 h-5">
                        </label>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Payment Method</h3>
                    <div class="space-y-4">
                        <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer border-blue-500">
                            <div class="flex items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/245px-Logo_QRIS.svg.png" alt="Fedex" class="h-8">
                                <div class="ml-4">
                                    <div class="font-bold">Qris</div>
                                </div>
                            </div>
                            <input type="radio" name="payment" value="fedex" checked class="w-5 h-5">
                        </label>
                        <label class="flex items-center justify-between p-4 border rounded-lg cursor-pointer">
                            <div class="flex items-center">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0iWsmy4Wl1XseUoHLLW8vBkahGkVbCeWvxw&s" alt="DHL" class="h-8">
                                <div class="ml-4">
                                    <div class="font-bold">Bank</div>
                                </div>
                            </div>
                            <input type="radio" name="payment" value="dhl" class="w-5 h-5">
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column - Payment Details -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Payment Details</h2>
                <p class="text-gray-500 mb-6">Complete your order by providing your details.</p>

                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                    <div>
                        <label class="block mb-2">Phone</label>
                        <input type="text" name="shipping_phone" placeholder="Your phone number" 
                               class="w-full p-3 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="block mb-2">Shipping Address</label>
                        <textarea name="shipping_address" placeholder="Your shipping address" 
                                  class="w-full p-3 border rounded-lg" required></textarea>
                    </div>

                    <div>
                        <label class="block mb-2">Notes</label>
                        <textarea name="notes" placeholder="Any additional notes (optional)" 
                                  class="w-full p-3 border rounded-lg"></textarea>
                    </div>

                    <!-- Payment Method (for display only) -->
                    

                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-lg font-bold hover:bg-gray-800 transition-colors">
                        Bayar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>