<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SchoolGrades;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\School;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SignUpController extends Controller
{
    /**
     * @return Factory|View
     */
    public function show()
    {
        if (Auth::user()->name != null) {
            abort(404);
        }

        $provinces = Province::select(['id', 'name'])->get();
        $grades = SchoolGrades::translatedAll();

        return view('pages.auth.sign-up', [
            'provinces' => $provinces,
            'grades' => $grades,
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function request(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'surname' => ['required', 'string', 'max:150'],
            'email' => ['nullable', 'email', 'unique:users'],
            'province' => ['required', 'exists:provinces,id'],
            'city' => ['required', 'exists:cities,id'],
            'school' => [Rule::requiredIf($request->get('type') === 'student'), 'string'],
            'grade' => [Rule::requiredIf($request->get('type') === 'student'), Rule::in(SchoolGrades::values())],
        ]);

        $user = Auth::user();

        if ($request->has('school')) {
            $school = new School();
            $school->name = $request->get('school');
            $school->city_id = $request->get('city');
            $school->save();

            $user->school_id = $school->id;
            $user->grade = $request->get('grade');
        }

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->province_id = $request->get('province');
        $user->city_id = $request->get('city');
        $user->save();

        return new JsonResponse([
            'redirect' => route('dashboard.home'),
        ]);
    }
}

