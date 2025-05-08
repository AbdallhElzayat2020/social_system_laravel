<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $post = Post::whereSlug($slug)->first();
        $category = $post->category;
        $relatedPosts = $category->posts()
            ->select('id', 'slug', 'title')
            ->limit(5)
            ->latest()
            ->get();
        return view('frontend.pages.show-post', compact('post', 'relatedPosts'));
    }
}
