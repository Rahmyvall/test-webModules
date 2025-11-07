@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Product Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $product->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>{{ $product->price ? number_format($product->price, 2) : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Stock</th>
                        <td>{{ $product->stock ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($product->status ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{{ $product->short_description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>
                            @if(!empty($product->description))
                                <pre class="mb-0">{{ $product->description }}</pre>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $product->created_at ? $product->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $product->updated_at ? $product->updated_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
