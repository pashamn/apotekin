@extends('layouts.admin')

@section('content')
<div class="container mx-auto mt-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Kategori</h2>
        <a href="{{ route('admin.kategori') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded">
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

    <form action="{{ route('admin.kategori.update', $category->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ $category->name }}" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                placeholder="Nama Kategori"
            >
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                placeholder="Deskripsi"
            >{{ $category->description }}</textarea>
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
