@foreach($posts as $post)
    <article class="mt-6">
        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <div class="flex item-center justify-between">
                    <a href="/authors/{{$post->user->slug}}"
                       class="flex items-center gap-2">
                        <img src="{{$post->user->avatar}}"
                             alt="{{$post->user->name}}"
                             class="hidden object-cover w-10 h-10 rounded-full sm:block">
                        <span
                            class="font-bold text-gray-700 hover:underline"><?= ucwords($post->user->name) ?>
                        </span>
                    </a>
                </div>
                <div class="flex gap-4 items-center">
                    @can(['update', 'delete'], $post)
                        <div class="flex gap-4 items-center">
                            <div
                                class="text-sm text-blue-400 hover:text-blue-600 font-bold rounded-md flex items-center gap-2">
                                <a href="/post/{{$post->slug}}/edit">Edit</a>
                                <svg class="h-4 w-4" width="24" height="24"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                </svg>
                            </div>
                            <div
                                class="text-sm text-red-400 hover:text-red-600 font-bold rounded-md flex items-center gap-2">
                                <form action="/post/{{$post->slug}}/delete" method="post">
                                    @csrf
                                    <button type="submit">Delete</button>
                                </form>
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                    <line x1="10" y1="11" x2="10" y2="17"/>
                                    <line x1="14" y1="11" x2="14" y2="17"/>
                                </svg>
                            </div>
                        </div>
                    @endcan
                    <span class="font-light text-gray-600">
                        {{(new DateTime($post->published_at))->format('M j, Y - G:i')}}
                    </span>
                </div>
            </div>
            <div class="flex gap-2">
                @foreach($post->categories as $category)
                    <a href="/categories/{{$category->slug}}/posts"
                       class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">
                        {{ucwords($category->name)}}
                    </a>
                @endforeach
            </div>
            <h2>
                <a href="/post/{{$post->slug}}"
                   class="text-2xl font-bold text-gray-700 hover:underline">
                    {{$post->title}}
                </a>
            </h2>
            <p class="mt-2 text-gray-600">{{$post->excerpt}}</p>
            <div class="flex items-center justify-between mt-4">
                <a href="/post/{{$post->slug}}"
                   class="text-blue-500 hover:underline">
                    Read more<span class="sr-only"> about {{$post->title}}</span>
                </a>
                <p>
                    @if (count($post->comments) > 0)
                        {{count($post->comments)}} comment{{count($post->comments) === 1 ? '' : 's'}}
                    @endif
                </p>
            </div>
        </div>
    </article>
@endforeach
