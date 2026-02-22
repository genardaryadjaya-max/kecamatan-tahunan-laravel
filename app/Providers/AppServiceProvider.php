<?php

namespace App\Providers;

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
        // Share potensi categories with navbar component
        view()->composer('components.navbar', function ($view) {
            $categoryLabels = [
                'pertanian' => 'Pertanian',
                'industri' => 'Industri & Kerajinan',
                'wisata' => 'Wisata',
                'peternakan' => 'Peternakan',
            ];

            // Get distinct categories from database
            $dbCategories = \App\Models\Potensi::active()
                ->select('category')
                ->distinct()
                ->orderBy('category')
                ->pluck('category');

            // Build categories array with labels
            $potensiCategories = $dbCategories->map(function ($category) use ($categoryLabels) {
                return [
                    'slug' => $category,
                    'label' => $categoryLabels[$category] ?? ucfirst($category),
                ];
            });

            $view->with('potensiCategories', $potensiCategories);
        });
    }
}
