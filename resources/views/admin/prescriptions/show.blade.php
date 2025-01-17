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
               <!-- Tambah Order -->
               <!-- <button type="button" 
                  onclick="addOrder('{{ $prescription->id }}')"
                  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300 flex items-center">
                   <i class="fas fa-plus mr-2"></i>Tambah Order
               </button> -->
               <!-- Update Status -->
               <!-- <button type="button" 
                       onclick="updateStatus('{{ $prescription->id }}')"
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all duration-300 flex items-center">
                   <i class="fas fa-sync-alt mr-2"></i>Update Status
               </button> -->
               <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Update Status
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Persetujuan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <button type="button" class="btn btn-secondary">Rejected</button>
      <button type="button" class="btn btn-primary"><a href="{{route('admin.order.create')}}">Accept</a></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
           </div>
       </div>
   </div>
</div>

<!-- Script untuk Update Status -->
<!-- <script>
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
} -->

<!-- // Script untuk Tambah Order -->
<!-- function addOrder(prescriptionId) {
   const productId = prompt('Masukkan ID produk:');
   const quantity = prompt('Masukkan jumlah produk:');
   if (productId && quantity) {
       fetch(`/admin/prescriptions/${prescriptionId}/add-order`, {
           method: 'POST',
           headers: {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
           },
           body: JSON.stringify({ product_id: productId, quantity: quantity })
       })
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               alert('Order berhasil ditambahkan!');
               window.location.reload();
           } else {
               alert('Gagal menambah order');
           }
       })
       .catch(error => {
           console.error('Error:', error);
           alert('Terjadi kesalahan saat menambah order');
       });
   }
} -->
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
