<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class TransactionController
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $transactions = Transaction::orderByDesc('id')->paginate(10);

        return view('pages.admin.transaction.index', [
            'transactions' => $transactions,
        ]);
    }

}
