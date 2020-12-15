<?php

namespace App\Http\Controllers\Front\Course;

use App\Http\Controllers\Controller;
use App\Models\Syllabus;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SyllabusController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Syllabus $syllabus
     * @return Factory|View
     */
    public function show(Syllabus $syllabus)
    {
        $next = Syllabus::where('id', '>', $syllabus->id)->get(['id'])->first();
        $previous = Syllabus::where('id', '<', $syllabus->id)->get(['id'])->first();

        return view('front.course.syllabus', [
            'syllabus' => $syllabus,
            'next' => $next,
            'previous' => $previous,
        ]);
    }

}
