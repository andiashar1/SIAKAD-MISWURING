@props(['nama', 'label', 'labelOption', 'options', 'optionValue', 'optionLabel', 'type' => 'text', 'disabled' => false, 'readonly' => false])

<div class="relative mx-3">
    <select 
        wire:model="{{ $nama }}" 
        {{ $disabled ? 'disabled' : '' }} 
        {{ $readonly ? 'readonly' : '' }} 
        id="{{ $nama }}" 
        {!! $attributes->merge([
            'class' => 'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 ' . 
            ($errors->has($nama) ? 'border-red-600' : 'border-blue-800') . 
            ' appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 peer disabled:cursor-not-allowed disabled:border-gray-100 disabled:bg-gray-100 disabled:text-base'
        ]) !!}
    >
        <option selected class="text-base" value="0" hidden>{{ $disabled ? $label : $labelOption }}</option>
        @foreach ($options as $option)
            @if (is_array($option))
                <option 
                    value="{{ $option[$optionValue] }}" 
                    @if(isset($option['disabled'])) disabled @endif 
                    @if(isset($option['hidden'])) hidden @endif 
                    @if(isset($option['selected'])) selected @endif
                >
                    {{ $option[$optionLabel] }}
                </option>
            @endif
        @endforeach
    </select>
    <label 
        @if($disabled) hidden @endif 
        for="{{ $nama }}" 
        class="absolute text-base text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] {{ $disabled ? 'bg-gray-100' : 'bg-white' }} dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:{{ $errors->has($nama) ? 'text-red-600' : 'text-blue-800' }} peer-focus:dark:{{ $errors->has($nama) ? 'text-red-600' : 'text-blue-800' }} peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1"
    >
        {{ $label }}
    </label>
</div>
