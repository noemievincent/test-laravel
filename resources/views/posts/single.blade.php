<?php
//dd($comments);
?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon"
          sizes="180x180"
          href="/apple-touch-icon.png">
    <link rel="icon"
          type="image/png"
          sizes="32x32"
          href="/favicon-32x32.png">
    <link rel="icon"
          type="image/png"
          sizes="16x16"
          href="/favicon-16x16.png">
    <link rel="manifest"
          href="/site.webmanifest">
    <link rel="mask-icon"
          href="/safari-pinned-tab.svg"
          color="#0ed3cf">
    <meta name="msapplication-TileColor"
          content="#0ed3cf">
    <meta name="theme-color"
          content="#0ed3cf">
    <title>{{$post->title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
<div class="overflow-x-hidden bg-gray-100">
    <x-commons.navigation></x-commons.navigation>
    <main class="px-6 py-8">
        <div class="container flex justify-between mx-auto">
            <article class="w-full lg:w-8/12">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-700 md:text-2xl">{{$post->title}}</h2>
                </div>
                <div class="mt-6">
                    <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md flex flex-col gap-2">
                        <div class="flex items-center justify-between">
                            <div class="flex item-center justify-between">
                                <a href="/authors/{{$post->user->slug}}/posts"
                                   class="flex items-center gap-2">
                                    <img src="{{$post->user->avatar}}"
                                         alt="{{$post->user->name}}"
                                         class="hidden object-cover w-10 h-10 rounded-full sm:block">
                                    <span
                                        class="font-bold text-gray-700 hover:underline"><?= ucwords($post->user->name) ?></span>
                                </a>
                            </div>
                            <span class="font-light text-gray-600">
                                    {{(new DateTime($post->published_at))->format('M j, Y - G:i')}}
                                </span>
                        </div>
                        <div class="flex gap-2">
                            @foreach($post->categories as $category)
                                <a href="/categories/{{$category->slug}}/posts"
                                   class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500"><?= ucwords($category->name) ?></a>
                            @endforeach
                        </div>
                        <div class="mt-2 text-gray-600">
                            {!!$post->body!!}
                        </div>
                    </div>
                </div>
                <div class="mt-10">
                    @if(!(request()->has('create-comment')))
                        <a href="?create-comment"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-md">Add a new
                            comment</a>
                    @endif
                    @auth
                        @if(request()->has('create-comment'))
                            <div class="createComment">
                                <form action="/{{$post->slug}}/comment/create"
                                      method="post">
                                    @csrf
                                    <label for="body"
                                           class="block mb-2 text-lg font-bold text-gray-700">Add a new comment</label>
                                    <textarea name="body"
                                              id="body"
                                              rows="7"
                                              class="pl-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"><?= $_SESSION['old']['comment-body'] ?? '' ?></textarea>
                                    <div class="flex items-center mt-4 gap-6">
                                        <button type="submit" id="addComment"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                                            Post
                                        </button>
                                        <a href="?" class="text-blue-500 hover:underline">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="mt-5">
                    @foreach ($comments as $comment)
                        <div class="pb-4 flex flex-col border-black border-b">
                            <div class="container flex justify-between items-center gap-3 mt-3">
                                <div class="container flex items-center gap-3 mt-3 mb-3">
                                    <img class="rounded-t-full rounded-b-full max-h-12"
                                         src="{{$comment->user->avatar}}"
                                         alt="Avatar de {{ucwords($comment->user->name)}}">
                                    <p><a href="/authors/{{ $comment->user->slug }}"
                                          class="mx-1 font-bold text-gray-700 hover:underline">{{ ucwords($comment->user->name) }}</a>
                                </div>
                                <div class="flex gap-4">
                                    @auth
                                        @if(auth()->user()->name === $comment->user->name)
                                            <a href="?modify-comment">✏️</a>
                                        @endif
                                    @endauth
                                    @auth
                                        @if(auth()->user()->name === $comment->user->name)
                                            <form action="/comment/destroy" method="post">
                                                @csrf
                                                <button type="submit">❌︎</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="container flex">
                                <span class="font-light text-gray-600 mb-4">
                                    {{(new DateTime($comment->created_at))->format('M j, Y - G:i')}}
                                </span>
                            </div>
                            @auth
                                @if(auth()->user()->name === $comment->user->name && request()->has('modify-comment'))
                                    <div class="update">
                                        <form action="/{{$post->slug}}/comment/update" method="post">
                                            @csrf
                                            <label for="body"
                                                   class="block mb-2 text-lg font-bold text-gray-700">Modify your comment</label>
                                            <textarea name="body"
                                                      id="body"
                                                      rows="7"
                                                      class="pl-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{$comment->body}}</textarea>
                                            <div class="flex items-center mt-4  gap-6">
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md"
                                                    type="submit">Modify
                                                </button>
                                                <a href="?" class="text-blue-500 hover:underline">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            @if(!(request()->has('modify-comment')))
                                <p>{{$comment->body}}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </article>
            <x-aside></x-aside>
        </div>
    </main>
    <x-commons.footer></x-commons.footer>
</div>
</body>
</html>
