@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Edit Kategori Blog' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-categories.update', $blogCategory->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Category Name -->
                    <div class="form-group mb-3">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $blogCategory->name) }}" required>
                        <div class="invalid-feedback">Harap masukkan nama kategori.</div>
                    </div>

                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                               value="{{ old('slug', $blogCategory->slug) }}" required>
                        <small class="text-muted">Slug harus unik dan URL-friendly.</small>
                        <div class="invalid-feedback">Harap masukkan slug.</div>
                    </div>

                    <!-- Description -->
                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                                  placeholder="Masukkan deskripsi kategori (opsional)">{{ old('description', $blogCategory->description) }}</textarea>
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="is_active">Status</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1" {{ old('is_active', $blogCategory->is_active) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $blogCategory->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Kategori</button>
                    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">Batal</a>
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

// Auto-generate slug saat name berubah
document.getElementById('name').addEventListener('input', function () {
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.getElementById('slug').value = slug;
});
</script>
@endsection
