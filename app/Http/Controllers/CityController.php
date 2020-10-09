<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CityController extends Controller
{
    public function get(Request $request)
    {
        $request->validate([
            'province' => ['required', 'exists:provinces,id']
        ]);

        return Cache::rememberForever('cities_of_province_' . $request->get('province'), function () use ($request) {
            return new JsonResponse(
                City::whereProvinceId($request->get('province'))->pluck('name', 'id')->toArray()
            );
        });
    }
}
