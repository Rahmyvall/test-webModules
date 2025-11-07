@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
   <div class="col-12 d-flex justify-content-between align-items-center">
     <h1 class="page-title">{{ $title }}</h1>

     <div class="d-flex align-items-center gap-3">
       <!-- Tombol Export Excel -->
       <a href="#" class="btn btn-success px-3">
         <i class="fas fa-file-excel me-2"></i> Export Excel
       </a>

       <!-- Tombol Create -->
       <a href="#" class="btn btn-primary px-3">
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
                 <th></th>
                 <th>#</th>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Department</th>
                 <th>Company</th>
                 <th>Address</th>
                 <th>City</th>
                 <th>Date</th>
                 <th>Action</th>
               </tr>
             </thead>
             <tbody>
               <tr>
                 <td>
                   <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input" id="check1">
                     <label class="custom-control-label" for="check1"></label>
                   </div>
                 </td>
                 <td>368</td>
                 <td>Imani Lara</td>
                 <td>(478) 446-9234</td>
                 <td>Asset Management</td>
                 <td>Borland</td>
                 <td>9022 Suspendisse Rd.</td>
                 <td>High Wycombe</td>
                 <td>Jun 8, 2019</td>
                 <td>
                   <div class="btn-group" role="group">
                     <!-- Detail -->
                     <a href="#" class="btn btn-info btn-sm me-1" title="Detail">
                       <i class="fas fa-eye"></i>
                     </a>
                     <!-- Edit -->
                     <a href="#" class="btn btn-warning btn-sm me-1" title="Edit">
                       <i class="fas fa-edit"></i>
                     </a>
                     <!-- Delete -->
                     <a href="#" class="btn btn-danger btn-sm me-1" title="Delete" onclick="return confirm('Are you sure?')">
                       <i class="fas fa-trash"></i>
                     </a>
                     <!-- Print -->
                     <a href="#" class="btn btn-secondary btn-sm" title="Print">
                       <i class="fas fa-print"></i>
                     </a>
                   </div>
                 </td>
               </tr>
             </tbody>
           </table>
         </div>
       </div>
     </div>
   </div>
</div>
@endsection
