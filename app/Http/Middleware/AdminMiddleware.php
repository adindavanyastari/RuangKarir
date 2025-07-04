<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmails = [
            'ahmad.romadhon21@student.uisi.ac.id'
        ];
        
        if (!Auth::check() || !in_array(Auth::user()->email, $adminEmails)) {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }
        
        return $next($request);
    }
}