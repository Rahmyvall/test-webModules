@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Module Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $module->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Display Name</th>
                        <td>{{ $module->display_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $module->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Version</th>
                        <td>{{ $module->version ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($module->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($module->status === 'inactive')
                                <span class="badge bg-secondary">Inactive</span>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Installed At</th>
                        <td>{{ $module->installed_at ? $module->installed_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $module->created_at ? $module->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $module->updated_at ? $module->updated_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('admin.modules.edit', $module->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
