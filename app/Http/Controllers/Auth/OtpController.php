<?php

namespace App\Http\Controllers\Auth;

use App\Enums\SignInActivityTypes;
use App\Http\Controllers\Controller;
use App\Jobs\Users\SendSms;
use App\Models\SignInActivity;
use App\Models\User;
use App\Services\Otp\Otp;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OtpController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('pages.auth.otp');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function request(Request $request)
    {
        $request->validate([
            'cell' => ['required', 'cell'],
        ]);

        $cell = $request->input('cell');

        /** @var Otp $otp */
        $otp = app(Otp::class);
        $code = $otp->store($cell);

        if (app()->environment('local')) {
            return new JsonResponse([
                'message' => $code,
                'expires_after' => config('otp.targets.sms.ttl'),
            ]);
        }

        SendSms::dispatch($cell, trans('auth.otp-sms', ['otp' => $code]));

        return new JsonResponse([
            'message' => trans('auth.code_sent'),
            'expires_after' => config('otp.targets.sms.ttl'),
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     * @throws ValidationException
     */
    public function submit(Request $request)
    {
        $this->validate($request, [
            'cell' => ['required', 'cell'],
            'code' => ['required', 'numeric', 'digits:6', 'check_otp'],
        ]);

        $cell = $request->input('cell');

        $user = User::withTrashed()->wherecell($cell)->first();

        if (empty($user)) {
            $user = new User();
            $user->cell = $cell;
            $user->cell_verified_at = Carbon::now();
            $user->save();
        }

        if ($user->trashed()) {
            throw new Exception('this user is deleted, you cant use this cell');
        }

        auth()->loginUsingId($user->id, true);

        $signInActivity = new SignInActivity();
        $signInActivity->ip = $request->getClientIp() ?? 'N/A';
        $signInActivity->agent = $request->userAgent() ?? 'N/A';
        $signInActivity->user_id = $user->id;
        $signInActivity->type = SignInActivityTypes::SUCCESSFUL;
        $signInActivity->save();

        return new JsonResponse([
            'redirect' => route('dashboard.index'),
        ]);
    }
}
