@php
    $projects = [
        [
            'title' => 'Portfolio Website',
            'slug' => 'portfolio-website',
            'category' => 'Frontend Development',
            'description' =>
                'Personal website built with Laravel, Livewire, and Tailwind CSS showcasing work and articles.',
            'tags' => ['Laravel', 'Tailwind', 'Livewire'],
            'image' =>
                'https://images.unsplash.com/photo-1588511986632-592db3d6c81f?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'url' => 'https://your-portfolio-link.com',
        ],
        [
            'title' => 'E-Commerce Dashboard',
            'slug' => 'portfolio-website',
            'category' => 'Fullstack',
            'description' =>
                'An admin dashboard for managing orders, users, and analytics with Filament and Alpine.js.',
            'tags' => ['Laravel', 'Filament', 'Alpine.js'],
            'image' => 'https://images.unsplash.com/photo-1556155092-8707de31f9c4?auto=format&fit=crop&q=80&w=800',
            'url' => '#',
        ],
        [
            'title' => 'AI Blog Generator',
            'slug' => 'portfolio-website',
            'category' => 'Machine Learning',
            'description' => 'A blog writing tool powered by GPT-5 API with custom prompts and style control.',
            'tags' => ['AI', 'OpenAI API', 'Vue.js'],
            'image' => 'https://images.unsplash.com/photo-1581090700227-1e37b190418e?auto=format&fit=crop&q=80&w=800',
            'url' => '#',
        ],
    ];
@endphp

<x-guest-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <section id="projects" class="pb-16">
            <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-neutral-800 dark:text-neutral-100">
                        Explore Projects
                    </h2>
                    <p class="text-neutral-500 dark:text-neutral-400 mt-2">
                        A selection of our latest work in web development and design.
                    </p>
                </div>

                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <div
                            class="group relative bg-white dark:bg-neutral-800 rounded-xl shadow-md hover:shadow-xl overflow-hidden transition">
                            <a href="{{ route('project.show', $project['slug']) }}" target="_blank" rel="noopener"
                                class="block relative overflow-hidden">
                                <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                                    class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div class="absolute bottom-0 left-0 p-4 text-white">
                                    <h3 class="text-lg sm:text-xl font-semibold">{{ $project['title'] }}</h3>
                                    <p class="text-sm text-gray-200">{{ $project['category'] }}</p>
                                </div>
                            </a>

                            <div class="p-5">
                                <p class="text-neutral-600 dark:text-neutral-300 text-sm mb-4 line-clamp-3">
                                    {{ $project['description'] }}
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($project['tags'] as $tag)
                                        <span
                                            class="px-3 py-1 text-xs bg-neutral-100 dark:bg-neutral-700 text-neutral-600 dark:text-neutral-300 rounded-full">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


    </div>
</x-guest-layout>
