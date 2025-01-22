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
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            return redirect()->route('dashboard');
            // $role = Auth::user()->role;
            // if ($role == 'admin') {
            //     return redirect()->route('dashboard');
            // } elseif ($role == 'author') {
            //     return redirect()->route('dashboard');
            // } elseif ($role == 'subscriber') {
            //     return redirect()->route('dashboard');
            // }
        }

        // Kalau belum login, biarkan akses halaman
        return $next($request);
    }
}
