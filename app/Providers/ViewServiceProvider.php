<?php

namespace App\Providers;

use App\Enums\CategoryType;
use App\Models\Course;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        View::composer('dashboard.*', function ($view) {
            $view->with('authUser', Auth::user());
        });

        View::composer('*', function ($view) {
            $view->with('headerCategories', Category::whereType(CategoryType::Course)->where('parent_id', 0)->limit(3)->get());
        });
        View::composer('*', function ($view) {
            $view->with('headerPost', Post::first());
        });
        View::composer('*', function ($view) {
            $view->with('headerCourses', Course::withCount('syllabuses')->limit(3)->get());
        });
    }
}
