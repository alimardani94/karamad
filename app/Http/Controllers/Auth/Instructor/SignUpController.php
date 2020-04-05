<?php

namespace App\Http\Controllers\Auth\Instructor;

use App\Enums\Instructor\InstructorType;
use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\User;
use App\Rules\Mobile;
use Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function show()
    {
        return view('auth.instructor.sign-up');
    }

    public function request(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'title' => ['required', 'string'],
            'about' => ['nullable', 'string'],
            'cell' => ['required', 'string', new Mobile(), 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->cell = fixNumbers($request->get('cell'));
        $user->email = $request->get('email');
        $user->surname = $request->get('surname');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        $instructor = new Instructor();
        $instructor->type = InstructorType::User;
        $instructor->user_id = $user->id;
        $instructor->title = $request->get('title');
        $instructor->about = $request->get('about');

        $instructor->save();

        $credential = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credential)) {
            return new JsonResponse([
                'message' => trans('auth.user_registered_successfully'),
                'link' => '',
            ]);
        }

        return new JsonResponse([
            'errors' => [trans('auth.failed')],
        ], 404);
    }
}

