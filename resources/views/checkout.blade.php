<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Sneekpeeks</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <a href="{{ route('cart.view') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Cart
        </a>

        <!-- Header with Progress -->
        <div class="flex items-center justify-between mb-8">
            <div class="text-2xl font-bold">sneekpeeks</div>
            <div class="flex items-center gap-4">
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full bg-green-400 flex items-center justify-center text-white">✓</div>
                    <div class="ml-2">Shop</div>
                </div>
                <div class="text-gray-300">></div>
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full bg-gray-800 flex items-center justify-center text-white">2</div>
                    <div class="ml-2">Shipping</div>
                </div>
                <div class="text-gray-300">></div>
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-white">3</div>
                    <div class="ml-2">Payment</div>
                </div>
            </div>
        </div>

        <!-- Rest of the existing content remains exactly the same -->
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
            </div>

            <!-- Right Column - Payment Details -->
            <div>
                <h2 class="text-2xl font-bold mb-2">Payment Details</h2>
                <p class="text-gray-500 mb-6">Complete your order by providing your payment details.</p>

                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block mb-2">Email</label>
                        <input type="email" name="email" placeholder="your.email@gmail.com" 
                               class="w-full p-3 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="block mb-2">Card Holder</label>
                        <input type="text" name="card_holder" placeholder="YOUR FULL NAME HERE" 
                               class="w-full p-3 border rounded-lg" required>
                    </div>

                    <div>
                        <label class="block mb-2">Card Details</label>
                        <div class="grid grid-cols-6 gap-4">
                            <input type="text" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" 
                                   class="col-span-4 p-3 border rounded-lg" required>
                            <input type="text" name="expiry" placeholder="MM/YY" 
                                   class="col-span-1 p-3 border rounded-lg" required>
                            <input type="text" name="cvc" placeholder="CVC" 
                                   class="col-span-1 p-3 border rounded-lg" required>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2">Billing Address</label>
                        <div class="grid grid-cols-6 gap-4">
                            <input type="text" name="street" placeholder="Street Address" 
                                   class="col-span-4 p-3 border rounded-lg" required>
                            <select name="state" class="col-span-1 p-3 border rounded-lg" required>
                                <option value="">State</option>
                                <option value="JK">Jakarta</option>
                                <option value="JB">Jawa Barat</option>
                                <option value="JT">Jawa Tengah</option>
                                <option value="JI">Jawa Timur</option>
                            </select>
                            <input type="text" name="zip" placeholder="ZIP" 
                                   class="col-span-1 p-3 border rounded-lg" required>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white py-4 rounded-lg font-bold hover:bg-gray-800 transition-colors">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>