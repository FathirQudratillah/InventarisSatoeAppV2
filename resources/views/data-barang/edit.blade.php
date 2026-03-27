
<x-form type="Edit" action="{{ route('data-barang.update', $barang->kode_barang) }}">
    @method('PUT')
    <x-slot:title>
        Data Barang
    </x-slot:title>
    <x-select :datas="$id_ruang" :value="$barang->id_ruang" name="id_ruang"></x-select>
    

    <x-select name="kondisi_barang">
        <option value="Baik" {{ $barang->kondisi_barang == 'Baik' ? 'selected' : '' }} >Baik</option>
        <option value="Rusak" {{ $barang->kondisi_barang == 'Rusak' ? 'selected' : '' }}>Rusak</option>
        <option value="Perbaikan" {{ $barang->kondisi_barang == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
        
    </x-select>
    <x-input name="tahun_perolehan" :value="$barang->tahun_perolehan"/>
    <x-input name="keterangan" :value="$barang->keterangan"/>
    <x-slot:button> <x-back-button href="{{ route('data-barang.index') }}"></x-back-button></x-slot:button>
        
</x-form>