@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center mb-3">
     <h1 class="page-title">{{ $title ?? 'Contact Settings' }}</h1>
   </div>
</div>

<div class="container-fluid mt-2">
   <div class="row justify-content-center">
     <div class="col-12">
       <div class="card shadow">
         <div class="card-body">
           <table class="table datatables align-middle" id="dataTable-1">
             <thead class="thead-light">
               <tr>
                 <th>#</th>
                 <th>Key</th>
                 <th>Value</th>
                 <th>Dibuat</th>
                 <th>Diperbarui</th>
                 <th>Aksi</th>
               </tr>
             </thead>
             <tbody>
               @forelse($settings as $setting)
               <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ $setting->key }}</td>
                 <td>{{ Str::limit($setting->value ?? '-', 50) }}</td>
                 <td>{{ $setting->created_at?->format('d M Y H:i') ?? '-' }}</td>
                 <td>{{ $setting->updated_at?->format('d M Y H:i') ?? '-' }}</td>
                 <td>
                   <div class="btn-group" role="group">
                     <a href="{{ route('admin.contact-settings.edit', $setting->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <form action="{{ route('admin.contact-settings.destroy', $setting->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus setting ini?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                   </div>
                 </td>
               </tr>
               @empty
               <tr>
                 <td colspan="6" class="text-center text-muted">Belum ada setting.</td>
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
