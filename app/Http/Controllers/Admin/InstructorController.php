<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Instructor\InstructorType;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $instructors = Instructor::all();

        return view('admin.instructor.index', [
            'instructors' => $instructors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.instructor.create');
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

        return redirect()->route('admin.instructors.index')->with('success', trans('instructors.created'));
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
     *  @return Factory|View
     */
    public function edit($id)
    {
        $instructor = Instructor::findOrFail($id);

        return view('admin.instructor.edit', [
            'instructor' => $instructor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
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

        return redirect()->route('admin.instructors.index')->with('success', trans('instructors.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Instructor::whereId($id)->where('type', InstructorType::NotUser)->delete();

        return new JsonResponse(['message' => trans('categories.deleted')]);
    }
}
