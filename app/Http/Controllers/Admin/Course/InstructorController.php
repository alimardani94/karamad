<?php

namespace App\Http\Controllers\Admin\Course;

use App\Enums\Instructor\InstructorType;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstructorController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $instructors = Instructor::paginate(15);

        return view('pages.admin.instructor.index', [
            'instructors' => $instructors
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('pages.admin.instructor.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'about' => 'required|max:1024',
        ]);

        $instructor = new Instructor();
        $instructor->type = InstructorType::NotUser;
        $instructor->name = $request->get('name');
        $instructor->title = $request->get('title');
        $instructor->about = $request->get('about');
        $instructor->save();

        return redirect()-> route('admin.instructors.index')->with('success', trans('instructors.created'));
    }

    /**
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param int $id
     *  @return Factory|View
     */
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);

        return view('pages.admin.instructor.edit', [
            'instructor' => $instructor,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'about' => 'required|max:1024',
        ]);

        $instructor = Instructor::findOrFail($id);
        $instructor->name = $request->get('name');
        $instructor->title = $request->get('title');
        $instructor->about = $request->get('about');
        $instructor->save();

        return redirect()-> route('admin.instructors.index')->with('success', trans('instructors.updated'));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        Instructor::whereId($id)->where('type', InstructorType::NotUser)->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
