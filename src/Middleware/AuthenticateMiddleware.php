<?php

namespace peczis\pecCms\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
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
        if (Auth::guard()->guest()) {
            return redirect()->route('pec-cms.login');
        }

        return $next($request);
    }
}
