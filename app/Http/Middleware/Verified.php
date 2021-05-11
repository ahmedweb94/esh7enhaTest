<?php

namespace App\Http\Middleware;

use Closure;

class Verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->verified == 0) {
                return redirect(route('mobile-confirm'))->withErrors(trans('api.verify_your_user'));
            }
        }
        return $next($request);
    }
}
