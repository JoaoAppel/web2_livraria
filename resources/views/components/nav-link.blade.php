@props(['active' => false])

@php
    if ($active) {
        // Estilo quando a aba está ATIVA
        $classes = 'inline-flex items-center px-4 pt-1 pb-2 text-sm font-semibold leading-5
                    text-indigo-700 border-b-4 border-indigo-600 bg-indigo-50 rounded-t-md';
    } else {
        // Estilo quando a aba está INATIVA
        $classes = 'inline-flex items-center px-4 pt-1 pb-2 text-sm font-medium leading-5
                    text-gray-500 border-b-2 border-transparent hover:text-gray-700
                    hover:border-gray-300';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
