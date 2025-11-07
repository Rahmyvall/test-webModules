@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title ?? 'Daftar Kategori Blog' }}</h1>

     <div class="d-flex align-items-center gap-3">
       <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary px-3">
         <i class="fas fa-plus me-2"></i> Tambah Kategori
       </a>
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
                 <th>Nama Kategori</th>
                 <th>Slug</th>
                 <th>Deskripsi</th>
                 <th>Status</th>
                 <th>Dibuat</th>
                 <th>Diperbarui</th>
                 <th>Aksi</th>
               </tr>
             </thead>
             <tbody>
               @forelse($blogCategories as $category)
               <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ $category->name }}</td>
                 <td>{{ $category->slug }}</td>
                 <td>{{ Str::limit($category->description ?? '-', 50) }}</td>
                 <td>
                   <button class="btn btn-sm toggle-status {{ $category->is_active ? 'btn-success' : 'btn-secondary' }}" 
                           data-id="{{ $category->id }}">
                       {{ $category->is_active ? 'Active' : 'Inactive' }}
                   </button>
                 </td>
                 <td>{{ $category->created_at?->format('d M Y') ?? '-' }}</td>
                 <td>{{ $category->updated_at?->format('d M Y') ?? '-' }}</td>
                 <td>
                   <div class="btn-group" role="group">
                     <a href="{{ route('admin.blog-categories.show', $category->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <form action="{{ route('admin.blog-categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                   </div>
                 </td>
               </tr>
               @empty
               <tr>
                 <td colspan="8" class="text-center text-muted">Belum ada kategori.</td>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.toggle-status');

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {
            const categoryId = this.dataset.id;
            const token = '{{ csrf_token() }}';
            const button = this;

            fetch(`/admin/blog-categories/${categoryId}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.is_active) {
                        button.classList.remove('btn-secondary');
                        button.classList.add('btn-success');
                        button.textContent = 'Active';
                    } else {
                        button.classList.remove('btn-success');
                        button.classList.add('btn-secondary');
                        button.textContent = 'Inactive';
                    }
                } else {
                    alert('Gagal mengubah status.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan.');
            });
        });
    });
});
</script>
@endsection
