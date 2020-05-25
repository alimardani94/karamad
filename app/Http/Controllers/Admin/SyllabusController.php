<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FileDisk;
use App\Enums\Syllabus\SyllabusType;
use App\Models\Category;
use App\Models\Course;
use App\Models\Syllabus;
use App\Rules\CheckCategoryParent;
use App\Rules\SyllabusAttachment;
use App\Rules\UniqueCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Storage;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->get('course')) {
            $syllabuses = Syllabus::where('course_id', $request->get('course'))->get();
        } else {
            $syllabuses = Syllabus::all();
        }

        return view('admin.syllabus.index', [
            'syllabuses' => $syllabuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'course' => 'required',
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
        ]);

        $video = null;
        $audio = null;

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
            default:
                $file_disk = null;
        }

        $attachments = [];
        foreach ($request->file('attachments_files', []) as $i => $attach) {
            $attachments[$i]['path'] = $request->get('attachments_titles')[$i];
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
        $syllabus->attachments = json_encode($attachments);
        $syllabus->meta_description = $request->get('title');
        $syllabus->save();

        return redirect()->route('admin.courses.index')->with('success', trans('syllabuses.created'));
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
