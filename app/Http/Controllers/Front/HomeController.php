<?php

namespace App\Http\Controllers\Front;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {
        $courses = Course::orderBy('id', 'desc')->limit(6)->get();

        return view('front.home', [
            'courses' => $courses,
        ]);
    }
}
