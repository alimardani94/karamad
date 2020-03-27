<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $courses = Course::all();

        return view('admin.course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $instructors = Instructor::all();
        $categories = Category::where('parent_id', '<>', 0)->get();

        return view('admin.course.create', [
            'instructors' => $instructors,
            'categories' => $categories,
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
            'category' => ['required','exists:categories,id'],
            'instructor' => ['required','exists:instructors,id'],
            'summary' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $imagePath = $request->file('image')->store('courses/images');
        $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails');

        $category = new Course();
        $category->title = $request->get('title');
        $category->category_id = $request->get('category');
        $category->instructor_id = $request->get('instructor');
        $category->summary = $request->get('summary');
        $category->description = preventXSS($request->get('description'));
        $category->thumbnail = $thumbnailPath;
        $category->image = $imagePath;
        $category->price = $request->get('price') ?? 0;
        $category->discount = $request->get('discount') ?? 0;

        $category->save();

        return back()->with('success', trans('courses.created'));
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
