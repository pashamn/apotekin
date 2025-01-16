@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
   <div class="flex justify-between items-center mb-6 border-b pb-4">
       <h2 class="text-2xl font-bold text-gray-800">Detail Prescription</h2>
       <div class="flex space-x-3">
           <a href="{{ route('admin.prescriptions') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300">
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
               <a href="{{ route('admin.order', $prescription->id) }}" 
                  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300 flex items-center">
                   <i class="fas fa-plus mr-2"></i>Tambah Order
               </a>
               <button type="button" 
                       onclick="updateStatus('{{ $prescription->id }}')"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300 flex items-center">
                   <i class="fas fa-sync-alt mr-2"></i>Update Status
               </button>
           </div>
       </div>
   </div>
</div>

<!-- Script untuk Update Status -->
<script>
function updateStatus(prescriptionId) {
   const newStatus = prompt('Masukkan status baru (pending/processed/completed):');
   if (newStatus) {
       fetch(`/admin/prescriptions/${prescriptionId}/status`, {
           method: 'POST',
           headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
           },
           body: JSON.stringify({ status: newStatus })
       })
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               window.location.reload();
           } else {
               alert('Gagal mengupdate status');
           }
       })
       .catch(error => {
           console.error('Error:', error);
           alert('Terjadi kesalahan saat mengupdate status');
       });
   }
}
</script>
@endsection