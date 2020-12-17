<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ContactFormController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $messages = ContactForm::paginate(30);

        return view('pages.admin.contact-form', [
            'messages' => $messages
        ]);
    }
}
