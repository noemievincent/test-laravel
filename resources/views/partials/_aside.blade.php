<aside class="hidden w-4/12 -mx-8 lg:block">
    <h2 class="sr-only">Posts filters</h2>
    <section class="px-8">
        <h3 class="mb-4 text-xl font-bold text-gray-700">Authors</h3>
        <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
            <ul class="-mx-4">
                @foreach($asideData['users'] as $user)
                    <li class="flex items-center mb-3">
                        <img
                            src="<?= $user->avatar ?>"
                            alt="avatar"
                            class="object-cover w-10 h-10 mx-4 rounded-full">
                        <div>
                            <p><a href="/authors/{{$user->slug}}/posts"
                                  class="font-bold text-gray-700 hover:underline">{{ucwords($user->name)}}</a></p>
                            <span class="text-sm font-light text-gray-700">Created {{count($user->posts)}} Posts</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="px-8 mt-10">
        <h3 class="mb-4 text-xl font-bold text-gray-700">Categories</h3>
        <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
            <ul>
                @foreach($asideData['categories'] as $category)
                <li class="mb-3"><a href="/categories/{{$category->slug}}/posts"
                                    class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">
                        {{ucwords($category->name)}}</a> contains {{count($category->posts)}} posts
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="px-8 mt-10">
        <h3 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h3>
        <div class="flex flex-col max-w-sm px-8 py-6 mx-auto bg-white rounded-lg shadow-md gap-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center"><img
                        src="{{$asideData['most_recent_post']->user->avatar}}"
                        alt="avatar"
                        class="object-cover w-8 h-8 rounded-full">
                    <a href="/categories/{{$asideData['most_recent_post']->user->slug}}/posts"
                       class="font-bold mx-3 text-sm text-gray-700 hover:underline">{{ucwords($asideData['most_recent_post']->user->name)}}</a>
                </div>
                <span
                    class="text-sm font-light text-gray-600"><?= (new DateTime($asideData['most_recent_post']->user->published_at))->format('M j, Y') ?></span>
            </div>
            <div>
                <a href="/posts/{{$asideData['most_recent_post']->id}}"
                   class="font-bold text-lg font-medium text-gray-700 hover:underline">{{$asideData['most_recent_post']->title}}</a>
            </div>
            <div class="flex items-center gap-2">
                @foreach($asideData['most_recent_post']->categories as $category)
                <a href="?action=index&resource=post&category=<?= $category->slug ?>"
                   class="px-2 py-1 text-sm text-green-100 bg-gray-600 rounded hover:bg-gray-500">
                        <?= ucwords($category->name) ?>
                </a>
                @endforeach
            </div>
        </div>
    </section>
</aside>
