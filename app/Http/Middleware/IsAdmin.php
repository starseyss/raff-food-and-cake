<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kalau belum login
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        // Kalau bukan admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Khusus admin.');
        }

        return $next($request);
    }
}