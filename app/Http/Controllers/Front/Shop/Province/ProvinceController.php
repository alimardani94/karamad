<?php

namespace App\Http\Controllers\Front\Shop\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;
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
        $provinces = Province::all();

        return view('pages.front.shop.province.index', [
            'provinces' => $provinces,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function show()
    {

        return view('pages.front.shop.province.show', [

        ]);
    }
}
