<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Rules\Mobile;
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
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $admins = Admin::paginate(10);

        return view('admin.admin.index', [
            'admins' => $admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'string', new Mobile(), 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
        ]);

        $user = new User();
        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->cell = fixNumbers($request->get('cell'));
        $user->email = $request->get('email');
        $user->password = Hash::make($user->cell);
        $user->save();

        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', trans('admins.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.admin.edit', [
            'admin' => $admin,
            'user' => $admin->user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        /**
         * @var User $user
         */
        $user = $admin->user;

        $request->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'cell' => ['required', 'string', new Mobile(), 'unique:users,cell,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->name = $request->get('name');
        $user->surname = $request->get('surname');
        $user->cell = fixNumbers($request->get('cell'));
        $user->email = $request->get('email');
        $user->password = Hash::make($user->cell);
        $user->save();


        return redirect()->route('admin.admins.index')->with('success', trans('admins.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $user = $admin->user;

        $user->delete();
        $admin->delete();

        return new JsonResponse(['message' => trans('admins.deleted')]);
    }

}
