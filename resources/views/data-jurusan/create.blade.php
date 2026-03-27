<x-form action="{{ route('data-jurusan.store') }}">
    <x-slot:title>
        Data Jurusan
    </x-slot:title>
    <x-input name="id_jurusan" />
    <x-input name="jurusan" />
    <x-slot:button> <x-back-button href="{{ route('data-jurusan.index') }}"></x-back-button></x-slot:button>
        
</x-form>