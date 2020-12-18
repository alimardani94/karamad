<?php

namespace App\Http\Controllers\Admin\Course;

use App\Models\Course;
use App\Models\CourseCategory;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $categories = CourseCategory::paginate(10);

        return view('pages.admin.course_category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $categories = CourseCategory::whereParentId(null)->get();

        return view('pages.admin.course_category.create', [
            'mainCategories' => $categories,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'parent' => ['nullable', 'exists:categories,id'],
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'nullable|max:1024',
        ]);

        $path = $request->file('image')->store('categories');

        $category = new CourseCategory();
        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent');
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.course.categories.index', ['type' => $request->get('type')])->with('success', trans('categories.created'));
    }

    /**
     * @param CourseCategory $category
     * @return Factory|View
     */
    public function edit(CourseCategory $category)
    {
        return view('pages.admin.course_category.edit', [
            'mainCategories' => CourseCategory::whereParentId(null)->where('id', '<>', $category->id)->get(),
            'category' => $category,
        ]);
    }

    /**
     * @param Request $request
     * @param CourseCategory $category
     * @return RedirectResponse
     */
    public function update(Request $request, CourseCategory $category)
    {
        $request->validate([
            'name' => ['required'],
            'parent' => ['nullable', 'exists:categories,id'],
            'image' => 'nullable|mimes:jpeg,bmp,png,gif,svg,pdf|max:4096',
            'description' => 'nullable|max:1024',
        ]);

        $path = $category->image;
        if ($request->file('image')) {
            $path = $request->file('image')->store('categories');
        }

        $category->name = $request->get('name');
        $category->parent_id = $request->get('parent');
        $category->image = $path;
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('admin.course.categories.index')->with('success', trans('categories.updated'));
    }

    /**
     * @param CourseCategory $category
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(CourseCategory $category)
    {
        $category->delete();

        // update children of deleted category
        CourseCategory::where('parent_id', $category->id)->update(['parent_id' => null]);
        Course::where('category_id', $category->id)->update(['category_id' => null]);

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
