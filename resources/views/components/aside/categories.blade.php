<section class="px-8 mt-10">
    <h3 class="mb-4 text-xl font-bold text-gray-700">Categories</h3>
    <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
        <ul>
            @foreach($categories as $category)
                <li class="mb-3"><a href="/categories/{{$category->slug}}/posts"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">
                        {{ucwords($category->name)}}</a> contains {{$category->posts_count}} posts
                </li>
            @endforeach
        </ul>
        @if(request()->has('categories-expanded'))
            <a href="/posts" class="text-blue-500 hover:underline">Reduce</a>
        @else
            <a href="/posts?categories-expanded" class="text-blue-500 hover:underline">See all categories</a>
        @endif
    </div>
</section>
