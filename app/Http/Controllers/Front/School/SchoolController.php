<?php

namespace App\Http\Controllers\Front\School;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SchoolController extends Controller
{
    /**
     * @param School $school
     * @return Application|Factory|View
     */
    public function show(School $school)
    {
        return view('pages.front.province.show', [
            'school' => $school,
            'products' => $school->products()->get(),
        ]);
    }
}
