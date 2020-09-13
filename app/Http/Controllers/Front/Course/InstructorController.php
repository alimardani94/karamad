<?php

namespace App\Http\Controllers\Front\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Course\Instructor;
use App\Models\Course\Syllabus;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class InstructorController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param Instructor $instructor
     * @return Factory|View
     */
    public function show(Instructor $instructor)
    {
        $courses = Course::whereInstructorId($instructor->id)->orderBy('id', 'desc')->whereHas('syllabuses')->limit(6)->paginate(16);

        return view('front.course.instructor', [
            'instructor' => $instructor,
            'courses' => $courses,
        ]);
    }

}
