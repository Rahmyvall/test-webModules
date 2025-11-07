<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // <-- import ini
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class ProductCategoriesController extends Controller
{
    // Menampilkan semua kategori produk
    public function index()
    {
        $categories = ProductCategory::all();
        $title = 'Product Categories Management';
        return view('dashboard.admin.product-categories.index', compact('categories', 'title'));
    }

    // Menampilkan form create kategori
    public function create()
    {
        $categories = ProductCategory::whereNull('parent_id')->get(); // untuk dropdown parent
        $title = 'Create Product Category';
        return view('dashboard.admin.product-categories.create', compact('categories', 'title'));
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:150|unique:product_categories,slug', // bisa kosong
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:product_categories,id',
            'is_active' => 'required|boolean',
            'display_order' => 'nullable|integer',
        ]);

        // Jika slug kosong, buat otomatis dari name
        if (empty($validated['slug'])) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $count = 1;

            // Cek duplikasi slug
            while (ProductCategory::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $validated['slug'] = $slug;
        }

        // Simpan kategori baru
        ProductCategory::create($validated);

        return redirect()->route('admin.product-categories.index')
                        ->with('success', 'Product category created successfully!');
    }

    // Menampilkan detail kategori
    public function show($id)
    {
        $category = ProductCategory::with('parent')->findOrFail($id); // load parent
        $title = 'Product Category Detail';
        return view('dashboard.admin.product-categories.show', compact('category', 'title'));
    }

    // Menampilkan form edit kategori
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $categories = ProductCategory::whereNull('parent_id')->where('id', '!=', $id)->get(); // exclude self
        $title = 'Edit Product Category';
        return view('dashboard.admin.product-categories.edit', compact('category', 'categories', 'title'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => [
                'required',
                'string',
                'max:150',
                Rule::unique('product_categories')->ignore($category->id),
            ],
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:product_categories,id',
            'is_active' => 'required|boolean',
            'display_order' => 'nullable|integer',
        ]);

        $category->update($validated);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category updated successfully!');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Product category deleted successfully!');
    }

    // Export kategori ke PDF
    public function exportPDF()
    {
        $categories = ProductCategory::with('parent')->get();
        $title = 'Product Categories PDF Export';
        $pdf = Pdf::loadView('dashboard.admin.product-categories.product-categoriespdf', compact('categories', 'title'));
        return $pdf->download('product_categories.pdf');
    }

    

    // Print view HTML
    public function print()
    {
        $categories = ProductCategory::all();
        $title = 'Product Categories Print View';
        return view('dashboard.admin.product-categories.product-categoriesprint', compact('categories', 'title'));
    }
}