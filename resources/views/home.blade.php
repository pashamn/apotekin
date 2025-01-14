@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-4 py-8 font-sans">
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
            <div class="flex items-center space-x-3">
                <span class="text-2xl">{!! $category['icon'] !!}</span>
                <span class="font-medium">{{ $category['name'] }}</span>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg p-4">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                <div>
                    <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $product->description }}</p>
                    <p class="text-primary text-xl font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <button class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection
