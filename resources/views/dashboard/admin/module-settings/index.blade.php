@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title }}</h1>

     <div class="d-flex align-items-center gap-3">
       <!-- Tombol Create -->
       <a href="{{ route('admin.module-settings.create') }}" class="btn btn-primary px-3">
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
                 <th>Module Name</th>
                 <th>Key</th>
                 <th>Value</th>
                 <th>Created At</th>
                 <th>Updated At</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               @foreach($moduleSettings as $setting)
               <tr>
                 <td>{{ $setting->id }}</td>
                 <td>{{ $setting->module_name }}</td>
                 <td>{{ $setting->key }}</td>
                 <td>{{ Str::limit($setting->value ?? '-', 50) }}</td>
                 <td>{{ $setting->created_at ? $setting->created_at->format('d M, Y') : '-' }}</td>
                 <td>{{ $setting->updated_at ? $setting->updated_at->format('d M, Y') : '-' }}</td>
                 <td>
                   <div class="btn-group" role="group">
                     <!-- Detail -->
                     <a href="{{ route('admin.module-settings.show', $setting->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <!-- Edit -->
                     <a href="{{ route('admin.module-settings.edit', $setting->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <!-- Delete -->
                     <form action="{{ route('admin.module-settings.destroy', $setting->id) }}" method="POST" style="display:inline;">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="btn btn-danger btn-sm me-1" title="Delete" onclick="return confirm('Are you sure you want to delete this setting?')">
                         <i class="fas fa-trash"></i>
                       </button>
                     </form>
                     <!-- Print PDF -->
                     <a href="{{ route('admin.module-settings.export-pdf') }}" target="_blank" class="btn btn-secondary btn-sm" title="Export PDF">
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
