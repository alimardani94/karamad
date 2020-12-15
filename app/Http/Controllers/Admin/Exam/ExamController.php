<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $exams = Exam::withCount('questions')->paginate(10);

        return view('admin.exam.index', [
            'exams' => $exams,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.exam.create', [
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:1024',
            'description' => 'nullable|max:1024',
            'start_time' => 'nullable|string',
            'time' => 'nullable|string',
        ]);

        $exam = new Exam();
        $exam->creator_id = Auth::id();
        $exam->title = $request->get('title');
        $exam->start = gDate($request->get('start_time'));
        $exam->time = fixNumbers($request->get('time'));
        $exam->title = $request->get('title');
        $exam->description = $request->get('description');

        $exam->save();

        return redirect()->route('admin.questions.create', ['exam' => $exam])->with('success', trans('exams.created'));
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
     * @return Factory|View
     */
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);

        return view('admin.exam.edit', [
            'exam' => $exam,
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
            'title' => 'required|max:1024',
            'description' => 'nullable|max:1024',
            'start' => 'nullable|string',
            'time' => 'nullable|string',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->title = $request->get('title');
        $exam->start = gDate($request->get('start'));
        $exam->time = fixNumbers($request->get('time'));
        $exam->title = $request->get('title');
        $exam->description = $request->get('description');
        $exam->save();

        return redirect()->route('admin.exams.index')->with('success', trans('exams.updated'));
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $exam = exam::findOrFail($id);
        $exam->questions()->delete();
        $exam->delete();

        return new JsonResponse(['message' => trans('exams.deleted')]);
    }
}
