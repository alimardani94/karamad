<?php

namespace App\Http\Controllers\Front;

use App\Models\ContactForm;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ContactUsController extends Controller
{

    /**
     * @return Factory|View
     */
    public function show()
    {
        return view('front.contact-us');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function request(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'body' => ['required', 'max:1000'],
        ]);

        $form = new ContactForm();
        $form->user_id = Auth::id();
        $form->name = $request->get('name');
        $form->email = $request->get('email');
        $form->cell = $request->get('cell');
        $form->body = $request->get('body');
        $form->save();

        return back()->with('success', trans('contact-form.created'));
    }
}
