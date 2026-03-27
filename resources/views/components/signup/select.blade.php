@props(['name', 'datas' => null, 'class' => null, 'field' => null])

<div class="{{ $class }}">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-300 mb-1.5">{{ ucfirst(str_replace('_', ' ', $field ?? $name)) }}</label>
    <select id="{{ $name }}" name="{{ $name }}" 
        class="w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 {{ $errors->has($name) ? 'border-red-500' : '' }}">
        <option value="" disabled {{ old($name) ? '' : 'selected' }}>Pilih</option>
        @if ($datas)
            @foreach ($datas as $data)
            <option value="{{ $data->$name }}">{{ $data->$field ?? $data->$name }}</option>
            @endforeach
        @else
        {{ $slot }}
            
        @endif
    </select>
    @error($name)
        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
    @enderror
</div>
