<x-form action="{{ route('data-angkatan.store') }}">
    <x-slot:title>
        Data angkatan
    </x-slot:title>
    <x-input name="angkatan" />
    <x-input name="tahun_masuk" />
    <x-input name="tahun_lulus" />
    <x-slot:button> <x-back-button href="{{ route('data-angkatan.index') }}"></x-back-button></x-slot:button>
        
</x-form>