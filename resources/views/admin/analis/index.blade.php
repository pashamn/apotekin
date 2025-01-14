@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800 font-poppins">Manajemen Analisis</h1>
        </div>
    </div>

    <!-- Alert Message -->
    <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative font-poppins">
        <span class="block sm:inline">Data berhasil ditambahkan!</span>
        <button class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold font-poppins">Daftar Analisis</h3>
        </div>
        
        <!-- Table Section -->
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-poppins">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-poppins">Nama Analisis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-poppins">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider font-poppins">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-poppins">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-poppins">Analisis 1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-poppins">2024-01-06</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 font-poppins">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Data">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-poppins">2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-poppins">Analisis 2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-poppins">2024-01-07</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 font-poppins">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Data">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-poppins">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-poppins">Analisis 3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-poppins">2024-01-08</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 font-poppins">
                                <button class="text-blue-500 hover:text-blue-700" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-yellow-500 hover:text-yellow-700" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700" title="Hapus Data">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex items-center justify-between font-poppins">
                <div class="text-sm text-gray-500">
                    Menampilkan 1-3 dari 3 analisis
                </div>
            </div>
             <!-- Pagination -->
             <div class="mt-4 flex items-center justify-between font-poppins">
                <div class="text-sm text-gray-500">
                    Menampilkan 1-3 dari 3 data
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
