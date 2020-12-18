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

        return view('pages.admin.question.index', [
            'questions' => $questions,
        ]);
    }

    /**
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

        return view('pages.admin.question.create', [
            'number' => $number,
            'exam' => $exam ?? null,
            'exams' => $exams ?? [],
        ]);
    }

    /**
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

        return redirect()->route('admin.exam.questions.create', ['exam' => $question->exam_id])->with('success', trans('questions.created'));
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
        $question = Question::findOrFail($id);

        return view('pages.admin.question.edit', [
            'question' => $question,
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

        return redirect()->route('admin.exam.questions.index', ['exam' => $question->exam_id])
            ->with('success', trans('questions.updated'));
    }

    /**
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
