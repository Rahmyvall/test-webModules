<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';
        $menuDashboard = 'active';
        return view('dashboard.admin', compact('title', 'menuDashboard'));
    }
    
}