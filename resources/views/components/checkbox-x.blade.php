@props(['nama', 'label', 'type' => 'checkbox','checked'=> true, 'disabled' => false])

<div class="flex items-center ml-3">
    <input @click="isDisabledHP" wire:click="{{toggleDisabledHP}}" {{ $disabled ? 'disabled' : '' }} {{ $checked ? 'checked' : '' }} type="{{ $type }}" id="{{ $nama }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    <label for="{{$nama}}" class="ms-2 text-sm font-medium text-black  dark:text-gray-500 disabled:text-gray-500">{{$label}}</label>
</div>