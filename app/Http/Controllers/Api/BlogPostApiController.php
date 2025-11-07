<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BlogPostApiController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['category', 'author']);

        // Filter status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter author
        if ($request->has('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        // Search keyword in title or excerpt
        if ($request->has('q')) {
            $keyword = $request->q;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('excerpt', 'like', "%{$keyword}%");
            });
        }

        // Pagination
        $perPage = $request->get('per_page', 10);
        $posts = $query->latest()->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }

    public function show($id)
    {
        $post = BlogPost::with(['category', 'author'])->find($id);

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Blog post not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $post]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => ['required', Rule::in(['draft','published','archived'])],
            'category_id' => 'nullable|exists:blog_categories,id',
            'author_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images','public');
        }

        $post = BlogPost::create($validated);

        return response()->json(['success' => true, 'data' => $post]);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['required','string','max:255', Rule::unique('blog_posts')->ignore($post->id)],
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => ['required', Rule::in(['draft','published','archived'])],
            'category_id' => 'nullable|exists:blog_categories,id',
            'author_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images','public');
        }

        $post->update($validated);

        return response()->json(['success' => true, 'data' => $post]);
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return response()->json(['success' => true, 'message' => 'Blog post deleted']);
    }
}