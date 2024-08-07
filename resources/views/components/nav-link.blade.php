@props(['active'])

@php
$classes = ($active ?? false)
            ? 'mr-5 px-4 py-3 flex items-center space-x-4 rounded-xl text-white bg-gradient-to-r from-sky-600 to-cyan-400'
            : 'mr-5 px-4 py-3 flex items-center space-x-4 rounded-xl text-gray-600 group hover:bg-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
