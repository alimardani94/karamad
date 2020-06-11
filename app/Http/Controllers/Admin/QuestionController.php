<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $questions = Question::paginate(10);

        return view('admin.question.index', [
            'questions' => $questions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        if ($request->get('exam')) {
            $exam = Exam::findOrFail($request->get('exam'));
        } else {
            $exams = Exam::all();
        }

        return view('admin.question.create', [
            'exam' => $exam ?? null,
            'exams' => $exams ?? [],
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
        $request->validate([
            'title' => 'required|max:1024',
            'description' => 'nullable|max:1024',
        ]);

        $question = new Question();
        $question->exam_id = $request->get('exam');
        $question->title = $request->get('title');
        $question->save();

        return redirect()->route('admin.questions.index', ['question' => $question])->with('success', trans('questions.created'));
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
     * @return Factory|View
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.question.edit', [
            'question' => $question,
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
        $request->validate([
            'title' => 'required|max:1024',
            'description' => 'nullable|max:1024',
        ]);

        $question = Question::findOrFail($id);
        $question->title = $request->get('title');
        $question->save();

        return redirect()->route('admin.questions.index')->with('success', trans('questions.updated'));
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
        question::findOrFail($id)->delete();

        return new JsonResponse(['message' => trans('questions.deleted')]);
    }
}
