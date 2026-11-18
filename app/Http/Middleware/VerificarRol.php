<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        if ($request->user()->rol !== $rol) {
            abort(403);
        }

        return $next($request);
    }
}