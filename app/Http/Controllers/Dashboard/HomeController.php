<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('dashboard.home', []);
    }
}
