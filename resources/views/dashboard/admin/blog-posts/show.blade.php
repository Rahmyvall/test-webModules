@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">{{ $title ?? 'Blog Post Detail' }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $blogPost->title ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $blogPost->slug ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $blogPost->category?->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td>{{ $blogPost->author?->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ ucfirst($blogPost->status ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Published At</th>
                        <td>{{ $blogPost->published_at ? $blogPost->published_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Excerpt</th>
                        <td>{{ $blogPost->excerpt ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Content</th>
                        <td>
                            @if(!empty($blogPost->content))
                                <pre class="mb-0">{{ $blogPost->content }}</pre>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Featured Image</th>
                        <td>
                            @if($blogPost->featured_image)
                                <img src="{{ asset('storage/' . $blogPost->featured_image) }}" alt="Featured Image" class="img-thumbnail" style="max-width:150px;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $blogPost->created_at ? $blogPost->created_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $blogPost->updated_at ? $blogPost->updated_at->format('d M Y H:i') : '-' }}</td>
                    </tr>
                </table>

                <div class="mt-3">
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <a href="{{ route('admin.blog-posts.edit', $blogPost->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
