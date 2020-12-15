<?php

namespace App\Http\Controllers\Admin\Exam;

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
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->get('exam')) {
            $questions = Question::where('exam_id', $request->get('exam'))->paginate(10);
        } else {
            $questions = Question::paginate(10);
        }

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
            $number = Question::whereExamId($exam->id)->count() + 1;
        } else {
            $exams = Exam::all();
            $number = 1;
        }

        return view('admin.question.create', [
            'number' => $number,
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
            'title' => 'required',
            'exam' => ['required', 'exists:exams,id'],
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => ['required', 'in:a,b,c,d'],
        ]);

        $question = new Question();
        $question->exam_id = $request->get('exam');
        $question->title = preventXSS($request->get('title'));
        $question->answer_reason = preventXSS($request->get('answer_reason'));
        $question->a = preventXSS($request->get('a'));
        $question->b = preventXSS($request->get('b'));
        $question->c = preventXSS($request->get('c'));
        $question->d = preventXSS($request->get('d'));
        $question->answer = $request->get('answer');

        $question->save();

        return redirect()->route('admin.questions.create', ['exam' => $question->exam_id])->with('success', trans('questions.created'));
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
            'title' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => ['required', 'in:a,b,c,d'],
        ]);

        $question = Question::findOrFail($id);
        $question->title = preventXSS($request->get('title'));
        $question->answer_reason = preventXSS($request->get('answer_reason'));
        $question->a = preventXSS($request->get('a'));
        $question->b = preventXSS($request->get('b'));
        $question->c = preventXSS($request->get('c'));
        $question->d = preventXSS($request->get('d'));
        $question->answer = $request->get('answer');
        $question->save();

        return redirect()->route('admin.questions.index', ['exam' => $question->exam_id])
            ->with('success', trans('questions.updated'));
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
