<x-front-main-layout>
    <div class="overflow-x-hidden bg-gray-100">
        <x-commons.navigation></x-commons.navigation>
        <main class="px-6 py-8">
            <div class="container flex justify-between mx-auto">
                <div class="w-full lg:w-8/12">
                    <div class="flex items-center justify-between">
                        <h1 class="mb-6 text-xl font-bold text-gray-700 md:text-2xl">Posts</h1>
                        <?php // sélecteur d’ordre ?>
                    </div>
                    <ul class="flex flex-col list-disc mb-6">
                        @foreach ($posts as $post)
                            <li>
                                <h2 class="mt-2">
                                    <a href="/posts/{{ $post->slug }}"
                                       class="text-2xl font-bold text-blue-700 hover:text-gray-600 hover:underline">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                            </li>
{{--                            <article>--}}
{{--                                <div class="max-w-4xl px-6 py-6 mx-auto bg-white rounded-lg shadow-md">--}}
{{--                                    <h2 class="mt-2">--}}
{{--                                        <a href="/posts/{{ $post->slug }}"--}}
{{--                                           class="text-2xl font-bold text-blue-700 hover:text-gray-600 hover:underline">--}}
{{--                                            {{ $post->title }}--}}
{{--                                        </a>--}}
{{--                                    </h2>--}}
{{--                                </div>--}}
{{--                            </article>--}}
                        @endforeach
                    </ul>
                    {{ $posts->links() }}
                </div>
                <x-aside></x-aside>
            </div>
        </main>
        <x-commons.footer></x-commons.footer>
    </div>
</x-front-main-layout>
