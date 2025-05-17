<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
}
