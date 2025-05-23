<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Models\Post;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::when(request()->keyword, function (Builder $query) {

            $query->where('title', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {

            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->with(['user', 'category'])
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('dashboard.pages.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();

        try {
            DB::beginTransaction();

            $post = auth()->guard('admin')->user()->posts()->create($request->except('images'));

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['comments'])->withCount('comments')->findOrFail($id);
        return view('dashboard.pages.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('dashboard.pages.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {

        $request->validated();
        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $post->update($request->except('images', '_token'));

            if ($request->hasFile('images')) {
                ImageManager::deleteImages($post);
                ImageManager::uploadImages($request, $post);
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }

        Session::flash('success', 'Post Updated Successfully');
        return to_route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //delete user image and check
            $post = Post::findOrFail($id);

            ImageManager::deleteImages($post);
            $post->delete();

            Cache::forget('latest_posts');
            Cache::forget('read_more_posts');
            Cache::forget('popular_posts_comments');

            return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');

        } catch (\Exception $exception) {
            return redirect()->route('admin.posts.index')->with('error', 'Post not deleted');
        }
    }

    public function changeStatus(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->status == 'active') {
            $post->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'Post blocked successfully');
        } else {
            $post->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Post Activated successfully');
        }
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
