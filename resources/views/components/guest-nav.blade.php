@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" @class([
        'text-neutral-900 dark:text-neutral-100 font-semibold underline' => $active,
        'hover:underline hover:text-neutral-700 dark:hover:text-neutral-300' => !$active,
    ])>
        {{ $slot }}
    </a>
</li>
