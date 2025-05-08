<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\RelatedNewsSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

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

        if (!Cache::has('latest_posts')) {

            $latest_posts = Post::select('id', 'title', 'slug')->latest()->limit(5)->get();

            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });

        }

        if (!Cache::has('popular_posts_comments')) {
            $popular_posts_comments = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->limit(5)
                ->get();

            Cache::remember('popular_posts_comments', 3600, function () use ($popular_posts_comments) {
                return $popular_posts_comments;
            });
        }

        // share the related sites with all views from the database
        $relatedSites = RelatedNewsSite::select('id', 'name', 'url')->get();

        //share categories with all views from the database
        $categories = Category::select('id', 'name', 'slug')->get();



        // Get the latest posts and popular posts from the cache
        $latest_posts = Cache::get('latest_posts');

        // Get the popular posts with comments from the cache
        $popular_posts_comments = Cache::get('popular_posts_comments');

        view()->share([
            'latest_posts' => $latest_posts,
            'popular_posts_comments' => $popular_posts_comments,
            'relatedSites' => $relatedSites,
            'categories' => $categories,
        ]);
    }
}
