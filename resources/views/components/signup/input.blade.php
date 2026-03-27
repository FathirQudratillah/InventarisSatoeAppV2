<div class="{{ $class ?? '' }}">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-300 mb-1.5">{{ ucfirst(str_replace('_', ' ', $name)) }}</label>
    <input type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name) }}"
        placeholder="Masukkan {{ $name }}" maxlength="{{ $max }}" 
        class="w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 {{ $errors->has( $name) ? 'border-red-500' : '' }}">
    @error($name)
        <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
    @enderror
</div>

