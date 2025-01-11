@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Pengaturan</h1>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-6 border-b">
            <h3 class="text-lg font-semibold">Informasi Pengaturan</h3>
        </div>

        <!-- Settings Form Section -->
        <div class="p-6">
            <form action="#" method="POST">
                <div class="space-y-6">
                    <!-- Setting 1: Nama Pengguna -->
                    <div class="flex flex-col">
                        <label for="username" class="text-sm font-medium text-gray-700">Nama Pengguna</label>
                        <input type="text" id="username" name="username" class="mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Admin" />
                    </div>

                    <!-- Setting 2: Email -->
                    <div class="flex flex-col">
                        <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" class="mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="admin@example.com" />
                    </div>

                    <!-- Setting 3: Password -->
                    <div class="flex flex-col">
                        <label for="password" class="text-sm font-medium text-gray-700">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********" />
                    </div>

                    <!-- Setting 4: Konfirmasi Password -->
                    <div class="flex flex-col">
                        <label for="confirm-password" class="text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="********" />
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-6">
                    <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
