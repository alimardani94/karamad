<?php

namespace App\Http\Controllers\Front\Province;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Province;
use App\Models\School;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ProvinceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $provinces = Province::withCount('schools')->get();

        return view('pages.front.province.index', [
            'provinces' => $provinces,
        ]);
    }

    /**
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $province = Province::whereSlug($slug)->firstOrFail();

        $products = Product::whereHas('owner', function ($q) use ($province) {
            $q->where('province_id', $province->id);
        })->limit(6)->get();

        $schools = School::whereProvinceId($province->id)->get();

        return view('pages.front.province.show', [
            'products' => $products,
            'schools' => $schools,
        ]);
    }
}
