<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Utils\imageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class ProfileController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts()->active()->latest()->with(['images'])->get();

        return view('frontend.dashboard.profile', compact('posts'));
    }

    public function storePost(PostRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->validated();
            $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);

            $post = auth()->user()->posts()->create($request->except('images'));

            // upload images from imageManager File
            imageManager::uploadImages($request, $post);

            DB::commit();

            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');
            Cache::forget('popular_posts_comments');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }

        Session::flash('success', 'Post Created Successfully');
        return redirect()->back();

    }

    public function deletePost(Request $request)
    {
        try {

            $post = Post::where('slug', $request->slug)->firstOrFail();
            imageManager::deleteImages($post);
            $post->delete();
            return redirect()->back()->with('success', 'Post Deleted Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }


    }

    public function editPost($slug)
    {

    }

    public function getComments($id)
    {
//        $post = Post::findOrFail($id);
//        $comments = $post->comments->get();

//        return $id;
        $comments = Comment::with(['user'])->where('post_id', $id)->get();
        if (!$comments) {
            return response()->json([
                'data' => null,
                'message' => 'No Comments Found'
            ]);
        }
        return response()->json([
            'data' => $comments,
        ]);

    }
}
