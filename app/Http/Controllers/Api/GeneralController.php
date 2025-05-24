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
        $query = Post::query();

        $all_posts = $query->get();

        $latestPosts = $query->latest()->take(4)->get();

        $oldestPosts = $query->oldest()->take(4)->get();

        $popular_posts = $query->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->take(4)
            ->get();

        $categories = Category::get();
        $categories_withPosts = $categories->map(function (Category $category) {
            $category->posts = $category->posts()->latest()->take(4)->get();
            return $category;
        });

        $most_read_posts = Post::orderBy('num_of_views', 'desc')->take(4)->get();

        return response()->json($popular_posts);
    }
}
