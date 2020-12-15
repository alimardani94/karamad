<?php

namespace App\Http\Controllers\Admin\Course;

use App\Enums\FileDisk;
use App\Enums\Syllabus\SyllabusType;
use App\Models\Course;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Syllabus;
use App\Rules\SyllabusAttachment;
use Auth;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SyllabusController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->get('course')) {
            $syllabuses = Syllabus::where('course_id', $request->get('course'))->paginate(10);
        } else {
            $syllabuses = Syllabus::paginate(10);
        }

        return view('admin.syllabus.index', [
            'syllabuses' => $syllabuses
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function create(Request $request)
    {
        if ($request->get('course')) {
            $course = Course::findOrFail($request->get('course'));
        } else {
            $courses = Course::all();
        }

        $types = SyllabusType::translatedAll();

        return view('admin.syllabus.create', [
            'course' => $course ?? null,
            'courses' => $courses ?? [],
            'types' => $types,
            'fileDisks' => FileDisk::translatedAll(),
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
            'course' => 'required|exists:courses,id',
            'type' => 'required',
            'video_file_disk' => 'required_if:type,' . SyllabusType::Video,
            'video_file' => [
                'nullable', 'mimes:mp4,mov,ogg,qt', 'max:200000',
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Video and
                    (int)$request->get('video_file_disk') == FileDisk::Local),
            ],
            'video_url' => [
                'nullable', 'url',
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Video and
                    (int)$request->get('video_file_disk') == FileDisk::URL),
            ],
            'audio_file_disk' => 'required_if:type,' . SyllabusType::Audio,
            'audio_file' => [
                'nullable', 'mimes:mp3,mpga,wav', 'max:50000',
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Audio and
                    (int)$request->get('audio_file_disk') == FileDisk::Local),
            ],
            'audio_url' => [
                'nullable', 'url',
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Audio and
                    (int)$request->get('audio_file_disk') == FileDisk::URL),
            ],
            'text' => ['required_if:type,3', 'nullable', 'string'],
            'attachments_titles.*' => ['nullable', 'string'],
            'attachments_files.*' => [
                'nullable', 'mimes:mp3,mpga,wav,mp4,mov,ogg,qt,jpeg,bmp,png,gif,svg,pdf,zip,rar', 'max:100000',
                new SyllabusAttachment($request->get('attachments_titles', [])),
            ],
            'questions_titles.*' => [
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Exam)
            ],
            'questions_choice_1.*' => [
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Exam)
            ],
            'questions_choice_2.*' => [
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Exam)
            ],
            'questions_choice_3.*' => [
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Exam)
            ],
            'questions_choice_4.*' => [
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Exam)
            ]
        ]);

        $video = $audio = $file_disk = null;

        switch ((int)$request->get('type')) {
            case SyllabusType::Video:
                $file_disk = (int)$request->get('video_file_disk');

                if ($file_disk === FileDisk::URL) {
                    $video = $request->get('video_url');
                } elseif ($file_disk === FileDisk::Local) {
                    $video = $request->file('video_file')->store('syllabuses/videos');
                }
                break;
            case SyllabusType::Audio:
                $file_disk = (int)$request->get('audio_file_disk');
                if ($file_disk === FileDisk::URL) {
                    $audio = $request->get('audio_url');
                } elseif ($file_disk === FileDisk::Local) {
                    $audio = $request->file('audio_file')->store('syllabuses/audios');
                }
                break;
            case SyllabusType::Exam:
                $exam = new Exam();
                $exam->creator_id = Auth::id();
                $exam->title = $request->get('title');
                $exam->save();

                foreach ($request->get('questions_titles') as $index => $questionTitle) {
                    $question = new Question();
                    $question->exam_id = $exam->id;
                    $question->title = preventXSS($questionTitle);
                    $question->a = preventXSS($request->get('answer_a')[$index]);
                    $question->b = preventXSS($request->get('answer_b')[$index]);
                    $question->c = preventXSS($request->get('answer_c')[$index]);
                    $question->d = preventXSS($request->get('answer_d')[$index]);
                    $question->answer = $request->get('answer')[$index];
                    $question->answer_reason = preventXSS($request->get('answer_reason')[$index]);

                    $question->save();
                }
                break;
        }

        $attachments = [];
        foreach ($request->file('attachments_files', []) as $i => $attach) {
            $attachments[$i]['title'] = $request->get('attachments_titles')[$i];
            $attachments[$i]['path'] = $attach->store('syllabuses/attachments');
        }

        $syllabus = new Syllabus();
        $syllabus->course_id = $request->get('course');
        $syllabus->type = $request->get('type');
        $syllabus->title = $request->get('title');
        $syllabus->file_disk = $file_disk;
        $syllabus->text = $request->get('text');
        $syllabus->audio = $audio;
        $syllabus->video = $video;
        $syllabus->exam_id = $exam->id ?? null;
        $syllabus->attachments = json_encode($attachments);
        $syllabus->meta_keywords = $request->get('meta_keywords');
        $syllabus->meta_description = $request->get('meta_description');
        $syllabus->save();

        return redirect()->route('admin.syllabuses.index', ['course' => $syllabus->course_id])
            ->with('success', trans('syllabuses.created'));
    }

    /**
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param Syllabus $syllabus
     * @return Factory|View
     */
    public function edit(Syllabus $syllabus)
    {
        $courses = Course::all();
        $types = SyllabusType::translatedAll();

        return view('admin.syllabus.edit', [
            'syllabus' => $syllabus,
            'courses' => $courses,
            'types' => $types,
            'fileDisks' => FileDisk::translatedAll(),
        ]);
    }

    /**
     * @param Request $request
     * @param Syllabus $syllabus
     * @return RedirectResponse
     */
    public function update(Request $request, Syllabus $syllabus)
    {
        $request->validate([
            'title' => 'required',
            'course' => 'required|exists:courses,id',
            'type' => 'required',
            'video_file_disk' => 'required_if:type,' . SyllabusType::Video,
            'video_file' => [
                'nullable', 'mimes:mp4,mov,ogg,qt', 'max:200000',
            ],
            'video_url' => [
                'nullable', 'url',
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Video and
                    (int)$request->get('video_file_disk') == FileDisk::URL),
            ],
            'audio_file_disk' => 'required_if:type,' . SyllabusType::Audio,
            'audio_file' => [
                'nullable', 'mimes:mp3,mpga,wav', 'max:50000',
            ],
            'audio_url' => [
                'nullable', 'url',
                Rule::requiredIf((int)$request->get('type') == SyllabusType::Audio and
                    (int)$request->get('audio_file_disk') == FileDisk::URL),
            ],
            'text' => ['required_if:type,3', 'nullable', 'string'],
            'attachments_titles.*' => ['nullable', 'string'],
            'attachments_files.*' => [
                'nullable', 'mimes:mp3,mpga,wav,mp4,mov,ogg,qt,jpeg,bmp,png,gif,svg,pdf,zip,rar', 'max:100000',
                new SyllabusAttachment($request->get('attachments_titles', [])),
            ],
        ]);

        $video = $audio = $file_disk = null;

        switch ((int)$request->get('type')) {
            case SyllabusType::Video:
                $file_disk = (int)$request->get('video_file_disk');
                $video = $syllabus->video;

                if ($file_disk === FileDisk::URL) {
                    $video = $request->get('video_url');
                } elseif ($file_disk === FileDisk::Local) {
                    if ($request->file('video_file')) {
                        $video = $request->file('video_file')->store('syllabuses/videos');
                    }
                }
                break;
            case SyllabusType::Audio:
                $file_disk = (int)$request->get('audio_file_disk');
                $audio = $syllabus->audio;

                if ($file_disk === FileDisk::URL) {
                    $audio = $request->get('audio_url');
                } elseif ($file_disk === FileDisk::Local) {
                    if ($request->file('audio_file')) {
                        $audio = $request->file('audio_file')->store('syllabuses/audios');
                    }
                }
                break;
            case SyllabusType::Exam:
                $exam  = $syllabus->exam;
                if(!$exam) {
                    $exam = new Exam();
                }
                $exam->title = $request->get('title');
                $exam->save();
                $exam->questions()->delete();

                foreach ($request->get('questions_titles') as $index => $questionTitle) {
                    $question = new Question();
                    $question->exam_id = $exam->id;
                    $question->title = preventXSS($questionTitle);
                    $question->a = preventXSS($request->get('answer_a')[$index]);
                    $question->b = preventXSS($request->get('answer_b')[$index]);
                    $question->c = preventXSS($request->get('answer_c')[$index]);
                    $question->d = preventXSS($request->get('answer_d')[$index]);
                    $question->answer = $request->get('answer')[$index];

                    $question->save();
                }
                break;
        }

        $attachments = [];
        $oldAttachments = $syllabus->attachments(true);

        foreach ($request->get('attachments_titles', []) as $i => $title) {
            $attachments[$i]['title'] = $title;

            if (in_array($title, array_column($oldAttachments, 'title')) and !isset($request->file('attachments_files')[$i])) {
                $attachments[$i]['path'] = $oldAttachments[$i]['path'];
            } else {
                $attachments[$i]['path'] = $request->file('attachments_files')[$i]->store('syllabuses/attachments');
            }
        }

        $syllabus->course_id = $request->get('course');
        $syllabus->type = $request->get('type');
        $syllabus->title = $request->get('title');
        $syllabus->file_disk = $file_disk;
        $syllabus->text = $request->get('text');
        $syllabus->audio = $audio;
        $syllabus->video = $video;
        $syllabus->exam_id = $exam->id ?? null;
        $syllabus->attachments = json_encode($attachments);
        $syllabus->meta_keywords = $request->get('meta_keywords');
        $syllabus->meta_description = $request->get('meta_description');
        $syllabus->save();

        return redirect()->route('admin.syllabuses.index', ['course' => $syllabus->course_id])
            ->with('success', trans('syllabuses.updated'));
    }

    /**
     * @param Syllabus $syllabus
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Syllabus $syllabus)
    {
        $syllabus->delete();

        return new JsonResponse(['message' => trans('syllabuses.deleted')]);
    }
}
