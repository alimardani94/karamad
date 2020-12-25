<?php

namespace App\Http\Controllers\Front;

use App\Enums\Shop\ProductStatus;
use App\Models\Course;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function search(Request $request)
    {
        $q = $request->get('q');

        $courses = Course::where('title', 'like', "%$q%")->limit(4)->get();
        $posts = Post::where('title', 'like', "%$q%")->limit(4)->get();
        $products = Product::whereStatus(ProductStatus::CONFIRMED)->where('name', 'like', "%$q%")->limit(4)->get();

        return view('pages.front.search.search', [
            'courses' => $courses,
            'posts' => $posts,
            'products' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function courseSearch(Request $request)
    {
        $q = $request->get('q');

        $courses = Course::where('title', 'like', "%$q%")->paginate(12);

        return view('pages.front.search.course_search', [
            'courses' => $courses,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function postSearch(Request $request)
    {
        $q = $request->get('q');

        $posts = Post::where('title', 'like', "%$q%")->paginate(12);

        return view('pages.front.search.post_search', [
            'posts' => $posts,
        ]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function productSearch(Request $request)
    {
        $q = $request->get('q');

        $products = Product::whereStatus(ProductStatus::CONFIRMED)->where('name', 'like', "%$q%")->paginate(12);

        return view('pages.front.search.product_search', [
            'products' => $products,
        ]);
    }
}
