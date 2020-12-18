<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $users = User::whereHas('roles')->paginate(20);

        return view('pages.admin.admin.index', [
            'admins' => $users,
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('pages.admin.admin.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'string', 'cell', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->cell = fixNumbers($request->get('cell'));
        $user->email = $request->get('email');
        $user->password = Hash::make($user->cell);
        $user->save();

        $role = Role::updateOrCreate([
            'title' => 'super_admin'
        ], [
            'permissions' => json_encode(['super-admin']),
        ]);

        $user->roles()->save($role);

        return redirect()->route('admin.admins.index')->with('success', trans('admins.created'));
    }

    /**
     * @param User $admin
     * @return Factory|View
     */
    public function edit(User $admin)
    {
        return view('pages.admin.admin.edit', [
            'admin' => $admin,
        ]);

    }

    /**
     * @param Request $request
     * @param User $admin
     * @return RedirectResponse
     */
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'string', 'cell', 'unique:users,cell,' . $admin->id],
            'email' => ['required', 'email', 'unique:users,email,' . $admin->id],
        ]);

        $admin->name = $request->get('name');
        $admin->surname = $request->get('surname');
        $admin->cell = fixNumbers($request->get('cell'));
        $admin->email = $request->get('email');
        $admin->password = Hash::make($admin->cell);
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', trans('admins.updated'));
    }

    /**
     * @param User $admin
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(User $admin)
    {
        if ($admin->id == Auth::id()) {
            return new JsonResponse(['message' => trans('admins.you_cant_delete_yourself')], 403);
        }

        $admin->delete();

        return new JsonResponse(['message' => trans('admins.deleted')]);
    }

}
