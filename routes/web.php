<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\ModuleSettingsController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\ContactMessagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Login / Auth
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login-proses', [AuthController::class, 'loginProses'])->name('login.proses');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard umum
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/products/print/{product}', [ProductController::class, 'print'])->name('products.print');



});

// ==============================
// Routes Admin
// ==============================
Route::prefix('admin')
    ->middleware(['auth', 'role:1'])
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // USERS MANAGEMENT
        Route::resource('users', UserController::class);
        Route::get('users-export-excel', [UserController::class, 'exportExcel'])->name('users.export-excel');
        Route::get('users-export-pdf', [UserController::class, 'exportPDF'])->name('users.export-pdf');
        Route::get('users-print', [UserController::class, 'print'])->name('users.print');

        // ROLES MANAGEMENT
        Route::resource('roles', RolesController::class);
        Route::get('roles-export-pdf', [RolesController::class, 'exportPDF'])->name('roles.export-pdf');
        Route::get('roles-print', [RolesController::class, 'print'])->name('roles.print');

        // MODULES MANAGEMENT
        Route::resource('modules', ModulesController::class);
        Route::get('modules-export-pdf', [ModulesController::class, 'exportPDF'])->name('modules.export-pdf');
        Route::get('modules-print', [ModulesController::class, 'print'])->name('modules.print');

        // MODULE SETTINGS MANAGEMENT
        Route::resource('module-settings', ModuleSettingsController::class)->names('module-settings');
        Route::get('module-settings-export-pdf', [ModuleSettingsController::class, 'exportPDF'])->name('module-settings.export-pdf');
        Route::get('module-settings-print', [ModuleSettingsController::class, 'print'])->name('module-settings.print');

        // BLOG CATEGORIES
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::patch('blog-categories/{blogCategory}/toggle-status', [BlogCategoryController::class, 'toggleStatus'])
            ->name('blog-categories.toggle-status');

        // BLOG POSTS
        Route::resource('blog-posts', BlogPostController::class);
        Route::get('blog-posts-export-pdf', [BlogPostController::class, 'exportPDF'])->name('blog-posts.export-pdf');

        // PRODUCTS
        Route::resource('products', ProductController::class);

        // PRODUCT CATEGORIES
        Route::resource('product-categories', ProductCategoriesController::class);
        Route::get('product-categories-export-pdf', [ProductCategoriesController::class, 'exportPDF'])->name('product-categories.export-pdf');
        Route::get('product-categories-print', [ProductCategoriesController::class, 'print'])->name('product-categories.print');

        Route::resource('contact-messages', ContactMessagesController::class)
        ->only(['index','show', 'destroy','edit','update']);
        
        Route::put('contact-messages/{message}/updateStatus', [ContactMessagesController::class, 'update'])
    ->name('admin.contact-messages.updateStatus');
     Route::resource('contact-settings', ContactSettingController::class);

    });

// ==============================
// Routes User Biasa
// ==============================
Route::prefix('user')
    ->middleware(['auth', 'role:2'])
    ->name('user.')
    ->group(function () {
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    });

// Auth tambahan
require __DIR__ . '/auth.php';