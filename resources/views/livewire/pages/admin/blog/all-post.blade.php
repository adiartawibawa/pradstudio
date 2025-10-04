<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Search -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8">
            <div class="w-full sm:w-1/3">
                <input type="text" wire:model.live.debounce.500ms="search" placeholder="Cari artikel..."
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm
                           focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-500
                           focus:border-blue-400 dark:focus:border-blue-500
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                           transition">
            </div>
        </div>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-full">
            <!-- Button Buat Artikel -->
            <a href="{{ route('admin.blog.create') }}"
                class="w-full h-[220px] flex items-center justify-center
                       border-2 border-dashed border-slate-300 dark:border-slate-600
                       rounded-xl text-center
                       hover:border-blue-500 hover:bg-blue-50 dark:hover:border-blue-400 dark:hover:bg-gray-800
                       transition">
                <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                    + Buat Artikel Baru
                </span>
            </a>

            <!-- List Artikel -->
            @forelse ($posts as $post)
                <x-blogs.post-card :post="$post" route="admin.blog.edit" />
            @empty
                <div
                    class="w-full h-[220px] flex flex-col items-center justify-center
                           border border-gray-300 dark:border-gray-700
                           rounded-lg shadow
                           bg-white dark:bg-gray-800
                           text-gray-500 dark:text-gray-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 dark:text-gray-600 mb-2"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v14a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-sm">Belum ada artikel</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="py-6 text-gray-700 dark:text-gray-300">
            {{ $posts->links() }}
        </div>
    </div>
</div>
