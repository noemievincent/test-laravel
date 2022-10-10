<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment_data = $request->safe()->only('body');
        $comment_data['post_id'] = $post->id;
        $comment_data['user_id'] = auth()->user()->id;

        Comment::create($comment_data);

        $comments = Comment::with(['post', 'user'])->where('post_id', $post->id)->get();

        return view('posts.single', compact('post', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCommentRequest $request, $slug, $id)
    {
        $comment_data = $request->safe()->only('body');
        $comment = Comment::find($id);
        $comment->update($comment_data);
        return redirect('/post/' . $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($post, $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('/post/' . $post);
    }
}
