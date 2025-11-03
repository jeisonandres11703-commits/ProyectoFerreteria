<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si existe un usuario autenticado en sesión
        if (!$request->session()->has('usuario')) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión primero.');
        }

        return $next($request);
    }
}
