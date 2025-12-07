@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($name, $value) }}"
           {{ $attributes->merge(['class' => 'mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500']) }}
           @error($name) aria-invalid="true" @enderror>
    <x-form.error :field="$name" />
</div>
