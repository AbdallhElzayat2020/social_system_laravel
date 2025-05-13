<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManager;
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

        $user = auth()->user();
        return view('frontend.dashboard.profile', compact('posts', 'user'));
    }

    public function storePost(PostRequest $request)
    {
        try {
            DB::beginTransaction();

            $request->validated();
            $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);

            $post = auth()->user()->posts()->create($request->except('images'));

            // upload images from imageManager File
            ImageManager::uploadImages($request, $post);

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
            ImageManager::deleteImages($post);
            $post->delete();
            return redirect()->back()->with('success', 'Post Deleted Successfully');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }


    }

    public function getComments($id)
    {
//        $post = Post::findOrFail($id);
//        $comments = $post->comments->get();

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

    public function showEditPost($slug)
    {
        $post = Post::with(['images'])->whereSlug($slug)->firstOrFail();
        $user = auth()->user();
        return view('frontend.dashboard.edit-post', compact('post', 'user'));
    }

    public function updatePost(PostRequest $request)
    {
        $request->validated();
        $post = Post::findOrFail($request->post_id);
        $request->comment_able == 'on' ? $request->merge(['comment_able' => 1]) : $request->merge(['comment_able' => 0]);
        $post->update($request->except('images', '_token', 'post_id'));

        if ($request->hasFile('images')) {
            // delete old images from local
            if ($post->images->count() > 0) {
                foreach ($post->images as $image) {
                    ImageManager::deleteImageFromLocal($image->path);
                    $image->delete();
                }

            }

            // store new images
            ImageManager::uploadImages($request, $post, null);
        }

        Session::flash('success', 'Post Updated Successfully');
        return to_route('frontend.dashboard.profile');

    }

    public function deletePostImage(Request $request, $image_id)
    {
        $image = Image::find($request->key);

        if (!$image) {
            return response()->json([
                'status' => 404,
                'message' => 'Image Not Found'
            ]);
        };

        ImageManager::deleteImageFromLocal($image->path);
        // delete image from database
        $image->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Image Deleted Successfully'
        ]);

    }
}
