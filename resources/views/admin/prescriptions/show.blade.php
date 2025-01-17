@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
   <div class="flex justify-between items-center mb-6 border-b pb-4">
       <h2 class="text-2xl font-bold text-gray-800">Detail Prescription</h2>
       <div class="flex space-x-3">
           <a href="{{ route('prescriptions.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300">
               Kembali
           </a>
       </div>
   </div>

   <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
       <!-- Bagian Gambar -->
       <div class="col-span-1">
           <img src="{{ asset('storage/' . $prescription->image) }}" alt="Prescription Image" class="rounded-lg w-full object-cover shadow-md">
       </div>
       <!-- Bagian Detail Prescription -->
       <div class="col-span-2">
           <h3 class="text-2xl font-semibold mb-4 text-gray-800">{{ $prescription->user->name ?? 'Unknown' }}</h3>
           <p class="text-gray-700 mb-4">
               <strong>Status:</strong> 
               <span class="px-3 py-1 rounded-full text-sm
                   @if($prescription->status == 'pending')
                       bg-yellow-100 text-yellow-800
                   @elseif($prescription->status == 'processed') 
                       bg-blue-100 text-blue-800
                   @elseif($prescription->status == 'completed')
                       bg-green-100 text-green-800
                   @else
                       bg-gray-100 text-gray-800
                   @endif">
                   {{ $prescription->status }}
               </span>
           </p>
           <p class="text-gray-700 mb-4">
               <strong>Catatan:</strong>
           </p>
           <p class="text-gray-600 leading-relaxed mb-6">{{ $prescription->notes ?? 'Tidak ada catatan' }}</p>

           <!-- Tombol Actions -->
           <div class="flex space-x-3">
               <!-- Button trigger modal -->
               <button id="openModal" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md">
                   Update Status
               </button>
           </div>
       </div>
   </div>
</div>

<!-- Modal -->
<div id="exampleModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-lg font-medium text-gray-800">Persetujuan</h2>
            <button id="closeModal" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-4">
            <p class="text-gray-600 mb-4">Apakah Anda ingin menyetujui atau menolak pesanan ini?</p>
            <div class="flex justify-end space-x-2">
                <!-- Rejected Button -->
                <form action="{{ route('admin.prescriptions.reject', $prescription->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Rejected</button>
                </form>
                <!-- Accept Button -->
                <form action="{{ route('admin.prescriptions.approve', $prescription->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Accept</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Modal -->
<script>
    document.getElementById('openModal').addEventListener('click', () => {
        document.getElementById('exampleModal').classList.remove('hidden');
        document.getElementById('exampleModal').classList.add('flex');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('exampleModal').classList.add('hidden');
        document.getElementById('exampleModal').classList.remove('flex');
    });
</script>
@endsection
