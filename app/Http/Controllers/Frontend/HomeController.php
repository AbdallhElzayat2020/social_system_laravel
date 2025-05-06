<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('images')->latest()->paginate(9);

        $greatest_posts_views = Post::orderBy('num_of_views', 'desc')
            ->limit(3)
            ->get();

        $oldest_posts = Post::oldest()->take(3)->get();

        $popular_posts = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(3)
            ->get();

        return view('frontend.pages.home', compact('posts', 'greatest_posts_views', 'oldest_posts', 'popular_posts'));
    }
}
