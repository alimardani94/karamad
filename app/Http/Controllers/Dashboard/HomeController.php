<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Reaction;
use App\Models\Transaction;
use App\Services\Reactions\Enums\ReactionTypes;
use Auth;

class HomeController extends Controller
{
    public function home()
    {
        $orders = Order::whereUserId(Auth::id())->orderByDesc('id')->paginate(10);
        $ids = Reaction::whereEntityType(Course::class)->where('type', ReactionTypes::LIKE)
            ->pluck('entity_id')->toArray();
        $courses = Course::whereIn('id', $ids)->paginate(10);
        $transactions = Transaction::whereUserId(Auth::id())->orderByDesc('id')->paginate(10);

        return view('pages.dashboard.home', [
            'orders' => $orders,
            'courses' => $courses,
            'transactions' => $transactions,
        ]);
    }
}
