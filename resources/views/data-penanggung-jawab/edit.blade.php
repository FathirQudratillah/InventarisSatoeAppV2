<x-form type="Edit" action="{{ route('data-penanggung-jawab.update', $penanggung_jawab->id_pj) }}">
    @method('PUT')
    <x-slot:title>
        Data Penanggung Jawab
    </x-slot:title>
    <x-input name="nama" :value="$penanggung_jawab->nama"/>
    <x-input name="nama_perusahaan" :value="$penanggung_jawab->nama_perusahaan"/>
    <x-input name="alamat_perusahaan" :value="$penanggung_jawab->alamat_perusahaan"/>
    <x-input name="no_kontak" :value="$penanggung_jawab->no_kontak"/>
    <x-slot:button> <x-back-button href="{{ route('data-penanggung-jawab.index') }}"></x-back-button></x-slot:button>
        
</x-form>