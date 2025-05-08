<?php

namespace App\Providers;

use App\Models\Post;
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


        $latest_posts = Cache::get('latest_posts');

        $popular_posts_comments = Cache::get('popular_posts_comments');

        view()->share([
            'latest_posts' => $latest_posts,
            'popular_posts_comments' => $popular_posts_comments,
        ]);
    }
}
