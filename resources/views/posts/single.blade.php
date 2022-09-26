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
    <title>{{$post->title}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
<div class="overflow-x-hidden bg-gray-100">
    @include('partials._header')
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
                                <a href="/?action=index&resource=post&author={{$post->user->slug}}"
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
                                <a href="/?action=index&resource=post&category=<?= strtolower($category->slug) ?>"
                                   class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500"><?= ucwords($category->name) ?></a>
                            @endforeach
                        </div>
                        <div class="mt-2 text-gray-600">
                            {!!$post->body!!}
                        </div>
                    </div>
                </div>
            </article>
            @include('partials._aside')
        </div>
    </main>
    @include('partials._footer')
</div>
</body>
</html>
