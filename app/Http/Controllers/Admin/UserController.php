<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $users = User::whereDoesntHave('roles')->paginate(10);

        return view('pages.admin.user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        return view('pages.admin.user.show', [
            'user' => $user,
            'orders' => $user->orders,
        ]);
    }
}
