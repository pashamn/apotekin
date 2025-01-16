@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Daftar Prescription</h2>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($prescriptions as $index => $prescription)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ asset('storage/' . $prescription->image) }}" alt="Prescription Image" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prescription->user->name ?? 'Unknown' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prescription->status }}</td>    
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <button type="button" 
                                    onclick="window.location='{{ route('admin.prescriptions.show', $prescription->id) }}'"
                                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded flex items-center">
                                <i class="fas fa-search mr-1"></i> Show
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center px-6 py-4">Tidak ada data prescription</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $prescriptions instanceof \Illuminate\Pagination\LengthAwarePaginator ? $prescriptions->links() : '' }}
    </div>
</div>
@endsection