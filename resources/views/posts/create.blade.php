<!doctype html>
<html lang="fr">
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
    <title>Create A New Post - My Awesome Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
<div class="overflow-x-hidden bg-gray-100">
    <x-commons.navigation></x-commons.navigation>
    <main class="px-6 py-8">
        <div class="container flex justify-between mx-auto">
            <div class="w-full lg:w-8/12">
                <div class="flex items-center justify-between">
                    <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Create Post</h1>
                </div>
                <div class="mt-6">
                    <form action="/create" method="post">
                        @csrf
                        <label for="post-title"
                               class="block mb-2">Post Title</label>
                        <input id="post-title"
                               type="text"
                               name="post-title"
                               class="w-full rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label for="post-excerpt"
                               class="block mt-8 mb-2">Post Excerpt</label>
                        <textarea name="post-excerpt"
                                  id="post-excerpt"
                                  rows="5"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        <label for="post-body"
                               class="block mt-8 mb-2">Post Body</label>
                        <textarea name="post-body"
                                  id="post-body"
                                  rows="10"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        <label for="post-category"
                               class="block mt-8 mb-2">Post Category</label>
                        <select name="post-category"
                                id="post-category"
                                class="w-full border- rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

                            <option value="">

                            </option>

                        </select>

                        <button type="submit"
                                class="float-right mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                            Create new post
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
