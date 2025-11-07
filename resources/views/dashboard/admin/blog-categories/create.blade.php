@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create Blog Category' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-categories.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <!-- Category Name -->
                    <div class="form-group mb-3">
                        <label for="name">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter category name (e.g., Technology, Education)" 
                            value="{{ old('name') }}" required>
                        <div class="invalid-feedback">Please enter the category name.</div>
                    </div>

                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            placeholder="Auto-generated or custom slug (e.g., technology)" 
                            value="{{ old('slug') }}">
                        <small class="text-muted">Slug is usually auto-generated from the name.</small>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control"
                            placeholder="Enter a short description about this category (optional)">{{ old('description') }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="is_active">Active Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Bootstrap validation
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

// Auto-generate slug
document.getElementById('name').addEventListener('input', function () {
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.getElementById('slug').value = slug;
});
</script>
@endsection
