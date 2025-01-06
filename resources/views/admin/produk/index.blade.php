@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Manajemen Produk</h1>
            <button class="px-4 py-2 bg-green-500 text-white rounded-lg flex items-center hover:bg-green-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah Produk Baru
            </button>
        </div>
    </div>

    <!-- Alert Message -->
    <div class="mb-6 bg-blue-100 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg relative">
        <span class="block sm:inline">Produk berhasil diperbarui!</span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Daftar Produk</h3>
        </div>

        <!-- Table Section -->
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Paracetamol</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Obat Umum</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp5.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">100</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Produk">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Produk">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Amoxicillin</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Antibiotik</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp10.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">50</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Produk">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Produk">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Menampilkan 1-2 dari 2 produk
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded text-gray-500 hover:bg-gray-50">Sebelumnya</button>
                    <button class="px-3 py-1 border rounded bg-green-500 text-white">1</button>
                    <button class="px-3 py-1 border rounded text-gray-500 hover:bg-gray-50">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
@endsection
