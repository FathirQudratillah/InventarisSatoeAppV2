<x-form type="Edit" action="{{ route('data-kategori-barang.update', $kategori_barang->id_kategori) }}">
    @method('PUT')
    <x-slot:title>
        Data Kategori Barang
    </x-slot:title>
    <x-input name="id_kategori" :value="$kategori_barang->id_kategori"/>
    <x-input name="kategori" :value="$kategori_barang->kategori"/>
    <x-slot:button> <x-back-button href="{{ route('data-kategori-barang.index') }}"></x-back-button></x-slot:button>
        
</x-form>