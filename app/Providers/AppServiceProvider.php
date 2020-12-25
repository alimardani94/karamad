<?php

namespace App\Providers;

use App\Services\Otp\Otp;
use App\Services\Otp\Redis as OtpRedis;
use App\Services\PriceCalculator\Calculator;
use App\Services\PriceCalculator\PriceCalculator;
use App\Services\Reactions\Reactor;
use App\Services\Reactions\SessionReactor;
use App\Services\SMS\Candoo;
use App\Services\Sms\PayamResan;
use App\Services\SMS\SMS;
use App\Services\Token\Jwt as TokenJwt;
use App\Services\Token\Token;
use \Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        $this->app->singleton(Sms::class, function () {
            switch (config('sms.driver')) {
                case 'candoo':
                    return new Candoo();
                case 'payam_resan':
                    return new PayamResan();
                default:
                    throw new Exception();
            }
        });

        $this->app->singleton(Token::class, function () {
            switch (config('token.type')) {
                case 'jwt':
                    return new TokenJwt();
                default:
                    throw new Exception();
            }
        });

        $this->app->singleton(Otp::class, function () {
            switch (config('otp.driver')) {
                case 'redis':
                    return new OtpRedis();
                default:
                    throw new Exception();
            }
        });
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
        if (Str::startsWith(config('app.url'), 'https')) {
            URL::forceScheme('https');
        }

        require(__DIR__ . '/../Services/Utils/helpers.php');
    }
}
