<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\CheckRole;

class RoleMiddleware
{
public function handle($request, Closure $next, ...$roles)
{
    if (!in_array(auth()->user()->role->name, $roles)) {
        abort(403);
    }
    return $next($request);
}
}
