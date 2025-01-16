@extends('layouts.app')

@section('content')
<main class="font-sans">
    <div class="max-w-7xl mx-auto px-4 py-8">
        {{-- Upload Resep Banner --}}
        <div class="bg-blue-100 rounded-lg p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-blue-800 mb-2">
                        Upload Resep Dokter
                    </h2>
                    <p class="text-blue-600">
                        Unggah resep dokter Anda dan kami akan menyiapkan obatnya
                    </p>
                </div>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Upload Sekarang
                </button>
            </div>
        </div>

        {{-- Categories Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
            <a href="#" class="block p-6 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition-colors">
                <div class="text-center">
                    <h3 class="font-semibold text-lg">{{ $category['name'] }}</h3>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Products Grid --}}
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
    </div>

    {{-- About Section --}}
    <section id="about" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">About Apotek Online</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-1 gap-12 items-center text-center">
                <div class="space-y-6 max-w-3xl mx-auto">
                    <p class="text-gray-600">
                        Apotek Online hadir untuk memberikan layanan kesehatan terbaik dengan akses mudah ke berbagai produk farmasi berkualitas. Kami berkomitmen untuk:
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start justify-center">
                            <svg class="w-6 h-6 text-blue-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600 max-w-md">Menyediakan obat-obatan berkualitas dengan harga terjangkau</span>
                        </li>
                        <li class="flex items-start justify-center">
                            <svg class="w-6 h-6 text-blue-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600 max-w-md">Layanan konsultasi dengan apoteker profesional</span>
                        </li>
                        <li class="flex items-start justify-center">
                            <svg class="w-6 h-6 text-blue-500 mt-1 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-600 max-w-md">Pengiriman cepat dan aman ke seluruh Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>



    {{-- Contact Us Section --}}
    <section id="contact" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Contact Us</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto"></div>
                <p class="mt-4 text-gray-600">Kami siap membantu Anda. Hubungi kami melalui:</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Alamat --}}
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Alamat</h3>
                        <p class="mt-1 text-gray-600">Jl. Kesehatan No. 123<br>Jakarta Pusat, 10110</p>
                    </div>
                </div>

                {{-- Telepon --}}
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Telepon</h3>
                        <p class="mt-1 text-gray-600">+62 21 1234 5678</p>
                        <p class="text-gray-600">Hotline: 0800-1234-5678</p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Email</h3>
                        <p class="mt-1 text-gray-600">info@apotekonline.com</p>
                        <p class="text-gray-600">cs@apotekonline.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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