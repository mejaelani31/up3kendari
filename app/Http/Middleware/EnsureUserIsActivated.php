<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika pengguna tidak login, biarkan middleware lain yang menanganinya.
        if (! $request->user()) {
            return $next($request);
        }

        // Jika pengguna sudah memiliki data karyawan (sudah diaktifkan), izinkan akses.
        if ($request->user()->employee) {
            return $next($request);
        }

        // Jika pengguna BELUM diaktifkan DAN dia TIDAK sedang mencoba mengakses halaman
        // pemberitahuan atau logout, maka alihkan dia ke halaman pemberitahuan.
        // Ini untuk mencegah redirect loop.
        if (! $request->routeIs('pending-approval') && ! $request->routeIs('logout')) {
             return redirect()->route('pending-approval');
        }
        
        return $next($request);
    }
}
