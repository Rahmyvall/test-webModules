@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title }}</h1>

     <div class="d-flex align-items-center gap-3">
       <!-- Tombol Create -->
       <a href="{{ route('admin.roles.create') }}" class="btn btn-primary px-3">
         <i class="fas fa-plus me-2"></i> Create
       </a>
     </div>
   </div>
</div>

<div class="container-fluid mt-4">
   <div class="row justify-content-center">
     <div class="col-12">
       <div class="card shadow">
         <div class="card-body">
           <!-- table -->
           <table class="table datatables align-middle" id="dataTable-1">
             <thead class="thead-light">
               <tr>
                 <th>#</th>
                 <th>Name</th>
                 <th>Display Name</th>
                 <th>Description</th>
                 <th>Status</th>
                 <th>Created At</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               @foreach($roles as $role)
               <tr>
                 <td>{{ $role->id }}</td>
                 <td>{{ $role->name }}</td>
                 <td>{{ $role->display_name }}</td>
                 <td>{{ $role->description ?? '-' }}</td>
                 <td>{{ ucfirst($role->status ?? 'active') }}</td>
                 <td>{{ $role->created_at->format('d M, Y') }}</td>
                 <td>
                   <div class="btn-group" role="group">
                     <!-- Detail -->
                     <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <!-- Edit -->
                     <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <!-- Delete -->
                     <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Delete" onclick="return confirm('Are you sure?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                     <!-- Print -->
                     <a href="{{ route('admin.roles.export-pdf') }}" target="_blank" class="btn btn-secondary btn-sm" title="Print PDF">
                       <i class="fas fa-print"></i>
                     </a>
                   </div>
                 </td>
               </tr>
               @endforeach
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
</div>
@endsection
