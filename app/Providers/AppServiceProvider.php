<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Chia sẻ biến categories với tất cả các view
        // View::composer('*', function ($view) {
        //     $categories = Category::all(); // Hoặc logic lấy categories của bạn
        //     $view->with('categories', $categories);
        // });

        // Hoặc chỉ chia sẻ với layout.header
        View::composer('layout.header', function ($view) {
            $categories = Category::all();
            $view->with('categories', $categories);
        });
    }
}
