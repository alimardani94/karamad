<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Session;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        View::composer('dashboard.*', function ($view) {
            $view->with('authUser', Auth::user());
        });
    }
}
