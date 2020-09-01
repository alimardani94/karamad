<?php

namespace App\Http\Controllers\Front\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Services\Reactions\Enums\ReactionTypes;
use App\Services\Reactions\Reactor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{

    /**
     * Display the courses.
     *
     * @return Factory|View
     */
    public function index()
    {
        $courses = Course::paginate(12);

        return view('front.course.courses', [
            'courses' => $courses,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);

        return view('front.course.course', [
            'course' => $course,
        ]);
    }

    public function react(int $course, Request $request)
    {
        $this->validate($request, [
            'type' => ['required', 'in:' . join(',', ReactionTypes::values())],
        ]);

        $type = $request->input('type');
        $course = Course::findOrFail($course);

        /** @var Reactor $reactor */
        $reactor = app(Reactor::class);
        $reactor->set($course, $type, auth()->id() ?: 0);

        $reactions = $reactor->count($course);
        $likes = $reactions[ReactionTypes::LIKE] ?? 0;
        $dislikes = $reactions[ReactionTypes::DISLIKE] ?? 0;

        return new JsonResponse([
            'likes' => $likes,
            'dislikes' => $dislikes,
            'reaction' => $type,
        ]);
    }

}
