<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //
    public function getPosts()
    {

        $query = Post::query()->with(['user', 'category'])->activeUser()->activeCategory()->active();

        $all_posts = $query->paginate(8);

        $latestPosts = $query->latest()->take(4)->get();

        $oldestPosts = $query->oldest()->take(4)->get();

        $popular_posts = $query->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(4)
            ->get();

        $categories = Category::active()->get();

        $categories_withPosts = $categories->map(function (Category $category) {
            $category->posts = $category->posts()->latest()->active()->take(4)->get();
            return $category;
        });

        $most_read_posts = $query->active()->orderBy('num_of_views', 'desc')->take(4)->get();


        return response()->json([
            'all_posts' => $all_posts,
            'latestPosts' => $latestPosts,
            'oldestPosts' => $oldestPosts,
            'popular_posts' => $popular_posts,
            'categories_withPosts' => $categories_withPosts,
            'most_read_posts' => $most_read_posts
        ]);
    }
}
