<?php

namespace peczis\pecCms\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ChangeGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Auth::shouldUse('pecCms');

        return $next($request);
    }
}
