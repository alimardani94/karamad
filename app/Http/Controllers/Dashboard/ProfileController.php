<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Reaction;
use App\Models\Transaction;
use App\Models\User;
use App\Rules\CurrentPasswordCheck;
use App\Rules\Mobile;
use App\Services\Reactions\Enums\ReactionTypes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'cell' => ['required', new Mobile(), 'unique:users,cell,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        if ($validator->fails()) {
            return  Redirect::to(URL::previous() . "#profile")->withErrors($validator)->withInput();
        }


        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->email = $request->get('email');
        $user->cell = fixNumbers($request->get('cell'));

        $user->save();

        return back()->with('message', 'profile image updated');
    }

    public function imageUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,bmp,png,gif,svg|max:4096',
        ]);

        if ($validator->fails()) {
            return  Redirect::to(URL::previous() . "#profile")->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        $user->image = $request->file('image')->store('profiles');
        $user->save();

        return back()->with('message', 'profile image updated');
    }

    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string', new CurrentPasswordCheck()],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'different:current_password']
        ]);

        if ($validator->fails()) {
            return  Redirect::to(URL::previous() . "#profile")->withErrors($validator)->withInput();
        }

        $current_password = trim($request->get('current_password'));
        $new_password = trim($request->get('password'));

        $user = Auth::user();

        if (!Hash::check($current_password, $user->password)) {
            return back()->with('error', 'کلماه عبور فعلی اشتباه است');
        }

        $user->password = Hash::make($new_password);
        $user->save();

        Auth::logout();
        return redirect()->route('auth.sign-in');
    }
}
