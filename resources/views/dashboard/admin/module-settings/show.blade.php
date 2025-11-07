@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Module Setting Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Module Name</th>
                        <td>{{ $moduleSetting->module_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Key</th>
                        <td>{{ $moduleSetting->key ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Value</th>
                        <td>
                            @if(!empty($moduleSetting->value))
                                <pre class="mb-0">{{ $moduleSetting->value }}</pre>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $moduleSetting->created_at ? $moduleSetting->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $moduleSetting->updated_at ? $moduleSetting->updated_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.module-settings.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <a href="{{ route('admin.module-settings.edit', $moduleSetting->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
