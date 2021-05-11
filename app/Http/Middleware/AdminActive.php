<?php

namespace App\Http\Middleware;

use App\Helper\UsersStatus;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Services\ApiResponseService;
use Closure;

class AdminActive
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
        if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->is_active == 0) {
            $reason = auth()->guard('admin')->user()->reason;
            auth()->guard('admin')->logout();
            return redirect(url('admin/login'))->withErrors(trans('api.inactive_message', ['reason' => $reason]));
        }
        return $next($request);
    }
}
