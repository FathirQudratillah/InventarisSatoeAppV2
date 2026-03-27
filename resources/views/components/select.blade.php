@props(['name', 'datas' => null, 'value' => null, 'id' => null, 'field' => null, 'output' => null, 'col' => null])

@php
    $label = ucwords(str_replace('_', ' ', $field ?? $name));
@endphp

<div class="{{ $col ?? '' }}">
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        {{ $label }}
    </label>

    <select id="{{ $id }}" class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                  focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                  transition duration-200 outline-none" name="{{ $name }}" id="{{ $name }}" required>
    <option value="">--Pilih--</option>

    @if ($datas)
        @foreach ($datas as $data)
            <option 
                value="{{ $data->$name }}"
                {{ old($name, $value) == $data->$name ? 'selected' : '' }}
            >
                {{ $data->$output ?? $data->$name }}
            </option>
        @endforeach
    @else
        {{ $slot }}
    @endif



        

    </select>

    @error($name)
        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div> 