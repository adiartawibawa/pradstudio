@props(['post', 'route'])

<div class="w-full h-[220px] bg-white shadow rounded-lg p-4 flex flex-col justify-between overflow-hidden">
    <div class="overflow-hidden">
        <h3 class="text-lg font-bold text-gray-800 mb-2 break-words">
            @unless ($post->published)
                <span class="text-slate-300">[ draft ]</span>
            @endunless

            {{ $post->title }}

            @if ($post->is_featured)
                <span> ✨</span>
            @endif
        </h3>
        <p class="text-sm text-gray-600 break-words line-clamp-3">
            {{ Str::limit(strip_tags($post->excerpt ?? $post->body), 80) }}
        </p>
    </div>
    <div class="mt-2 flex justify-between items-center">
        <span class="text-xs text-gray-500">
            {{ $post->created_at->diffForHumans() }}
        </span>
        <a href="{{ route($route, $post->slug) }}" class="text-blue-600 text-sm font-medium hover:underline">
            View →
        </a>
    </div>
</div>
