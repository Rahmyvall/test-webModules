@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Create Blog Post' }}</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.blog-posts.store') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" 
                               placeholder="Enter blog post title" value="{{ old('title') }}" required>
                        <div class="invalid-feedback">Please enter the blog post title.</div>
                    </div>

                    <!-- Slug -->
                    <div class="form-group mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" 
                               placeholder="Slug akan dibuat otomatis dari title" value="{{ old('slug') }}" required>
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

                    <!-- Author -->
                    <div class="form-group mb-3">
                        <label for="author_id">Author</label>
                        <select name="author_id" id="author_id" class="form-control">
                            <option value="">-- Select Author --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Featured Image -->
                    <div class="form-group mb-3">
                        <label for="featured_image">Featured Image</label>
                        <input type="file" name="featured_image" id="featured_image" class="form-control">
                    </div>

                    <!-- Status -->
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                        <div class="invalid-feedback">Please select the post status.</div>
                    </div>

                    <!-- Published At -->
                    <div class="form-group mb-3">
                        <label for="published_at">Published At</label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                    </div>

                    <!-- Excerpt -->
                    <div class="form-group mb-3">
                        <label for="excerpt">Excerpt</label>
                        <textarea name="excerpt" id="excerpt" class="form-control" rows="3">{{ old('excerpt') }}</textarea>
                    </div>

                    <!-- Content -->
                    <div class="form-group mb-3">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
                        <div class="invalid-feedback">Please enter the content.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Cancel</a>
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
    
        titleInput.addEventListener('keyup', function() {
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
