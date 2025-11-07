@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Edit Product Category' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product-categories.update', $category->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group mb-3">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $category->name) }}" required>
                        <div class="invalid-feedback">Please enter the category name.</div>
                    </div>

                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                               value="{{ old('slug', $category->slug) }}" required>
                        <div class="invalid-feedback">Please enter the slug.</div>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                                  placeholder="Enter description">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <!-- Parent Category -->
                    <div class="form-group mb-3">
                        <label for="parent_id">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">-- None --</option>
                            @foreach($categories as $parent)
                                <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="is_active">Status</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1" {{ old('is_active', $category->is_active) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !old('is_active', $category->is_active) ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Display Order -->
                    <div class="form-group mb-3">
                        <label for="display_order">Display Order</label>
                        <input type="number" name="display_order" id="display_order" class="form-control"
                               value="{{ old('display_order', $category->display_order) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <a href="{{ route('admin.product-categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
@endsection
