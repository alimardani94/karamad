<?php

namespace App\Http\Controllers\Front\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CourseController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('front.course', [
            'course' => $course,
        ]);
    }

}
