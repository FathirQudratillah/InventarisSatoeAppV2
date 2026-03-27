<x-form action="{{ route('data-penanggung-jawab.store') }}">
    <x-slot:title>Data Penanggung Jawab</x-slot:title>
    <x-input name="nama"/>
    <x-input name="nama_perusahaan"/>
    <x-input name="alamat_perusahaan"/>
    <x-input name="no_kontak"/>
    <x-slot:button><x-back-button href="{{ route('data-penanggung-jawab.index') }}"></x-back-button></x-slot:button>

</x-form>