<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        abort_unless(in_array($request->user()->role, $roles, true), 403, 'Unauthorized access.');

        return $next($request);
    }
}
