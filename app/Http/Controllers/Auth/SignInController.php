<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SignInActivityTypes;
use App\Http\Controllers\Controller;
use App\Models\SignInActivity;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SignInController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('pages.auth.sign-in');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function request(Request $request)
    {
        $request->validate([
            'cell' => 'required',
            'password' => 'required',
        ]);

        $credential = [
            'cell' => $request->get('cell'),
            'password' => $request->get('password'),
        ];

        $signInActivity = new SignInActivity();
        $signInActivity->ip = $request->getClientIp() ?? 'N/A';
        $signInActivity->agent = $request->userAgent() ?? 'N/A';

        if (Auth::attempt($credential, $request->get('remember_me'))) {
            $signInActivity->user_id = Auth::id();
            $signInActivity->type = SignInActivityTypes::SUCCESSFUL;
            $signInActivity->save();

            return new JsonResponse([
                'message' => trans('auth.user_registered_successfully'),
                'link' => route('dashboard.home'),
            ]);
        }

        if ($user = User::whereCell($credential['cell'])->first()) {
            $signInActivity->user_id = $user->id ?? 0;
            $signInActivity->type = SignInActivityTypes::FAILED;
            $signInActivity->save();
        }

        return new JsonResponse(['message' => trans('auth.failed')], 404);
    }
}

