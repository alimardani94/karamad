<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\Mobile;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'string', new Mobile(), 'unique:users,cell,'. $user->id],
            'email' => ['required', 'email', 'unique:users,email,'. $user->id],
            'image' => ['nullable', 'mimes:jpeg,png,,svg', 'max:3000'],
        ]);

        $path = $user->image;
        if($request->file('image')) {
            $path = $request->file('image')->store('admins');
        }

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->cell = fixNumbers($request->get('cell'));
        $user->email = $request->get('email');
        $user->image = $path;
        $user->save();

        return redirect()->route('admin.profiles.index')->with('success', trans('profiles.updated'));
    }
}
