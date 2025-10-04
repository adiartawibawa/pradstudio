<div>
    <!-- Article Section -->
    <section class="py-12">
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts as $post)
                <article
                    class="group bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 rounded-lg overflow-hidden hover:border-neutral-300 dark:hover:border-neutral-700 transition">
                    <img src="{{ $post->cover_url ?? 'https://picsum.photos/400/240' }}" alt="{{ $post->title }}"
                        class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105" />

                    <div class="p-4 space-y-2">
                        <h3 class="text-lg font-semibold leading-snug">
                            <a href="{{ route('blog.read', $post->slug) }}"
                                class="text-neutral-900 dark:text-neutral-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400">
                            {{ $post->created_at->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-sm text-neutral-700 dark:text-neutral-300 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->body), 200) }}
                        </p>
                        <a href="{{ route('blog.read', $post->slug) }}"
                            class="inline-flex items-center text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                            Read article
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- Pagination -->
    <section class="py-8">
        {{ $posts->links() }}
    </section>
</div>
