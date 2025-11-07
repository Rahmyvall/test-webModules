<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order; // jika ada model Order
use Illuminate\Http\Request;
use App\Models\ContactMessage; // pastikan ada model ContactMessag

class DashboardController extends Controller
{
  
    public function index()
    {
        $user = auth()->user(); // ambil user yang login

        // =========================
        // Contact messages
        // =========================
        $totalMessages    = ContactMessage::count();
        $unreadMessages   = ContactMessage::where('is_read', false)->count();
        $repliedMessages  = ContactMessage::where('status', 'replied')->count();
        $archivedMessages = ContactMessage::where('status', 'archived')->count();
        $newMessagesPercent = $totalMessages > 0 ? round(($unreadMessages / $totalMessages) * 100, 1) : 0;

        // =========================
        // Products (untuk tabel produk)
        // =========================
        $products = Product::with('category')->latest()->get();

        $title = 'Dashboard';

        return view('dashboard.admin', compact(
            'user',
            'title',
            'totalMessages',
            'unreadMessages',
            'repliedMessages',
            'archivedMessages',
            'newMessagesPercent',
            'products'
        ));
    }
    
    public function dashboard()
    {
        $user = auth()->user(); // ambil user yang login
        return view('dashboard.admin', compact('user'));
    }

    
    
}