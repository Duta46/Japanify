<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if ($request->user() && $request->user()->hasAnyRole($roles)) {
            return $next($request);
        }

        return redirect()->route('user.home')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
