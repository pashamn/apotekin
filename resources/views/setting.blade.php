@extends('layouts.app')

@section('content')
<main class="font-sans">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Pengaturan Akun</h2>
                <div class="w-20 h-1 bg-blue-500"></div>
            </div>

            <form action="{{route('my.setting.update', Auth::user()->id)}}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Personal Information --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ $users->name }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ $users->email }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" 
                               id="phone" 
                               name="phone" 
                               value="{{ $users->phone }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" 
                                   id="password" 
                                   name="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea id="address" 
                              name="address" 
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $users->alamat }}</textarea>
                </div>
                {{-- Buttons --}}
                <div class="flex justify-end space-x-4 pt-6">
                    <button type="button" 
                            onclick="window.history.back()"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

@if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg" 
         role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="fixed bottom-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg" 
         role="alert">
        {{ session('error') }}
    </div>
@endif
@endsection