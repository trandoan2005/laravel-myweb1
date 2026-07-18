<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Chỉ tải dữ liệu cho Navbar
        \Illuminate\Support\Facades\View::composer('client.partials.header', function ($view) {
            $categories = \Illuminate\Support\Facades\Cache::remember(
                'navbar_categories',
                now()->addHours(1),
                function () {
                    return \App\Models\Category::select('cateid', 'catename', 'slug')
                        ->where('status', 1)
                        ->orderBy('catename')
                        ->take(10)
                        ->get();
                }
            );

            $brands = \Illuminate\Support\Facades\Cache::remember(
                'navbar_brands',
                now()->addHours(1),
                function () {
                    return \App\Models\Brand::select('id', 'brandname', 'slug')
                        ->where('status', 1)
                        ->orderBy('brandname')
                        ->take(10)
                        ->get();
                }
            );

            $view->with(compact('categories', 'brands'));
        });
    }
}