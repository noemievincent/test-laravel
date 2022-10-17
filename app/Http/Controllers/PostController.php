<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Comment;
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

        $category_id = $request->safe()->only('category_id');

        $post = Post::create($post_data);

        foreach ($category_id as $id) {
            $post->categories()->attach($id);
        }

        return redirect('/post/' . $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(Post $post): Application|Factory|View
    {
        $comments = Comment::with('post', 'user')->where('post_id', $post->id)->get();
        return view('posts.single', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(Post $post)
    {
        $post = Post::find($post->id);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post = Post::find($post->id);

        $post_data = $request->safe()->only(['title', 'excerpt', 'body']);
        $post_data['slug'] = \Str::slug($post_data['title']);
        $post_data['user_id'] = auth()->user()->id;

        $category_id = $request->safe()->only('category_id');

        $post->update($post_data);

        foreach ($category_id as $id) {
            $post->categories()->attach($id);
        }

        return redirect('/post/' . $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        $post->delete();
        return redirect('/posts');
    }
}
