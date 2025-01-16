<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shopping Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->

        <h1 class="text-2xl font-semibold mb-6">Shopping Cart</h1>

        <!-- Cart Items -->
        <div class="space-y-4 mb-8">
            @forelse ($carts as $cart)
                <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow">
                    <div class="flex items-center space-x-4">
                        <!-- Product Image -->
                        <div class="w-12 h-12 bg-gray-200 rounded">
                            <img src="{{ asset('storage/' . $cart->product->image) }}" 
                                 alt="{{ $cart->product->name }}" class="w-full h-full rounded object-cover">
                        </div>
                        <!-- Product Name -->
                        <div>
                            <h3 class="font-medium">{{ $cart->product->name }}</h3>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Quantity Buttons -->
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full btn-update-quantity" 
                                    data-cart-id="{{ $cart->id }}" data-action="decrease">
                                <span class="text-lg">-</span>
                            </button>
                            <span class="quantity-display">{{ $cart->quantity }}</span>
                            <button class="w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full btn-update-quantity" 
                                    data-cart-id="{{ $cart->id }}" data-action="increase">
                                <span class="text-lg">+</span>
                            </button>
                        </div>

                        <!-- Product Price -->
                        <div class="w-24 text-right">${{ number_format($cart->product->price, 2) }}</div>
                        <!-- Remove Button -->
                        <button class="text-gray-500 hover:text-red-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-600">
                    Your cart is empty.
                </div>
            @endforelse
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-lg p-6 shadow">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
            <div class="space-y-3">
                <!-- <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div> -->
                <div class="pt-3 border-t border-gray-200">
                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 grid grid-cols-2 gap-4">
                <button 
                    class="w-full py-3 px-4 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 transition"
                    onclick="window.location.href='{{ url()->previous() }}'">
                    Continue Shopping
                </button>

                <button class="w-full py-3 px-4 rounded bg-blue-600 hover:bg-blue-700 text-white transition">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/cart.js') }}"></script>
</body>
</html>
