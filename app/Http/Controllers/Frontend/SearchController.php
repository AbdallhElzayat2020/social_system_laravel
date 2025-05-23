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
        $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
        ]);
        $keyword = strip_tags($request->search);

        $posts = Post::active()->where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhereHas('category', function ($query) use ($keyword) {

                $query->where('name', 'like', '%' . $keyword . '%');

            })->paginate(14)
            ->withQueryString();


        return view('frontend.pages.search', compact('posts'));
    }
}
