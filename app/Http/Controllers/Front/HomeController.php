<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Product;
use App\Models\Reaction;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function home()
    {
        $courses = Course::orderBy('id', 'desc')->whereHas('syllabuses')->limit(6)->get();

        $ids = Reaction::whereEntityType(Course::class)->select('entity_id')->groupBy('entity_id')
            ->orderByRaw('COUNT(*) DESC')->limit(7)->pluck('entity_id')->toArray();

        $popularCourses = Course::whereIn('id', $ids)->limit(6)->get();
        $popularProducts = Product::whereIn('id', [4, 3, 2, 1, 5, 6])->limit(6)->get();
        $latestProducts = Product::latest()->limit(6)->get();

        return view('pages.front.home', [
            'courses' => $courses,
            'popularCourses' => $popularCourses,
            'popularProducts' => $popularProducts,
            'latestProducts' => $latestProducts,
        ]);
    }
}
