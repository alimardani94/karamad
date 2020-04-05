<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SignInController extends Controller
{
    public function show()
    {
        return view('auth.sign-in');
    }

    public function request(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'password' => 'required',
        ]);

        $credential = [
            'email' => $request->get('login'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credential)) {
            return new JsonResponse([
                'message' => trans('auth.user_registered_successfully'),
                'link' => route('dashboard.home'),
            ]);
        }

        $credential = [
            'cell' => $request->get('login'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($credential)) {
            return new JsonResponse([
                'message' => trans('auth.success'),
                'link' => route('dashboard.home'),
            ]);
        }

        return new JsonResponse([
            'errors' => [trans('auth.failed')],
        ], 404);
    }
}

