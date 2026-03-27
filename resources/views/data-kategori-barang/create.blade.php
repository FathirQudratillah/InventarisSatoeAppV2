<x-form action="{{ route('data-kategori-barang.store') }}">
    <x-slot:title>
        Data Kategori Barang
    </x-slot:title>
    <x-input name="id_kategori" />
    <x-input name="kategori" />
    <x-slot:button> <x-back-button href="{{ route('data-kategori-barang.index') }}"></x-back-button></x-slot:button>
        
</x-form>