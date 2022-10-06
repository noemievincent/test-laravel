<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PostsByCategoriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke(Category $category)
    {
        $posts = $category->posts();

        if (isset($_GET['order-by']) && $_GET['order-by'] === 'oldest') {
            $posts = $posts->oldest();
        } else {
            $posts = $posts->latest();
        }

        $posts = $posts->paginate(4);

        return view('posts.index_by_category', compact('posts', 'category'));
    }
}
