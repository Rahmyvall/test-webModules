@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Selamat Datang di Dashboard User 👋</h3>
            <p class="mb-0">Halo, <strong>{{ auth()->user()->name }}</strong>!</p>
            <p class="mb-0">Anda login sebagai <strong>{{ auth()->user()->role->name ?? 'Role belum ditentukan' }}</strong>.</p>
        </div>
        <div>
            <span class="badge bg-primary fs-6">User Panel</span>
        </div>
    </div>

    {{-- Statistik Kartu --}}
    <div class="row g-3 mb-4">
        <div class="col-md-12 col-xl-3">
            <div class="card shadow-sm text-white bg-primary">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-center">
                        <i class="fe fe-shopping-bag fe-32"></i>
                    </div>
                    <div>
                        <p class="small mb-1">Monthly Sales</p>
                        <h4 class="mb-0">$1,250 <span class="small text-success">+5.5%</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 text-center bg-primary rounded-circle p-2">
                        <i class="fe fe-shopping-cart fe-24 text-white"></i>
                    </div>
                    <div>
                        <p class="small mb-1 text-muted">Orders</p>
                        <h4 class="mb-0">1,869 <span class="small text-success">+16.5%</span></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="small text-muted mb-1">Conversion</p>
                    <h4 class="mb-2">86.6%</h4>
                    <div class="progress" style="height:4px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 87%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="small text-muted mb-1">AVG Orders</p>
                    <h4 class="mb-0">$80</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="columnChart" style="height: 300px;"></div>
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
                                    <th>Purchase Date</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1331</td>
                                    <td>2020-12-26</td>
                                    <td>Kasimir Lindsey</td>
                                    <td>(697) 486-2101</td>
                                    <td>996-3523 Et Ave</td>
                                    <td>$3.64</td>
                                    <td>Paypal</td>
                                    <td><span class="badge bg-success">Shipped</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Remove</a></li>
                                                <li><a class="dropdown-item" href="#">Assign</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Tambahkan row lain sesuai data --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
