<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Utils\imageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.profile');
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
}
