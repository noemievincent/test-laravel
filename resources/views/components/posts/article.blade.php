@foreach($posts as $post)
    <article class="mt-6">
        <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md flex flex-col gap-2">
            <div class="flex items-center justify-between">
                <div class="flex item-center justify-between">
                    <a href="/authors/{{$post->user->slug}}/posts"
                       class="flex items-center gap-2">
                        <img src="{{$post->user->avatar}}"
                             alt="{{$post->user->name}}"
                             class="hidden object-cover w-10 h-10 rounded-full sm:block">
                        <span
                            class="font-bold text-gray-700 hover:underline"><?= ucwords($post->user->name) ?>
                        </span>
                    </a>
                </div>
                <span class="font-light text-gray-600">
                    {{(new DateTime($post->published_at))->format('M j, Y - G:i')}}
                </span>
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
                <a href="/posts/{{$post->slug}}"
                   class="text-2xl font-bold text-gray-700 hover:underline">
                    {{$post->title}}
                </a>
            </h2>
            <p class="mt-2 text-gray-600">{{$post->excerpt}}</p>
            <div class="flex items-center justify-between mt-4">
                <a href="/posts/{{$post->id}}"
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
