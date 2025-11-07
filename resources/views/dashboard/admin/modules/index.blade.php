@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title }}</h1>

     <div class="d-flex align-items-center gap-3">
       <!-- Tombol Create -->
       <a href="{{ route('admin.modules.create') }}" class="btn btn-primary px-3">
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
                 <th>Version</th>
                 <th>Status</th>
                 <th>Installed At</th>
                 <th>Created At</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               @foreach($modules as $module)
               <tr>
                 <td>{{ $module->id }}</td>
                 <td>{{ $module->name }}</td>
                 <td>{{ $module->display_name }}</td>
                 <td>{{ $module->description ?? '-' }}</td>
                 <td>{{ $module->version ?? '-' }}</td>
                 <td>
                   <span class="badge bg-{{ $module->status === 'active' ? 'success' : 'warning' }}">
                     {{ ucfirst($module->status) }}
                   </span>
                 </td>
                 <td>{{ $module->installed_at ? $module->installed_at->format('d M, Y') : '-' }}</td>
                 <td>{{ $module->created_at->format('d M, Y') }}</td>
                 <td>
                   <div class="btn-group" role="group">
                     <!-- Detail -->
                     <a href="{{ route('admin.modules.show', $module->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <!-- Edit -->
                     <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <!-- Delete -->
                     <form action="{{ route('admin.modules.destroy', $module->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Delete" onclick="return confirm('Are you sure?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                     <!-- Print -->
                     <a href="{{ route('admin.modules.export-pdf') }}" target="_blank" class="btn btn-secondary btn-sm" title="Print PDF">
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
