<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NewCommentNotify;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug)
    {
        $mainPost = Post::active()->with(['comments' => function ($query) {
            $query->latest()->limit(3);
        }])->whereSlug($slug)->first();

        if (!$mainPost) {
            abort(404);
        }

        $category = $mainPost->category;

        $relatedPosts = $category->posts()
            ->select('id', 'slug', 'title')
            ->limit(5)
            ->latest()
            ->get();

        $mainPost->increment('num_of_views');


        return view('frontend.pages.show-post', compact('mainPost', 'relatedPosts'));
    }

    public function getAllPosts($slug)
    {

        $post = Post::active()->whereSlug($slug)->first();

        if (!$post) {
            return response()->json([
                'data' => 'Post not found',
                'status' => 404
            ]);
        }
        $comments = $post->comments()->with('user')->get();

        if ($comments->isEmpty()) {
            return response()->json([
                'data' => 'No comments found',
                'status' => 404
            ]);
        }
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

        // send Notification
        $post = Post::findOrFail($request->post_id);
        $user = $post->user;

        // send notification db
        $user->notify(new NewCommentNotify($comment, $post));


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
