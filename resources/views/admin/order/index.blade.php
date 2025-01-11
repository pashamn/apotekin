@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Manajemen Order</h1>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg flex items-center hover:bg-blue-600 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah Order Baru
            </button>
        </div>
    </div>

    <!-- Alert Message -->
    <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative">
        <span class="block sm:inline">Order berhasil ditambahkan!</span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Daftar Order</h3>
        </div>
        
        <!-- Table Section -->
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Order</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">John Doe</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Produk A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-01-06</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Order">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Order">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Jane Smith</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Produk B</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-01-06</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Order">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Order">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Alice Johnson</td>
                            <td class="px-6 py-4 text-sm text-gray-500">Produk C</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-01-06</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Order">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Order">
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
                    Menampilkan 1-3 dari 3 order
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border rounded text-gray-500 hover:bg-gray-50">Sebelumnya</button>
                    <button class="px-3 py-1 border rounded bg-blue-500 text-white">1</button>
                    <button class="px-3 py-1 border rounded text-gray-500 hover:bg-gray-50">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
@endsection
