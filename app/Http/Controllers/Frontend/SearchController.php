<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;




class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%' . $request->search . '%')

            ->orWhere('description', 'like', '%' . $request->search . '%')

            ->orWhereHas('category', function ($query) use ($request) {

                $query->where('name', 'like', '%' . $request->search . '%');

            })->paginate(14)

            ->withQueryString();

        return view('frontend.pages.search', compact('posts'));
    }
}
