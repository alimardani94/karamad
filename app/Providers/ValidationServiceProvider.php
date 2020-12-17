<?php

namespace App\Providers;

use App\Services\Otp\Otp;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('cell', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^09[0-9]{9}$/', $value);
        }, trans('validation.accepted', ['attribute' => trans('validation.attributes.cell')]));

        Validator::extend('check_otp', function ($attribute, $value, $parameters, $validator) {
            /** @var Otp $otp */
            $otp = app(Otp::class);

            return $otp->check(request()->input('cell'), $value);
        }, trans('validation.exists', ['attribute' => trans('validation.attributes.code')]));
    }
}
