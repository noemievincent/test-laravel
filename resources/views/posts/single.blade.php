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
                            <div class="flex gap-6 items-center">
                                <span class="font-light text-gray-600">
                                    {{(new DateTime($post->published_at))->format('M j, Y - G:i')}}
                                </span>
                                @can(['update', 'delete'], $post)
                                    <div class="flex gap-4">
                                        <div
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md flex items-center gap-3">
                                            <a href="/post/{{$post->slug}}/edit">Edit</a>
                                            <svg class="h-5 w-5 text-white" <svg  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" /></svg>
                                        </div>
                                        <div
                                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md flex items-center gap-3">
                                            <form action="/post/{{$post->slug}}/delete" method="post">
                                                @csrf
                                                <button type="submit">Delete</button>
                                            </form>
                                            <svg class="h-5 w-5 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" />  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" /></svg>
                                        </div>
                                    </div>
                                @endcan
                            </div>
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
                                <p class="text-lg font-bold text-gray-700">Add a new comment</p>
                                <form action="/post/{{$post->slug}}/comment"
                                      method="post">
                                    @csrf
                                    <label for="body"
                                           class="@error('body') text-red-600 @enderror block mb-2">Write your
                                        comment</label>
                                    @error('body')
                                    <p class="text-red-600 mb-2">{{ $message }}</p>
                                    @enderror
                                    <textarea name="body"
                                              id="body"
                                              rows="7"
                                              class="@error('body') outline outline-2 outline-red-600 @enderror pl-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('body') }}</textarea>
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
                @if($comments)
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
                                    @auth
                                        @if(auth()->user()->name === $comment->user->name)
                                            <div class="flex gap-4">
                                                <a href="?modify-comment&id={{$comment->id}}">✏️</a>
                                                <form action="/post/{{$post->slug}}/comment/{{$comment->id}}/delete"
                                                      method="post">
                                                    @csrf
                                                    <button type="submit">❌︎</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                                <div class="container flex">
                                <span class="font-light text-gray-600 mb-4">
                                    {{(new DateTime($comment->created_at))->format('M j, Y - G:i')}}
                                </span>
                                </div>
                                @auth
                                    @if(auth()->user()->name === $comment->user->name && request()->has('modify-comment') && request('id') == $comment->id)
                                        <div class="update">
                                            <form action="/post/{{$post->slug}}/comment/{{$comment->id}}" method="post">
                                                @csrf
                                                <label for="body"
                                                       class="@error('body') text-red-600 @enderror block mb-2 text-lg font-bold text-gray-700">Modify
                                                    your
                                                    comment</label>
                                                @error('body')
                                                <p class="text-red-600 mb-2">{{ $message }}</p>
                                                @enderror
                                                <textarea name="body"
                                                          id="body"
                                                          rows="7"
                                                          class="@error('body') outline outline-2 outline-red-600 @enderror pl-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{old('body') !== null ? old('body') : $comment->body }}</textarea>
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
                                <p>{{$comment->body}}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </article>
            <x-aside></x-aside>
        </div>
    </main>
    <x-commons.footer></x-commons.footer>
</div>
</body>
</html>
