<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest as TransformsRequest;

class ParseNumericStrings extends TransformsRequest
{
    protected $except = [
        '_token',
        'password',
        'password_confirmation',
    ];

    protected function transform($key, $value)
    {
        if($value != null and in_array($key, $this->except) === false) {
            return fixNumbers($value);
        }
    }
}
