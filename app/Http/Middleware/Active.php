<?php

namespace App\Http\Middleware;

use App\Helper\UsersStatus;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Services\ApiResponseService;
use Closure;

class Active
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
        if (auth()->check() && auth()->user()->is_active == 0) {
            $reason = auth()->user()->reason;
            auth()->logout();
            return redirect(url('login'))->withErrors(trans('api.inactive_message', ['reason' => $reason]));
        }
        return $next($request);
    }
}
