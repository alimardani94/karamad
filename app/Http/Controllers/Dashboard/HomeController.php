<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\OnlineCourse;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $onlineCourses = OnlineCourse::orderBy('id', 'desc')
            ->where('instructor_id', Auth::user()->instructor->id)->paginate(6);

        return view('dashboard.home', [
            'onlineCourses' => $onlineCourses,
        ]);
    }
}
