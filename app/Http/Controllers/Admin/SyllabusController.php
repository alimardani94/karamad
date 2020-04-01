<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FileDisk;
use App\Enums\Syllabus\SyllabusType;
use App\Models\Category;
use App\Models\Course;
use App\Rules\CheckCategoryParent;
use App\Rules\UniqueCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Storage;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->get('course')) {
            $course = Course::findOrFail($request->get('course'));
        }else {
            $courses = Course::all();
        }

        $types = SyllabusType::translatedAll();

        return view('admin.syllabus.create', [
            'course' => $course ?? null,
            'courses' => $courses ?? [],
            'types' => $types,
            'fileDisks' => FileDisk::translatedAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'course' => 'required',
            'type' => 'required',
            'video' => 'required_if:type,1 | mimes:mp4,mov,ogg,qt | max:20000',
            'audio' => 'required_if:type,2 | mimes:mp3,mpga,wav | max:10000',
            'text' => 'required_if:type,3 | string',
        ]);

        dd($request);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
