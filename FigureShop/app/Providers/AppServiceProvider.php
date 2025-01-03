<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $renderCategories = Category::where('isDeleted', 0)->whereNull('parent_id')->get();
            $renderSubCategories = Category::where('isDeleted', 0)->whereNotNull('parent_id')->get();
            $renderPosts = Post::with('user')->where('isDeleted', 0)->get();

            $view->with('renderCategories', $renderCategories);
            $view->with('renderSubCategories', $renderSubCategories);
            $view->with('renderPosts', $renderPosts);
        });
    }
}
