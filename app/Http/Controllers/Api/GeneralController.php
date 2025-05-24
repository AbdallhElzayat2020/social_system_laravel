<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LatestPostResouce;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getPosts()
    {
        $query = Post::query()->with(['user', 'category', 'admin'])->activeUser()->activeCategory()->active();

        $all_posts = clone $query->latest()->get();

        $all_posts = PostResource::collection($all_posts);

//        $latest_posts = $this->latestPosts($query);
        $latest_posts = LatestPostResouce::collection($this->latestPosts($query));

        $oldest_posts = $this->oldestPosts($query);

        $popular_posts = $this->popularPosts($query);

        $categories_withPosts = $this->categoriesWithPost();

        $most_read_posts = $this->mostReadPosts($query);

        return response()->json([
            'all_posts' => $all_posts,
            'latest_posts' => $latest_posts,
            'oldest_posts' => $oldest_posts,
            'popular_posts' => $popular_posts,
            'categories_withPosts' => $categories_withPosts,
            'most_read_posts' => $most_read_posts
        ]);
    }


    /*
    --------------------------------------------------------------------------
     Functions for retrieving latest, oldest,  popular posts , categoriesWithPost
    --------------------------------------------------------------------------
    */

    public function latestPosts($query)
    {
        return $query->latest()->take(4)->get();
    }

    public function oldestPosts($query)
    {
        return $query->oldest()->take(4)->get();
    }

    public function popularPosts($query)
    {
        return $query->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(4)
            ->get();
    }

    public function categoriesWithPost()
    {
        $categories = Category::active()->get();

        return $categories->map(function (Category $category) {
            $category->posts = $category->posts()->latest()->active()->take(4)->get();
            return $category;
        });
    }

    public function mostReadPosts($query)
    {
        return $query->active()->orderBy('num_of_views', 'desc')->take(4)->get();
    }
}
