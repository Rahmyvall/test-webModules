<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCategoryApiController extends Controller
{
    // List semua kategori
    public function index()
    {
        $categories = ProductCategory::with('parent')->get();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    // Detail kategori
    public function show($id)
    {
        $category = ProductCategory::with('parent')->find($id);
        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $category]);
    }

    // Buat kategori baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|max:150|unique:product_categories,slug',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:product_categories,id',
            'is_active' => 'required|boolean',
            'display_order' => 'nullable|integer',
        ]);

        $category = ProductCategory::create($validated);

        return response()->json(['status' => 'success', 'data' => $category], 201);
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $category = ProductCategory::find($id);
        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 404);
        }

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

        return response()->json(['status' => 'success', 'data' => $category]);
    }

    // Hapus kategori
    public function destroy($id)
    {
        $category = ProductCategory::find($id);
        if (!$category) {
            return response()->json(['status' => 'error', 'message' => 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['status' => 'success', 'message' => 'Category deleted']);
    }
}