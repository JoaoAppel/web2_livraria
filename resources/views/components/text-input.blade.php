@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
        'w-full rounded-md border border-gray-300 bg-white text-gray-900 shadow-sm
         focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-offset-0'
    ]) !!}
>
