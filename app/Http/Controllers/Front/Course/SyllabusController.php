<?php

namespace App\Http\Controllers\Front\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Syllabus;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SyllabusController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        $syllabus = Syllabus::findOrFail($id);

        $next = Syllabus::where('id', '>', $syllabus->id)->get(['id'])->first();
        $previous = Syllabus::where('id', '<', $syllabus->id)->get(['id'])->first();

        return view('front.syllabus', [
            'syllabus' => $syllabus,
            'next' => $next,
            'previous' => $previous,
        ]);
    }

}
