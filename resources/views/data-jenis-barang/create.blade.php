<x-form action="{{ route('data-jenis-barang.store')}}">
    <x-slot:title>
        Data Jenis Barang
    </x-slot:title>
    <x-input name="jenis_barang" field="Kode Jenis Barang ( 3 Huruf )" />
    <x-select :datas="$id_kategori" name="id_kategori"></x-select>
    <x-input name="nama_barang" />
    <x-input name="sumber" />
    <x-input name="spesifikasi" />
    <x-input name="keterangan" />
    <x-slot:button> <x-back-button href="{{ route('data-jenis-barang.index') }}"></x-back-button></x-slot:button>
</x-form>