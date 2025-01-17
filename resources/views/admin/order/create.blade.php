@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Tambah Order Baru</h2>
        <a href="{{ route('admin.order') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    {{-- Tampilkan pesan error jika ada --}}
    @if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form untuk menambah order baru --}}
    <form action="{{ route('admin.order.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <!-- Input Nama Pelanggan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
                <input type="text" name="customer_name" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('customer_name') }}">
            </div>

            <!-- Input Nomor Telepon -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="phone" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('phone') }}">
            </div>

            <!-- Input Alamat -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                <textarea name="address" rows="3" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('address') }}</textarea>
            </div>

            <!-- Pilih Produk -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Produk</label>
                <select name="product_id" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="" disabled selected>Pilih Produk</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input Jumlah -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="quantity" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                       value="{{ old('quantity', 1) }}" min="1">
            </div>

            <!-- Input Catatan -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Catatan Order</label>
                <textarea name="notes" rows="2" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('notes') }}</textarea>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-save mr-2"></i>Simpan Order
                </button>
            </div>
        </div>
    </form>
</div>
@endsection