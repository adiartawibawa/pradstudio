<li>
    @if ($responsive)
        <x-responsive-nav-link :href="isset($menu['route']) ? route($menu['route']) : '#'" :active="request()->routeIs($menu['active'] ?? [])">
            <i class="{{ $menu['icon'] ?? '' }} me-2 {{ $isActive($menu) ? 'text-indigo-500' : '' }}"></i>
            {{ $menu['label'] ?? '' }}
        </x-responsive-nav-link>
    @else
        <x-nav-link :href="isset($menu['route']) ? route($menu['route']) : '#'" :active="request()->routeIs($menu['active'] ?? [])">
            <i class="{{ $menu['icon'] ?? '' }} me-2 {{ $isActive($menu) ? 'text-indigo-500' : '' }}"></i>
            {{ $menu['label'] ?? '' }}
        </x-nav-link>
    @endif

    @if (!empty($menu['children']))
        <ul class="pl-4 space-y-1">
            @foreach ($menu['children'] as $child)
                <x-nav-menu-item :menu="$child" :responsive="$responsive" />
            @endforeach
        </ul>
    @endif
</li>
