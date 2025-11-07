<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::with('category')->get();
        $title = 'Product Management';
        return view('dashboard.admin.products.index', compact('products', 'title'));
    }

    // Menampilkan form create produk
    public function create()
    {
        $categories = ProductCategory::all(); // Ambil semua kategori
        $title = 'Create Product';
        return view('dashboard.admin.products.create', compact('categories', 'title'));
    }


    // Simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'category_id' => 'nullable|exists:product_categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $title = 'Product Detail';
        return view('dashboard.admin.products.show', compact('product', 'title'));
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        $title = 'Edit Product';
        return view('dashboard.admin.products.edit', compact('product', 'categories', 'title'));
    }

    // Update produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products')->ignore($product->id),
            ],
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'category_id' => 'nullable|exists:product_categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Hapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
    public function print(Product $product)
    {
        // Contoh: kirim data ke view khusus print
        return view('dashboard.print', compact('product'));
    }
}