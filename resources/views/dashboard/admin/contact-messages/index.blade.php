@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title ?? 'Daftar Pesan' }}</h1>

     <!-- Tombol Tambah Pesan -->
     <div class="d-flex align-items-center gap-3">
     </div>
   </div>
</div>

<div class="container-fluid mt-4">
   <div class="row justify-content-center">
     <div class="col-12">
       <div class="card shadow">
         <div class="card-body">
           <table class="table datatables align-middle" id="dataTable-1">
             <thead class="thead-light">
               <tr>
                 <th>#</th>
                 <th>Nama</th>
                 <th>Email</th>
                 <th>Subjek</th>
                 <th>Pesan</th>
                 <th>Telepon</th>
                 <th>Status</th>
                 <th>Sudah Dibaca</th>
                 <th>Tanggal</th>
                 <th>Aksi</th>
               </tr>
             </thead>
             <tbody>
               @forelse($messages as $message)
               <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ Str::limit($message->name, 50) }}</td>
                 <td>{{ Str::limit($message->email, 50) }}</td>
                 <td>{{ Str::limit($message->subject ?? '-', 50) }}</td>
                 <td>{{ Str::limit($message->message, 50) }}</td>
                 <td>{{ $message->phone ?? '-' }}</td>
                 <td>{{ ucfirst($message->status) }}</td>
                 <td>
                   @if($message->is_read)
                     <span class="badge bg-success">Ya</span>
                   @else
                     <span class="badge bg-secondary">Belum</span>
                   @endif
                 </td>
                 <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                 <td>
                  <div class="btn-group" role="group">
                    <!-- Detail -->
                    <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                        <i class="fas fa-eye"></i>
                    </a>

                    <!-- Edit -->
                    <a href="{{ route('admin.contact-messages.edit', $message->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- Hapus -->
                    <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm me-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                 </td>
               </tr>
               @empty
               <tr>
                 <td colspan="10" class="text-center text-muted">Belum ada pesan.</td>
               </tr>
               @endforelse
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
</div>
@endsection
