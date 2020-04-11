<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\OnlineCourse;
use App\Services\KeyGenerator\Generator;
use Auth;
use Illuminate\Http\Request;

class OnlineCourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $keyGenerator = app(Generator::class);

        $onlineCourse = new OnlineCourse();
        $onlineCourse->title = $request->get('title');
        $onlineCourse->key = $keyGenerator->key();
        $onlineCourse->instructor_id = Auth::user()->instructor->id;
        $onlineCourse->save();

        return back()->with('success', trans('online_courses.created'));
    }

    public function show($key)
    {
        $onlineCourse = OnlineCourse::where('key', $key)->firstOrFail();

        return view('dashboard.online_course.instructor', [
            'onlineCourse' => $onlineCourse,
        ]);
    }
}
