<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // Show single product
    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $product]);
    }

    // Create new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['active','inactive'])],
            'category_id' => 'nullable|exists:product_categories,id'
        ]);

        $product = Product::create($validated);

        return response()->json(['success' => true, 'data' => $product], 201);
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => ['required','string','max:255', Rule::unique('products')->ignore($product->id)],
            'description' => 'required|string',
            'short_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => ['required', Rule::in(['active','inactive'])],
            'category_id' => 'nullable|exists:product_categories,id'
        ]);

        $product->update($validated);

        return response()->json(['success' => true, 'data' => $product]);
    }

    // Delete product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
    }
}
