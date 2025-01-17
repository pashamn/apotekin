@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Hasil Pencarian untuk: "{{ $query }}"</h1>

    @if($products->isEmpty())
        <p class="text-gray-600">Tidak ada produk yang ditemukan.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mt-8">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg p-4 transform hover:scale-105 hover:shadow-xl transition-transform duration-300">
                <a href="{{ route('product.show', $product->id) }}" class="block">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4 hover:opacity-90 transition-opacity duration-300">
                </a>
                <div>
                    <h3 class="text-lg font-bold">
                        <a href="{{ route('product.show', $product->id) }}" class="hover:text-blue-500 transition-colors duration-300">
                            {{ $product->name }}
                        </a>
                    </h3>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 50) }}</p>
                    <p class="text-primary text-xl font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <button 
                        class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors duration-300 add-to-cart" 
                        data-product-id="{{ $product->id }}">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                
                fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }
                    throw new Error('Gagal menambahkan produk ke keranjang.');
                })
                .then(data => {
                    alert(data.message || 'Produk berhasil ditambahkan ke keranjang.');
                })
                .catch(error => {
                    alert(error.message);
                });
            });
        });
    });
</script>
@endsection
