<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold mb-8 text-neutral-900 dark:text-neutral-100">
        Artikel dengan tag: #{{ $tag->name }}
    </h1>

    @if ($posts->count())
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article class="group space-y-3">
                    <div class="overflow-hidden rounded-lg">
                        <img src="{{ $post->cover_url }}" alt="{{ $post->title }}"
                            class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105 rounded-lg shadow">
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 dark:text-neutral-100 group-hover:underline">
                        <a href="{{ route('blog.read', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">
                        {{ $post->created_at->translatedFormat('d F Y') }}
                    </p>
                    <p class="text-neutral-700 dark:text-neutral-300">
                        {{ Str::limit(strip_tags($post->excerpt ?? $post->body), 100) }}
                    </p>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-neutral-600 dark:text-neutral-400">Belum ada artikel dengan tag ini.</p>
    @endif
</div>
