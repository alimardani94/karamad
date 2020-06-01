<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Syllabus;
use Illuminate\Http\Request;

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

        return view('front.syllabus', [
            'syllabus' => $syllabus,
        ]);
    }

}
