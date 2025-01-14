@extends('layouts.admin')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Detail Order</h1>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-lg font-medium text-gray-800 mb-4">Informasi Order</h2>
        <div class="mb-4">
            <p><strong>Nomor Order:</strong> {{ $order->id }}</p>
            <p><strong>Nama Pemesan:</strong> {{ $order->user->name ?? 'Tidak Diketahui' }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_amount, 2, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>

        <h2 class="text-lg font-medium text-gray-800 mb-4">Item dalam Order</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($detail as $index => $d)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $d->product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $d->product->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $d->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($d->subtotal, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.order') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
                Kembali ke Daftar Order
            </a>
        </div>
    </div>
@endsection
