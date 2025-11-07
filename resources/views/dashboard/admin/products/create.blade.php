@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create Product' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.products.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               placeholder="Enter product name" value="{{ old('name') }}" required>
                        <div class="invalid-feedback">Please enter the product name.</div>
                    </div>

                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" 
                               placeholder="Slug akan dibuat otomatis dari name" value="{{ old('slug') }}" required>
                        <div class="invalid-feedback">Please enter a unique slug.</div>
                    </div>

                    <!-- Category -->
                    <div class="form-group mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    

                    <!-- Price -->
                    <div class="form-group mb-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" 
                               placeholder="Enter product price" value="{{ old('price') }}" step="0.01" required>
                        <div class="invalid-feedback">Please enter the product price.</div>
                    </div>

                    <!-- Stock -->
                    <div class="form-group mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" 
                               placeholder="Enter product stock" value="{{ old('stock', 0) }}" required>
                        <div class="invalid-feedback">Please enter the product stock.</div>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="invalid-feedback">Please select the product status.</div>
                    </div>

                    <!-- Short Description -->
                    <div class="form-group mb-3">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                        <div class="invalid-feedback">Please enter the product description.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Bootstrap custom validation
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // Auto-generate slug dari name
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
    
        nameInput.addEventListener('keyup', function() {
            let slug = this.value.toLowerCase()
                                 .trim()
                                 .replace(/[^a-z0-9\s-]/g, '') // hilangkan karakter non-alphanumeric
                                 .replace(/\s+/g, '-')        // ganti spasi dengan dash
                                 .replace(/-+/g, '-');        // gabungkan multiple dash
            slugInput.value = slug;
        });
    });
</script>
@endsection
