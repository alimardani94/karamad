<?php

namespace App\Enums;

use MiladRahimi\Enum\Enum as MiladEnum;
use ReflectionClass;
use ReflectionException;

abstract class Enum extends MiladEnum
{
    /**
     * @return array
     */
    public static function all(): array
    {
        try {
            return (new ReflectionClass(static::class))->getConstants();
        } catch (ReflectionException $e) {
            return [];
        }
    }

    public static function translatedAll()
    {
        $all = static::all();
        $preFix = str_replace('App\\', '', get_called_class());
        $preFix = str_replace('\\', '/', $preFix);

        foreach ($all as $key => $value) {
            $transKey = $preFix . '.' . $key;
            $all[trans($transKey)] = $all[$key];
            unset($all[$key]);
        }

        return $all;
    }

    public static function translatedKeyOf($value, $default = null)
    {
        $preFix = str_replace('App\\', '', get_called_class());
        $preFix = str_replace('\\', '/', $preFix);

        return static::keyOf($value) ? trans($preFix . '.' . static::keyOf($value)) : $default;
    }
}
