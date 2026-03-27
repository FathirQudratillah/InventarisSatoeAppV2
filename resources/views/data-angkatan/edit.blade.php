<x-form type="Edit" action="{{ route('data-angkatan.update', $angkatan->angkatan) }}">
    @method('PUT')
    <x-slot:title>
        Data Angkatan
    </x-slot:title>
    <x-input name="angkatan" :value="$angkatan->angkatan"/>
    <x-input name="tahun_masuk" :value="$angkatan->tahun_masuk"/>
    <x-input name="tahun_lulus" :value="$angkatan->tahun_lulus"/>
    <x-slot:button> <x-back-button href="{{ route('data-angkatan.index') }}"></x-back-button></x-slot:button>
        
</x-form>