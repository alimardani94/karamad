<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\Shop\ProductType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\Reaction;
use App\Models\Tag;
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

        $productCategories = ProductCategory::where('parent_id', '<>', null)->get();

        return view('pages.dashboard.index', [
            'orders' => $orders,
            'courses' => $courses,
            'transactions' => $transactions,
            'productCategories' => $productCategories,
            'tags' => Tag::all(),
            'productTypes' => ProductType::translatedAll(),
        ]);
    }
}
