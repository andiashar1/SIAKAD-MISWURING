@props(['active'])

@php
$classes = ($active ?? false)
            ? ' mr-7 flex items-center p-2 font-normal text-gray-900 transition duration-75 rounded-lg bg-gray-200 hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700 pl-11'
            : ' mr-7 flex items-center p-2 font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
