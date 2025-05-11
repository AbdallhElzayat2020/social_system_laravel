<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CacheServicesProvider extends ServiceProvider
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
        // Check if the read more posts are already cached
        if (!Cache::has('read_more_posts')) {

            $read_more_posts = Post::select('id', 'title', 'slug')->latest()->limit(10)->get();
            Cache::remember('read_more_posts', 3600, function () use ($read_more_posts) {
                return $read_more_posts;
            });

        }

        // Check if the latest posts are already cached
        if (!Cache::has('latest_posts')) {

            $latest_posts = Post::select('id', 'title', 'slug')->latest()->limit(5)->get();

            Cache::remember('latest_posts', 3600, function () use ($latest_posts) {
                return $latest_posts;
            });

        }

        // Check if the popular posts with comments are already cached
        if (!Cache::has('popular_posts_comments')) {
            $popular_posts_comments = Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->limit(5)
                ->get();

            Cache::remember('popular_posts_comments', 3600, function () use ($popular_posts_comments) {
                return $popular_posts_comments;
            });
        }


        // Get data from the cache
        $latest_posts = Cache::get('latest_posts');
        $read_more_posts = Cache::get('read_more_posts');
        $popular_posts_comments = Cache::get('popular_posts_comments');


        // Share the data with all views
        view()->share([
            'read_more_posts' => $read_more_posts,
            'latest_posts' => $latest_posts,
            'popular_posts_comments' => $popular_posts_comments,
//            'popular_posts' => Cache::get('popular_posts'),
        ]);
    }
}
