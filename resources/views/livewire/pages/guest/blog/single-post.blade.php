<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <header class="mb-6">
        <h1 class="text-4xl font-bold text-neutral-900 dark:text-neutral-100 leading-tight mb-4">
            {{ $post->title }}
        </h1>
        <p class="text-sm text-neutral-600 dark:text-neutral-400 space-x-2">
            <span>{{ $post->created_at->translatedFormat('d F Y') }} · {{ $post->read_time }}</span>

            {{-- Author --}}
            <span>· Ditulis oleh
                <a href="#" class="font-medium text-indigo-600 hover:underline">
                    {{ $post->author->name }}
                </a>
            </span>

            {{-- Category --}}
            @if ($post->category)
                <span>· Kategori
                    <a href="{{ route('blog.category', $post->category->slug) }}" class="font-semibold hover:underline">
                        {{ $post->category->name }}
                    </a>
                </span>
            @endif
        </p>
    </header>

    {{-- Cover Image --}}
    @if ($post->cover_url)
        <img src="{{ $post->cover_url }}" alt="{{ $post->title }}"
            class="w-full h-80 object-cover rounded-xl shadow mb-6">
    @endif

    <article class="prose dark:prose-invert max-w-none">
        {!! $post->body !!}

        {{-- Tags --}}
        @if ($post->tags->count())
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach ($post->tags as $tag)
                    {{-- <a href="{{ route('blog.tag', $post->tags->name) }}" --}}
                    <a href="#"
                        class="px-3 py-1 text-xs rounded-full bg-indigo-50 text-indigo-600 hover:bg-indigo-100">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
    </article>

    {{-- Related Posts --}}
    @if ($relatedPosts->count())
        <section class="mt-12">
            <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-100 mb-6">
                Artikel Terkait
            </h2>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($relatedPosts as $related)
                    <article class="group space-y-2">
                        <a href="{{ route('blog.read', $related->slug) }}" class="block">
                            <img src="{{ $related->cover_url }}" alt="{{ $related->title }}"
                                class="w-full h-40 object-cover rounded-lg shadow group-hover:opacity-90 transition" />
                            <h3
                                class="mt-3 text-lg font-medium text-neutral-900 dark:text-neutral-100 group-hover:text-indigo-600">
                                {{ $related->title }}
                            </h3>
                        </a>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">
                            {{ $related->created_at->translatedFormat('d F Y') }}
                        </p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
