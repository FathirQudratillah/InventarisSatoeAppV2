@props(['name', 'value' => null, 'col' => null, 'field' => null, 'type' => null])

@php
    $label = ucwords(str_replace('_', ' ', $field ?? $name));
@endphp

<div class="{{ $col ?? '' }}">
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        {{ $label }}
    </label>

    <input type="{{ $type }}"
           name="{{ $name }}"
           value="{{ old($name,$value) }}"
           placeholder="Masukkan {{ $label }}"
           class="w-full px-4 py-3 border  rounded-xl 
                  focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                  transition duration-200 outline-none 
                  {{$errors->has($name) 
                ? 'border-red-500 focus:ring-red-500' 
                : 'border-gray-300 focus:border-indigo-500'}}"
           required>

    @error($name)
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>