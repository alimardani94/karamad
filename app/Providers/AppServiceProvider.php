<?php

namespace App\Providers;

use App\Services\KeyGenerator\Generator;
use App\Services\KeyGenerator\KeyGenerator;
use App\Services\PriceCalculator\Calculator;
use App\Services\PriceCalculator\PriceCalculator;
use App\Services\Reactions\Reactor;
use App\Services\Reactions\SessionReactor;
use Illuminate\Support\Facades\Schema;
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

        $this->app->bind(Generator::class, KeyGenerator::class);
        $this->app->bind(Calculator::class, PriceCalculator::class);
        $this->app->bind(Reactor::class, SessionReactor::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        require(__DIR__ . '/../Helpers/helpers.php');
    }
}
