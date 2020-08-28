<?php

namespace App\Http\Controllers\Front;

use App\Models\Blog\Post;
use App\Models\Course\Course;
use App\Http\Controllers\Controller;
use App\Models\Shop\Product;
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
        $products = Product::where('name', 'like', "%$q%")->limit(4)->get();

        return view('front.search.search', [
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

        return view('front.search.course_search', [
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

        return view('front.search.post_search', [
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

        $products = Product::where('name', 'like', "%$q%")->paginate(12);

        return view('front.search.product_search', [
            'products' => $products,
        ]);
    }
}
