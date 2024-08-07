@props(['nama', 'label', 'type' => 'text', 'disabled' => false])


<div class="relative max-w-sm mx-3">
    <div class="flex items-center">
        <input wire:model="{{ $nama }}" @if($disabled) type="text" @else type="{{ $type }}" @endif {{ $disabled ? 'disabled' : '' }} id="{{ $nama }}" {!! $attributes->merge([
                'class' => 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 ' . ($errors->has($nama) ? 'border-red-600' : 'border-blue-800') . ' appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 peer disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-100 '
            ]) !!}>
            <label for="{{ $nama }}" class="absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] {{ $disabled ? 'bg-gray-100' : 'bg-white' }} dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:{{ $errors->has($nama) ? 'text-red-600' : '' }} peer-focus:dark:{{ $errors->has($nama) ? 'text-red-600' : 'text-blue-800' }} peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 ">{{ $label }}</label>
        <div class="justify-self-end flex items-center pointer-events-none absolute inset-y-0 end-0 px-3">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
            </svg>
        </div>
    </div>
</div>

