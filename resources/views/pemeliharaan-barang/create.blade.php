<x-form action="{{ route('pemeliharaan-barang.store')}}">
    <x-slot:title>
        Pemeliharaan Barang
    </x-slot:title>

    <x-select :datas="$id_pj" output="nama" name="id_pj" field="Pelaksana"></x-select>
    <x-select :datas="$kode_barang" name="kode_barang"></x-select>
    @php
        $pemeliharaanList = ['Perbaikan', 'Pembersihan', 'Penggantian Sparepart'];
    @endphp

    <x-select name="kegiatan_pemeliharaan">

        @foreach ($pemeliharaanList as $pemeliharaan)
            <option value="{{ $pemeliharaan }}" {{ old('kegiatan_pemeliharaan') == $pemeliharaan ? 'selected' : '' }}>
                {{ $pemeliharaan }}
            </option>
        @endforeach
    </x-select> 
    
    <x-input name="tanggal_pemeliharaan" type="date" :value="date('Y-m-d')" />
    <x-input name="keterangan" />
    <x-slot:button> <x-back-button href="{{ route('data-barang.index') }}"></x-back-button></x-slot:button>
</x-form>