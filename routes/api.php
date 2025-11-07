<?php

use App\Http\Controllers\Api\BlogPostApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ModuleApiController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductCategoryApiController;
use App\Http\Controllers\ProductImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserApiController::class, 'index']);
    Route::get('/{id}', [UserApiController::class, 'show']);
    Route::post('/', [UserApiController::class, 'store']);
    Route::put('/{id}', [UserApiController::class, 'update']);
    Route::delete('/{id}', [UserApiController::class, 'destroy']);

    // Export Excel/PDF
    Route::get('/export/excel', [UserApiController::class, 'exportExcel']);
    Route::get('/export/pdf', [UserApiController::class, 'exportPDF']);
});

Route::prefix('modules')->group(function () {
    Route::get('/', [ModuleApiController::class, 'index']);      // GET all
    Route::post('/', [ModuleApiController::class, 'store']);     // POST create
    Route::get('/{id}', [ModuleApiController::class, 'show']);   // GET detail
    Route::put('/{id}', [ModuleApiController::class, 'update']); // PUT update
    Route::delete('/{id}', [ModuleApiController::class, 'destroy']); // DELETE
});

Route::prefix('v1')->group(function () {
    Route::get('blog-posts', [BlogPostApiController::class, 'index']);
    Route::get('blog-posts/{id}', [BlogPostApiController::class, 'show']);
    Route::post('blog-posts', [BlogPostApiController::class, 'store']);
    Route::put('blog-posts/{id}', [BlogPostApiController::class, 'update']);
    Route::delete('blog-posts/{id}', [BlogPostApiController::class, 'destroy']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);          // List products
    Route::get('{id}', [ProductController::class, 'show']);       // Detail product
    Route::post('/', [ProductController::class, 'store']);        // Create product
    Route::put('{id}', [ProductController::class, 'update']);    // Update product
    Route::delete('{id}', [ProductController::class, 'destroy']); // Delete product
});

Route::prefix('product-categories')->group(function () {
    Route::get('/', [ProductCategoryApiController::class, 'index']);       // List semua kategori
    Route::get('{id}', [ProductCategoryApiController::class, 'show']);    // Detail kategori
    Route::post('/', [ProductCategoryApiController::class, 'store']);     // Buat kategori baru
    Route::put('{id}', [ProductCategoryApiController::class, 'update']);  // Update kategori
    Route::delete('{id}', [ProductCategoryApiController::class, 'destroy']); // Hapus kategori
});