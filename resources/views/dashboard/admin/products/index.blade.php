@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title ?? 'Daftar Products' }}</h1>

     <div class="d-flex align-items-center gap-3">
       <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-3">
         <i class="fas fa-plus me-2"></i> Tambah Product
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
                 <th>Name</th>
                 <th>Slug</th>
                 <th>Category</th>
                 <th>Price</th>
                 <th>Stock</th>
                 <th>Status</th>
                 <th>Short Description</th>
                 <th>Aksi</th>
               </tr>
             </thead>
             <tbody>
               @forelse($products as $product)
               <tr>
                 <td>{{ $loop->iteration }}</td>
                 <td>{{ Str::limit($product->name, 50) }}</td>
                 <td>{{ $product->slug }}</td>
                 <td>{{ $product->category_id ?? '-' }}</td>
                 <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                 <td>{{ $product->stock }}</td>
                 <td>{{ ucfirst($product->status) }}</td>
                 <td>{{ Str::limit($product->short_description ?? '-', 50) }}</td>
                 <td>
                   <div class="btn-group" role="group">
                     <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                   </div>
                 </td>
               </tr>
               @empty
               <tr>
                 <td colspan="9" class="text-center text-muted">Belum ada produk.</td>
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
