<?php

namespace App\Providers;

use App\Models\Social;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton('lang', function () {
            if (auth()->check() || auth()->guard('admin')->check()) {
                $lang=(auth()->user())?auth()->user()->lang:auth()->guard('admin')->user()->lang;
                session()->put('lang', $lang);
                return $lang;
            } else {
                if (\session()->has('lang')) {
                    return \session()->get('lang');
                } else {
                    \session()->put('lang', 'ar');
                    return 'ar';
                }
            }
        });

//       View::share('delivery',\App\Helper\CartCount::delivery());
//       View::share('social',Social::where('status',1)->get());
    }
}
