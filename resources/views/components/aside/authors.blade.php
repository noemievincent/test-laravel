<section class="px-8">
    <h3 class="mb-4 text-xl font-bold text-gray-700">Authors</h3>
    <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
        <ul class="-mx-4">
            @foreach($authors as $author)
                <li class="flex items-center mb-3">
                    <img
                        src="<?= $author->avatar ?>"
                        alt="avatar"
                        class="object-cover w-10 h-10 mx-4 rounded-full">
                    <div>
                        <p><a href="/authors/{{$author->slug}}/posts"
                              class="font-bold text-gray-700 hover:underline">{{ucwords($author->name)}}</a></p>
                        <span class="text-sm font-light text-gray-700">Created {{$author->posts_count}} Posts</span>
                    </div>
                </li>
            @endforeach
        </ul>
        @if(request()->has('aside-expanded'))
            <a href="{{strtok($_SERVER["REQUEST_URI"], '?')}}" class="text-blue-500 hover:underline">Reduce</a>
        @else
            <a href="{{$_SERVER['REQUEST_URI']}}?aside-expanded=authors" class="text-blue-500 hover:underline">Expand</a>
        @endif
    </div>
</section>
