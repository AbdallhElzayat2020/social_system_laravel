<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\RelatedNewsSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class ViewServiesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // share the related sites with all views from the database
        if (Schema::hasTable('related_sites') && Schema::hasTable('categories')) {
            $relatedSites = RelatedNewsSite::select('id', 'name', 'url')->get();
            $categories = Category::active()->select('id', 'name', 'slug')->get();

            view()->share([
                'relatedSites' => $relatedSites,
                'categories' => $categories,
            ]);
        }
    }
}
