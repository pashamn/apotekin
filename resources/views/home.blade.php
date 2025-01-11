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

    {{-- Products Grid akan ditambahkan di sini --}}
</main>
@endsection
