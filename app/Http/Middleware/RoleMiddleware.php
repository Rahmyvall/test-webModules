<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Cek apakah role user ada dalam daftar role yang diperbolehkan
        if (!in_array($user->role_id, $roles)) {
            // Jika tidak sesuai role, redirect ke dashboard sesuai role
            if ($user->role_id == 1) {
                return redirect()->route('admin.dashboard')->with('error', 'Anda tidak punya akses ke halaman ini.');
            } else {
                return redirect()->route('user.dashboard')->with('error', 'Anda tidak punya akses ke halaman ini.');
            }
        }

        return $next($request);
    }
}