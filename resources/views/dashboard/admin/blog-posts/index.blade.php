@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title ?? 'Daftar Blog Posts' }}</h1>

     <div class="d-flex align-items-center gap-3">
       <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary px-3">
         <i class="fas fa-plus me-2"></i> Tambah Blog Post
       </a>
       <a href="{{ route('admin.blog-posts.export-pdf') }}" class="btn btn-secondary px-3" target="_blank">
         <i class="fas fa-file-pdf me-2"></i> Export PDF
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
                 <th>Title</th>
                 <th>Slug</th>
                 <th>Category</th>
                 <th>Author</th>
                 <th>Status</th>
                 <th>Published At</th>
                 <th>Excerpt</th>
                 <th>Featured Image</th>
                 <th>Aksi</th>
               </tr>
             </thead>
             <tbody>
               @forelse($blogPosts as $post)
               <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ Str::limit($post->title, 50) }}</td>
                 <td>{{ $post->slug }}</td>
                 <td>{{ $post->category?->name ?? '-' }}</td>
                 <td>{{ $post->author?->name ?? '-' }}</td>
                 <td>{{ ucfirst($post->status) }}</td>
                 <td>{{ $post->published_at?->format('d M Y') ?? '-' }}</td>
                 <td>{{ Str::limit($post->excerpt ?? '-', 50) }}</td>
                 <td>
                   @if($post->featured_image)
                     <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image" class="img-thumbnail" style="width:50px;height:50px;">
                   @else
                     -
                   @endif
                 </td>
                 <td>
                   <div class="btn-group" role="group">
                     <a href="{{ route('admin.blog-posts.show', $post->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <a href="{{ route('admin.blog-posts.edit', $post->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <form action="{{ route('admin.blog-posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus blog post ini?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                   </div>
                 </td>
               </tr>
               @empty
               <tr>
                 <td colspan="10" class="text-center text-muted">Belum ada blog post.</td>
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
