@props(['active'])

@php
$stylees = ($active ?? false)
            ? 'display: block;'
            : 'display: none;';
@endphp

<div {{ $attributes->merge(['style' => $stylees, ]) }}>
    {{ $slot }}
</div>
