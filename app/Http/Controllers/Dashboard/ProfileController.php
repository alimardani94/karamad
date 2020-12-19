<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\UserEmailReset;
use App\Services\Utils\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'cell', 'unique:users,cell,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#profile")->withErrors($validator)->withInput();
        }

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');

        if ($user->email != $request->get('email')) {
            $email = UserEmailReset::updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'email' => $request->input('email'),
                'token' => Random::alphabetic(32),
            ]);

            Mail::to($email->email)->send(new EmailVerification($user, $email->token));
        }

        $user->save();

        return back()->with('message', 'profile image updated');
    }

    public function imageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#profile")->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $user->image = $request->file('image')->store('profiles');
        $user->save();

        return back()->with('message', 'profile image updated');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'password'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'different:current_password']
        ]);

        if ($validator->fails()) {
            return Redirect::to(URL::previous() . "#profile")->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        Auth::logout();
        return redirect()->route('auth.otp');
    }
}
