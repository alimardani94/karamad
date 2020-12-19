<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\UserEmailReset;
use App\Services\Utils\Random;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * @return Factory|View
     */
    public function profile()
    {
        $user = Auth::user();
        return view('pages.admin.profile', [
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'string', 'cell', 'unique:users,cell,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'image' => ['nullable', 'mimes:jpeg,png,,svg', 'max:3000'],
        ]);

        $path = $user->image;
        if ($request->file('image')) {
            $path = $request->file('image')->store('admins');
        }

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->image = $path;
        $user->save();

        if ($user->email != $request->get('email')) {
            $email = UserEmailReset::updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'email' => $request->input('email'),
                'token' => Random::alphabetic(32),
            ]);

            Mail::to($email->email)->send(new EmailVerification($user, $email->token));
        }

        return redirect()->route('admin.profiles.index')->with('success', trans('profiles.updated'));
    }
}
