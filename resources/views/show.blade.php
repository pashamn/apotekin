@extends('layouts.app')

@section('content')
<main class="max-w-4xl mx-auto px-4 py-8 font-sans relative">
    {{-- Tombol Kembali di Pojok Kiri --}}
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline flex items-center gap-1">
            ← Kembali
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-6">
        {{-- Gambar Produk --}}
        <div class="flex-1">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg shadow-lg">
        </div>

        {{-- Detail Produk --}}
        <div class="flex-1 flex flex-col">
            {{-- Nama dan Deskripsi Produk --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            </div>

            {{-- Harga, Kuantitas, dan Tombol --}}
            <div class="mt-auto">
                {{-- Harga --}}
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-700 mb-2">Harga</h2>
                    <p class="text-primary text-2xl font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                {{-- Garis Pemisah --}}
                <div class="border-t border-gray-300 pt-6">
                    {{-- Pilihan Kuantitas --}}
                    <div class="flex items-center gap-4 mb-6">
                        <label for="quantity" class="font-medium text-gray-700">Kuantitas:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 text-center border border-gray-300 rounded-lg shadow-sm">
                    </div>

                    {{-- Tombol --}}
                    <button class="w-full bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection