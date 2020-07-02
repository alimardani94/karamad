<?php

namespace App\Http\Controllers\Front;

use App\Models\Course\Course;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function home()
    {

        $courses = Course::orderBy('id', 'desc')->whereHas('syllabuses')->limit(6)->get();

        return view('front.home', [
            'courses' => $courses,
        ]);
    }
}
