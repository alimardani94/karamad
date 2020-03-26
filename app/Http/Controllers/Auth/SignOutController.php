<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SignOutController extends Controller
{
    public function handle()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
