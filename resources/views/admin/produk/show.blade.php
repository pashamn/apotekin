@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Detail Produk</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Bagian Gambar -->
        <div class="col-span-1">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-lg w-full object-cover shadow-md">
        </div>
        <!-- Bagian Detail Produk -->
        <div class="col-span-2">
            <h3 class="text-2xl font-semibold mb-4 text-gray-800">{{ $product->name }}</h3>
            <p class="text-xl text-black-600 font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="text-gray-700 mb-4">
                <strong>Kategori:</strong> {{ $product->category->name ?? 'Tidak ada kategori' }}
            </p>
            <p class="text-gray-700 mb-4">
                <strong>Stok:</strong> {{ $product->stock }}
            </p>
            <p class="text-gray-700 mb-4">
                <strong>Deskripsi:</strong>
            </p>
            <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
        </div>
    </div>
    <!-- Tombol Kembali -->
    <div class="mt-8 flex justify-end">
        <a href="{{ route('admin.produk') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-300">
            Kembali
        </a>
    </div>
</div>
@endsection
