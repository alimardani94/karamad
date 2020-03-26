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
        foreach ($all as $key => $value) {
            $transKey = 'Enums/' . str_replace('App\Enums\\', '', get_called_class()) . '.' . $key;
            $all[trans($transKey)] = $all[$key];
            unset($all[$key]);
        }

        return $all;
    }

    public static function translatedKeyOf($value, $default = null)
    {
        return static::keyOf($value) ? trans('Enums/' . str_replace('App\Enums\\', '', get_called_class()) . '.' . static::keyOf($value)) : $default;
    }
}
