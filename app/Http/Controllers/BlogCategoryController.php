<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    // 📄 Menampilkan semua kategori
    public function index()
    {
        $blogCategories = BlogCategory::latest()->get();

        return view('dashboard.admin.blog-categories.index', [
            'title' => 'Daftar Kategori Blog',
            'blogCategories' => $blogCategories,
        ]);
    }

    // 📄 Form tambah kategori
    public function create()
    {
        $title = 'Tambah Kategori Blog';
        return view('dashboard.admin.blog-categories.create', compact('title'));
    }

    // 📄 Menyimpan kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active') ? (bool)$request->is_active : true;

        BlogCategory::create($validated);

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Kategori blog berhasil ditambahkan!');
    }

    // 📄 Form edit kategori
    public function edit(BlogCategory $blogCategory)
    {
        $title = 'Edit Kategori Blog';
        return view('dashboard.admin.blog-categories.edit', compact('blogCategory', 'title'));
    }

    // 📄 Toggle status aktif/inaktif
    public function toggleStatus(BlogCategory $blogCategory)
    {
        $blogCategory->is_active = !$blogCategory->is_active;
        $blogCategory->save();

        return redirect()->back()->with('success', 'Status kategori berhasil diubah!');
    }

    // 📄 Update kategori
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blog_categories','slug')->ignore($blogCategory->id),
            ],
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);
        $blogCategory->update($validated);

        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Kategori blog berhasil diperbarui!');
    }

    // 📄 Detail kategori
    public function show(BlogCategory $blogCategory)
    {
        $title = 'Detail Kategori Blog';
        return view('dashboard.admin.blog-categories.show', compact('blogCategory', 'title'));
    }

    // 📄 Hapus kategori
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('admin.blog-categories.index')
            ->with('success', 'Kategori blog berhasil dihapus!');
    }
}