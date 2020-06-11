<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Syllabus;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
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
     * @return Factory|View
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
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'price' => parse_number($request->get('price') ?? '0'),
            'discount' => parse_number($request->get('discount') ?? '0'),
        ]);

        $request->validate([
            'title' => 'required',
            'category' => ['required', 'exists:categories,id'],
            'instructor' => ['required', 'exists:instructors,id'],
            'summary' => 'required',
            'description' => 'required',
            'thumbnail' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $imagePath = $request->file('image')->store('courses/images');
        $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails');

        $course = new Course();
        $course->title = $request->get('title');
        $course->category_id = $request->get('category');
        $course->instructor_id = $request->get('instructor');
        $course->summary = $request->get('summary');
        $course->description = preventXSS($request->get('description'));
        $course->thumbnail = $thumbnailPath;
        $course->image = $imagePath;
        $course->price = $request->get('price');
        $course->discount = $request->get('discount');
        $course->meta_keywords = $request->get('meta_keywords');
        $course->meta_description = $request->get('meta_description');

        $course->save();

        return redirect()->route('admin.courses.index')->with('success', trans('courses.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $instructors = Instructor::all();
        $categories = Category::where('parent_id', '<>', 0)->get();

        return view('admin.course.edit', [
            'course' => $course,
            'instructors' => $instructors,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->merge([
            'price' => parse_number($request->get('price') ?? '0'),
            'discount' => parse_number($request->get('discount') ?? '0'),
        ]);

        $request->validate([
            'title' => 'required',
            'category' => ['required', 'exists:categories,id'],
            'instructor' => ['required', 'exists:instructors,id'],
            'summary' => 'required',
            'description' => 'required',
            'thumbnail' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
        ]);

        $imagePath = $course->image;
        $thumbnailPath = $course->thumbnail;

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('courses/images');
        }

        if ($request->file('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails');
        }

        $course->title = $request->get('title');
        $course->category_id = $request->get('category');
        $course->instructor_id = $request->get('instructor');
        $course->summary = $request->get('summary');
        $course->description = preventXSS($request->get('description'));
        $course->thumbnail = $thumbnailPath;
        $course->image = $imagePath;
        $course->price = $request->get('price');
        $course->discount = $request->get('discount');
        $course->meta_keywords = $request->get('meta_keywords');
        $course->meta_description = $request->get('meta_description');

        $course->save();

        return redirect()->route('admin.courses.index')->with('success', trans('courses.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        if (Syllabus::whereCourseId($id)->exists()) {
            return new JsonResponse(['message' => 'این دوره دارای جلسه بوده و برای جذف ان ابتدا جلسات آن را حذف کنید'], 400);
        }

        Course::findOrFail($id)->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
