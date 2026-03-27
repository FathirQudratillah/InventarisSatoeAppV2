<x-form action="{{ route('data-ruang.store') }}">
    <x-slot:title>
        Data Ruang
    </x-slot:title>
    <x-input name="id_ruang" />
    <x-input name="nama_ruang" />
    <x-select name="jenis_ruang">
        <option value="Ruang Kelas" {{ old('jenis_ruang') == 'Ruang Kelas' ? 'selected' : '' }}>Ruang Kelas</option>
        <option value="Ruang Praktek" {{ old('jenis_ruang') == 'Ruang Praktek' ? 'selected' : '' }}>Ruang Praktek
        </option>
    </x-select>
    <x-input name="kapasitas" />
    @php
        $lokasiList = ['Gedung A', 'Gedung B', 'Gedung C', 'Gedung D', 'Gedung E', 'Gedung F'];
    @endphp

    <x-select name="lokasi">

        @foreach ($lokasiList as $lokasi)
            <option value="{{ $lokasi }}" {{ old('lokasi') == $lokasi ? 'selected' : '' }}>
                {{ $lokasi }}
            </option>
        @endforeach
    </x-select>

    <x-slot:button> <x-back-button href="{{ route('data-ruang.index') }}"></x-back-button></x-slot:button>

</x-form>
