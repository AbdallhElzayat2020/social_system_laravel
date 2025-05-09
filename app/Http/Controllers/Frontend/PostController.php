<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $mainPost = Post::with(['comments' => function ($query) {
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();
        $category = $mainPost->category;
        $relatedPosts = $category->posts()
            ->select('id', 'slug', 'title')
            ->limit(5)
            ->latest()
            ->get();

        return view('frontend.pages.show-post', compact('mainPost', 'relatedPosts'));
    }

    public function getAllPosts($slug)
    {

        $post = Post::whereSlug($slug)->first();

        $comments = $post->comments()->with('user')->get();

        return response()->json($comments);

    }

    public function saveComment(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'comment' => ['required', 'string', 'max:200'],
        ]);

        $comment = Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'ip_address' => $request->ip(),
            'comment' => $request->comment,
        ]);


        $comment->load('user');

        if (!$comment) {
            return response()->json([
                'data' => 'Failed to save comment',
                'status' => 403
            ], 500);
        }
        return response()->json([
            'msg' => 'Comment saved successfully!',
            'comment' => $comment,
            'status' => 201
        ]);
    }
}
