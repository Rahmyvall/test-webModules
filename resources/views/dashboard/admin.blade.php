@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Selamat Datang di Dashboard Admin 👋</h3>
            <p class="mb-0">Halo, <strong>{{ auth()->user()->name }}</strong>!</p>
            <p class="mb-0">Anda login sebagai <strong>{{ auth()->user()->roles->name ?? 'Role belum ditentukan' }}</strong>.</p>
        </div>
        <div>
            <span class="badge bg-primary fs-6">Admin Panel</span>
        </div>
    </div>

    {{-- Statistik Kartu --}}
    <div class="row g-3 mb-4">
        <!-- Total Messages -->
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm text-white bg-primary">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-center">
                        <i class="fe fe-mail fe-32"></i>
                    </div>
                    <div>
                        <p class="small mb-1">Total Messages</p>
                        <h4 class="mb-0">{{ $totalMessages }} <span class="small text-success">+{{ $newMessagesPercent }}%</span></h4>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Unread Messages -->
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-center bg-warning rounded-circle p-2">
                        <i class="fe fe-eye-off fe-24 text-white"></i>
                    </div>
                    <div>
                        <p class="small mb-1 text-muted">Unread Messages</p>
                        <h4 class="mb-0">{{ $unreadMessages }}</h4>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Replied Messages -->
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-center bg-success rounded-circle p-2">
                        <i class="fe fe-check-circle fe-24 text-white"></i>
                    </div>
                    <div>
                        <p class="small mb-1 text-muted">Replied Messages</p>
                        <h4 class="mb-0">{{ $repliedMessages }}</h4>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Archived Messages -->
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-center bg-secondary rounded-circle p-2">
                        <i class="fe fe-archive fe-24 text-white"></i>
                    </div>
                    <div>
                        <p class="small mb-1 text-muted">Archived Messages</p>
                        <h4 class="mb-0">{{ $archivedMessages }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Recent Orders Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Last Orders</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category?->name ?? '-' }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        @if($product->status == 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($product->status == 'inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @else
                                            <span class="badge bg-warning">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('products.print', $product->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="bi bi-printer"></i> Print
                                        </a>
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
</div>
@endsection

