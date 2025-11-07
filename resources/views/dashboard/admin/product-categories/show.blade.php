@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Product Category Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td>{{ $category->id }}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $category->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $category->slug ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $category->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Parent Category</th>
                        <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Display Order</th>
                        <td>{{ $category->display_order ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $category->created_at ? $category->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $category->updated_at ? $category->updated_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <a href="{{ route('admin.product-categories.edit', $category->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
