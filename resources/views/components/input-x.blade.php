@props(['nama', 'label', 'type' => 'text', 'disabled' => false, 'readonly'=> false])


<div class="relative mx-3">
    <input wire:model="{{ $nama }}" {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} type="{{ $type }}" id="{{ $nama }}" {!! $attributes->merge(['class' => 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 ' . ($errors->has($nama) ? 'border-red-600' : 'border-blue-800') . ' appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 peer disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-100 readonly:cursor-not-allowed'  ]) !!}>
    <label for="{{ $nama }}" class="absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] {{ $disabled ? 'bg-transparent' : 'bg-white' }} dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:{{ $errors->has($nama) ? 'text-red-600' : 'text-blue-800' }} peer-focus:dark:{{ $errors->has($nama) ? 'text-red-600' : 'text-blue-800' }} peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 disabled:text-gray-500">{{ $label }}</label>
</div>
