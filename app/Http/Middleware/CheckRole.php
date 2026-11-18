<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // belum login -> ke halaman login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // role tidak cocok -> tolak
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki hak akses!');
        }

        return $next($request);
    }
}