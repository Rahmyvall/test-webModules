@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Roles List</h2>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print me-1"></i> Print
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped mb-0">
                    <thead class="table-success">
                        <tr>
                            <th style="width:50px;">ID</th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description ?? '-' }}</td>
                            <td>
                                @if($role->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($role->status === 'inactive')
                                    <span class="badge bg-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-danger">{{ ucfirst($role->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $role->created_at?->format('d M, Y') ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Print Styling */
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
            margin: 0;
            font-size: 12px;
        }

        .btn {
            display: none !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 11px;
        }

        .bg-success { background-color: #28a745 !important; color: #fff !important; }
        .bg-secondary { background-color: #6c757d !important; color: #fff !important; }
        .bg-danger { background-color: #dc3545 !important; color: #fff !important; }
    }

    /* Hover highlight hanya untuk layar */
    @media screen {
        table tbody tr:hover {
            background-color: #f1f1f1;
        }
    }
</style>
@endsection
