<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\View\Components\Aside\Categories;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index(): View|Factory|Application
    {
        $posts = Post::with('comments', 'categories', 'user');

        if (isset($_GET['order-by']) && $_GET['order-by'] === 'oldest') {
            $posts = $posts->oldest();
        } else {
            $posts = $posts->latest();
        }


        $posts = $posts->paginate(4);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|Factory|View
     */
    public function store(StorePostRequest $request)
    {
        $post_data = $request->safe()->only(['title', 'excerpt', 'body']);
        $post_data['slug'] = \Str::slug($post_data['title']);
        $post_data['user_id'] = auth()->user()->id;

        $categories = $request->input('categories');

        $post = Post::create($post_data);

        foreach ($categories as $category) {
            $post->categories()->attach($category);
        }

        return view('posts.single', compact('post'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post): View|Factory|Application
    {
        return view('posts.single', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
