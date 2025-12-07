@props(['active' => false])

@php
    if ($active) {
        $classes = 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-600
                    text-base font-semibold text-indigo-700 bg-indigo-50';
    } else {
        $classes = 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent
                    text-base font-medium text-gray-600 hover:bg-gray-50
                    hover:border-gray-300';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
