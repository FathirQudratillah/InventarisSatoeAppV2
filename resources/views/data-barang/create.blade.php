
<x-form action="{{ route('data-barang.store') }}">
    <x-slot:title>
        Data Barang
    </x-slot:title>
    <x-select :datas="$jenis_barang" name="jenis_barang"></x-select>
    <x-select :datas="$id_ruang" name="id_ruang"></x-select>
    @php
        $kondisiList = ['Baik', 'Rusak', 'Perbaikan'];
    @endphp

    <x-select name="kondisi_barang">
        

        @foreach ($kondisiList as $kondisi)
            <option value="{{ $kondisi }}" {{ old('kondisi_barang') == $kondisi ? 'selected' : '' }}>
                {{ $kondisi }}
            </option>
        @endforeach
    </x-select>

    <x-input name="tahun_perolehan" />
    <x-input name="keterangan" />
    <x-slot:button> <x-back-button href="{{ route('data-barang.index') }}"></x-back-button></x-slot:button>
</x-form>
