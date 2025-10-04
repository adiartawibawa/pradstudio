<x-guest-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <section class="pb-16">
            <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">

                <div class="mb-8">
                    <a href="{{ route('project.all') }}"
                        class="text-sm text-neutral-500 dark:text-neutral-400 hover:text-neutral-800 dark:hover:text-neutral-200 transition">
                        ← Back to Projects
                    </a>
                </div>

                <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-md overflow-hidden">
                    <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-72 sm:h-96 object-cover">

                    <div class="p-6 sm:p-10">
                        <h1 class="text-3xl sm:text-4xl font-bold text-neutral-900 dark:text-neutral-100 mb-4">
                            {{ $project->title }}
                        </h1>

                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach ($project->tags as $tag)
                                <span
                                    class="px-3 py-1 text-xs bg-neutral-100 dark:bg-neutral-700 text-neutral-600 dark:text-neutral-300 rounded-full">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>

                        <p class="text-neutral-700 dark:text-neutral-300 text-base leading-relaxed mb-8">
                            {{ $project->description }}
                        </p>

                        @if ($project->content)
                            <article class="prose dark:prose-invert max-w-none">
                                {!! $project->content !!}
                            </article>
                        @endif

                        <div class="mt-10">
                            @if ($project->url)
                                <a href="{{ $project->url }}" target="_blank" rel="noopener"
                                    class="inline-flex items-center px-5 py-2 bg-neutral-900 text-white text-sm rounded-full hover:bg-neutral-700 transition">
                                    View Live Project
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
