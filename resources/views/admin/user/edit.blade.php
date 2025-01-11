@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Pengguna</h2>
        <a href="{{ route('admin.user') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ $user->name }}" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                placeholder="Nama Lengkap"
            >
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ $user->email }}" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                placeholder="Email"
            >
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
            <select 
                id="role" 
                name="role" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
        </div>

        <div class="flex items-center justify-center mt-6">
            <button 
                type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded focus:outline-none focus:shadow-outline"
            >
                Update
            </button>
        </div>
    </form>
</div>
@endsection
