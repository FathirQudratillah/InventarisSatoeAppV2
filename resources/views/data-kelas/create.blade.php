<x-form action="{{ route('data-kelas.store') }}">
    <x-slot:title>
        Data Kelas
    </x-slot:title>
    <x-select :datas="$id_jurusan" name="id_jurusan"></x-select>
    <x-select :datas="$angkatan" name="angkatan"></x-select>
    <x-select name="kelas">
        <option value="10" {{ old('kelas') == '10' ? 'selected' : '' }}>10</option>
        <option value="11" {{ old('kelas') == '11' ? 'selected' : '' }}>11</option>
        <option value="12" {{ old('kelas') == '12' ? 'selected' : '' }}>12</option>
        <option value="Alumni" {{ old('kelas') == 'Alumni' ? 'selected' : '' }}>Alumni</option>
    </x-select>
    <x-select name="subkelas">
        <option value="A" {{ old('subkelas') == 'A' ? 'selected' : '' }}>A</option>
        <option value="B" {{ old('subkelas') == 'B' ? 'selected' : '' }}>B</option>
    </x-select>

    <x-slot:button> <x-back-button href="{{ route('data-kelas.index') }}"></x-back-button></x-slot:button>
</x-form>
