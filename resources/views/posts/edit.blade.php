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
    <title>Edit your post - My Awesome Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-head.tinymce-config/>
</head>
<body class="bg-gray-200">
<div class="overflow-x-hidden bg-gray-100">
    <x-commons.navigation></x-commons.navigation>
    <main class="px-6 py-8">
        <div class="container flex justify-between mx-auto">
            <div class="w-full lg:w-8/12">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Edit your Post</h1>
                </div>
                <div class="mt-6">
                    <form action="/post/{{$post->slug}}" method="post">
                        @csrf
                        <label for="title"
                               class="@error('title') text-red-600 @enderror block mb-2">Post Title</label>
                        @error('title')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                        @enderror
                        <input id="title"
                               type="text"
                               name="title"
                               value="{{old('title') !== null ? old('title') : $post->title }}"
                               class="@error('title') outline outline-2 outline-red-600 @enderror w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-2">
                        <label for="excerpt"
                               class="@error('excerpt') text-red-600 @enderror block mt-8 mb-2">Post Excerpt</label>
                        @error('excerpt')
                        <p class="text-red-600 mb-2">{{ $message }}</p>
                        @enderror
                        <textarea name="excerpt"
                                  id="excerpt"
                                  rows="5"
                                  class="@error('excerpt') outline outline-2 outline-red-600 @enderror w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-2">{{old('excerpt') !== null ? old('excerpt') : $post->excerpt }}</textarea>
                        <x-forms.tinymce-editor :post="$post ?? null"/>
                        <x-posts.select-categories :categories="$categories" :post="$post"/>
                        <button type="submit"
                                class="float-right mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                            Edit
                        </button>
                    </form>
                </div>
            </div>
            <x-aside></x-aside>
        </div>
    </main>
    <x-commons.footer></x-commons.footer>
</div>
</body>
</html>
