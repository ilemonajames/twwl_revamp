<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->status === 'Active' && $request->user()?->user_type === 'Client', 403);

        return $next($request);
    }
}
