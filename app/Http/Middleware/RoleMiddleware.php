<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Vérifie si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Vérifie si le rôle est autorisé
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}