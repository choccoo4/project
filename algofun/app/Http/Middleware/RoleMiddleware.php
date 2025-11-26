<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user login dengan guard yang sesuai
        if ($role === 'siswa' && !Auth::guard('siswa')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai siswa terlebih dahulu');
        }

        if ($role === 'guru' && !Auth::guard('guru')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai guru terlebih dahulu');
        }

        if ($role === 'admin' && !Auth::guard('admin')->check()) {
            return redirect()->route('login')->with('error', 'Silakan login sebagai admin terlebih dahulu');
        }

        return $next($request);
    }
}