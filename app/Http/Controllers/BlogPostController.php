<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class BlogPostController extends Controller
{
    // Menampilkan semua blog posts
    public function index()
    {
        $blogPosts = BlogPost::with(['category', 'author'])->get();
        $title = 'Blog Posts Management';
        return view('dashboard.admin.blog-posts.index', compact('blogPosts', 'title'));
    }

    // Menampilkan form create blog post
    public function create()
    {
        $categories = BlogCategory::all();
        $authors = User::all();
        $title = 'Create Blog Post';
        return view('dashboard.admin.blog-posts.create', compact('categories', 'authors', 'title'));
    }

    // Simpan blog post baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'category_id' => 'nullable|exists:blog_categories,id',
            'author_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully!');
    }

    // Menampilkan detail blog post
    public function show($id)
    {
        $blogPost = BlogPost::with(['category', 'author'])->findOrFail($id);
        $title = 'Blog Post Detail';
        return view('dashboard.admin.blog-posts.show', compact('blogPost', 'title'));
    }

    // Menampilkan form edit blog post
    public function edit($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $categories = BlogCategory::all();
        $authors = User::all();
        $title = 'Edit Blog Post';
        return view('dashboard.admin.blog-posts.edit', compact('blogPost', 'categories', 'authors', 'title'));
    }

    // Update blog post
    public function update(Request $request, $id)
    {
        $blogPost = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blog_posts')->ignore($blogPost->id),
            ],
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'category_id' => 'nullable|exists:blog_categories,id',
            'author_id' => 'nullable|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully!');
    }

    // Hapus blog post
    public function destroy($id)
    {
        $blogPost = BlogPost::findOrFail($id);

        if ($blogPost->featured_image && Storage::disk('public')->exists($blogPost->featured_image)) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }

        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully!');
    }

    // Print blog posts
    public function exportPDF()
    {
        $blogPosts = BlogPost::with(['category', 'author'])->get();
        $title = 'Daftar Blog Posts';
    
        $pdf = Pdf::loadView('dashboard.admin.blog-posts.print', compact('blogPosts', 'title'));
        return $pdf->stream('blog-posts.pdf'); // bisa diganti download() untuk langsung di-download
    }
    

}