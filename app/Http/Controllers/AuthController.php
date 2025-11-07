<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        // Jika sudah login, arahkan sesuai role
        if (Auth::check()) {
            $user = Auth::user();
            return $user->role_id == 1 
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        return view('auth.login');
    }

    // Proses login
    public function loginProses(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min'      => 'Password minimal 8 karakter',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Arahkan sesuai role
            return $user->role_id == 1
                ? redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!')
                : redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau Password salah')->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}