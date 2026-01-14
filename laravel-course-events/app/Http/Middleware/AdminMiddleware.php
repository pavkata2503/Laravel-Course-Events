<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ако потребителят НЕ е влязъл ИЛИ НЕ е админ -> Грешка 403 (Zabraneno)
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Нямате права за достъп до тази страница.');
        }

        return $next($request);
    }
}