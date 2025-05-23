<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::active()->with('images')->latest()->paginate(9);

        $greatest_posts_views = Post::active()->orderBy('num_of_views', 'desc')
            ->limit(3)
            ->get();

        $oldest_posts = Post::active()->oldest()->take(3)->get();

        $popular_posts = Post::active()->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(3)
            ->get();

        $categories = Category::has('posts', '>=', 2)->active()->get();

        $categories_with_posts = $categories->map(function (Category $category) {
            $category->posts = $category->posts()->active()->limit(4)->get();
            return $category;
        });


        return view('frontend.pages.home', compact(
            'posts',
            'greatest_posts_views',
            'oldest_posts',
            'popular_posts',
            'categories_with_posts'
        ));
    }
}
