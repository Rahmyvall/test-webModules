<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard User';
        return view('dashboard.user', compact('title'));// pastikan file Blade ada di resources/views/dashboard/admin.blade.php
    }
}