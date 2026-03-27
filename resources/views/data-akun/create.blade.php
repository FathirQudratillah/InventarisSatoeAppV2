<x-form action="{{ route('data-akun.store') }}">
    <x-slot:title>
        Data akun
    </x-slot:title>
    <x-input name="username" />
    <x-input-password></x-input-password>
    <x-select id="role" name="role">
        <option value="siswa">siswa</option>
        <option value="guru">guru</option>
    </x-select>
    <x-input name="nis" />
    <div id="siswaField" class="hidden">
        <x-select :datas="$id_kelas" name="id_kelas"></x-select>
    </div>
    <div id="siswaField">
        <x-input name="no_absen" />

    </div>

    <x-input name="nama" />
    <x-input name="email" />
    <x-select name="jenis_kelamin">
        <option value="Laki Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
    </x-select>
    <x-input name="no_kontak" />
    <x-input name="alamat" />
    <x-slot:button> <x-back-button href="{{ route('data-akun.index') }}"></x-back-button></x-slot:button>
        
</x-form>

