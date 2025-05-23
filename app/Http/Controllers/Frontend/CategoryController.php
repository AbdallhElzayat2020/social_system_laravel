<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke($slug)
    {
        $category = Category::active()->whereSlug($slug)->first();  // => == $category = Category::where('slug', $slug)->first();
        if (!$category) {
            abort(404);
        }

        $posts = $category->posts()->paginate(9)->withQueryString();

        return view('frontend.pages.category-posts', compact('posts', 'category'));

    }
}
