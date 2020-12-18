<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Course;
use App\Models\Instructor;
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
     * @return Factory|View
     */
    public function index()
    {
        $courses = Course::paginate(10);

        return view('pages.admin.course.index', [
            'courses' => $courses
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $instructors = Instructor::all();
        $categories = CourseCategory::where('parent_id', '<>', null)->get();

        return view('pages.admin.course.create', [
            'instructors' => $instructors,
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->merge([
            'price' => parseNumber($request->get('price') ?? '0'),
            'discount' => parseNumber($request->get('discount') ?? '0'),
        ]);

        $request->validate([
            'title' => 'required|unique:courses',
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

        return redirect()->route('admin.course.courses.index')->with('success', trans('courses.created'));
    }

    /**
     * @param Course $course
     * @return Application|Factory|View
     */
    public function edit(Course $course)
    {
        $instructors = Instructor::all();
        $categories = CourseCategory::where('parent_id', '<>', null)->get();

        return view('pages.admin.course.edit', [
            'course' => $course,
            'instructors' => $instructors,
            'categories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        $request->merge([
            'price' => parseNumber($request->get('price') ?? '0'),
            'discount' => parseNumber($request->get('discount') ?? '0'),
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

        return redirect()->route('admin.course.courses.index')->with('success', trans('courses.created'));
    }

    /**
     * @param Course $course
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Course $course)
    {
        if ($course->has('syllabuses')) {
            return new JsonResponse(['message' => 'این دوره دارای جلسه بوده و برای جذف ان ابتدا جلسات آن را حذف کنید'], 400);
        }

        $course->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
