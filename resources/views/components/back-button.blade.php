<!-- Button Section -->
<div class="flex justify-between items-center pt-6 border-t">
    <a {{ $attributes->merge(['class' => 'px-6 py-3 rounded-xl bg-gray-200 text-gray-700 
                hover:bg-gray-300 transition duration-200'])}}
                >
        Batal
    </a>

    <button type="submit"
            class="px-8 py-3 rounded-xl bg-indigo-600 text-white 
                    font-semibold shadow-md 
                    hover:bg-indigo-700 hover:shadow-lg 
                    transition duration-200">
        Simpan
    </button>
</div>