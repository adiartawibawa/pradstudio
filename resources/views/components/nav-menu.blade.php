@props(['menus' => $menus, 'responsive' => false])

@php
    // Fungsi recursive untuk cek apakah menu aktif
    $isActive = function ($menu) use (&$isActive) {
        if (!empty($menu['active']) && request()->routeIs($menu['active'])) {
            return true;
        }
        if (!empty($menu['children'])) {
            foreach ($menu['children'] as $child) {
                if (!empty($child['active']) && request()->routeIs($child['active'])) {
                    return true;
                }
                if ($isActive($child)) {
                    return true;
                }
            }
        }
        return false;
    };
@endphp

@if ($responsive)
    {{-- Responsive (mobile dengan collapse) --}}
    @foreach ($menus as $menu)
        @if (isset($menu['children']))
            <div x-data="{ open: {{ $isActive($menu) ? 'true' : 'false' }} }">
                {{-- Parent sebagai tombol toggle --}}
                <button @click="open = !open"
                    class="flex items-center justify-between w-full px-3 py-2 text-start font-medium transition
                        {{ $isActive($menu)
                            ? 'border-l-4 border-indigo-400 text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50'
                            : 'border-l-4 border-transparent text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200' }}">
                    <div>
                        <i class="{{ $menu['icon'] }} me-2 {{ $isActive($menu) ? 'text-indigo-500' : '' }}"></i>
                        {{ $menu['label'] }}
                    </div>
                    <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10
                                11.17l3.71-3.94a.75.75 0
                                111.08 1.04l-4.25 4.5a.75.75 0
                                01-1.08 0l-4.25-4.5a.75.75 0
                                01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                {{-- Children collapsible --}}
                <div x-show="open" x-collapse class="mt-1 space-y-1 ps-6">
                    @foreach ($menu['children'] as $child)
                        <x-responsive-nav-link :href="isset($child['route']) ? route($child['route']) : '#'" :active="$isActive($child)" wire:navigate>
                            <i class="{{ $child['icon'] }} me-2 {{ $isActive($child) ? 'text-indigo-500' : '' }}"></i>
                            {{ $child['label'] }}
                        </x-responsive-nav-link>
                    @endforeach
                </div>
            </div>
        @else
            {{-- Item biasa --}}
            <x-responsive-nav-link :href="isset($menu['route']) ? route($menu['route']) : '#'" :active="$isActive($menu)" wire:navigate>
                <i class="{{ $menu['icon'] }} me-2 {{ $isActive($menu) ? 'text-indigo-500' : '' }}"></i>
                {{ $menu['label'] }}
            </x-responsive-nav-link>
        @endif
    @endforeach
@else
    {{-- Desktop tetap pakai dropdown hover --}}
    @foreach ($menus as $menu)
        @if (isset($menu['children']))
            <div class="inline-flex items-center">
                <x-dropdown align="left" width="48">
                    {{-- Trigger Dropdown --}}
                    <x-slot name="trigger">
                        <button
                            class="h-16 inline-flex items-center px-3 py-2 text-sm font-medium leading-4
                       transition duration-150 ease-in-out border-b-2 focus:outline-none
                       {{ $isActive($menu)
                           ? 'border-indigo-400 text-gray-900 dark:text-gray-100'
                           : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700' }}">
                            <i class="{{ $menu['icon'] }} me-2 {{ $isActive($menu) ? 'text-indigo-500' : '' }}"></i>
                            {{ $menu['label'] }}
                            <svg class="w-4 h-4 ms-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10
                            10.586l3.293-3.293a1 1 0
                            111.414 1.414l-4 4a1 1 0
                            01-1.414 0l-4-4a1 1 0-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    {{-- Content Dropdown --}}
                    <x-slot name="content">
                        @foreach ($menu['children'] as $child)
                            <x-dropdown-link :href="isset($child['route']) ? route($child['route']) : '#'" :active="$isActive($child)" wire:navigate>
                                <i
                                    class="{{ $child['icon'] }} me-2 {{ $isActive($child) ? 'text-indigo-500' : '' }}"></i>
                                {{ $child['label'] }}
                            </x-dropdown-link>
                        @endforeach
                    </x-slot>
                </x-dropdown>
            </div>
        @else
            {{-- Item biasa --}}
            <x-nav-link :href="isset($menu['route']) ? route($menu['route']) : '#'" :active="$isActive($menu)" wire:navigate>
                <i class="{{ $menu['icon'] }} me-2 {{ $isActive($menu) ? 'text-indigo-500' : '' }}"></i>
                {{ $menu['label'] }}
            </x-nav-link>
        @endif
    @endforeach
@endif
