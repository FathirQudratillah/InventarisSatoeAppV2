<x-form type="Edit" action="{{ route('data-jurusan.update', $jurusan->id_jurusan) }}">
    @method('PUT')
    <x-slot:title>
        Data Jurusan
    </x-slot:title>
    <x-input name="id_jurusan" :value="$jurusan->id_jurusan"/>
    <x-input name="jurusan" :value="$jurusan->jurusan"/>
    <x-slot:button> <x-back-button href="{{ route('data-jurusan.index') }}"></x-back-button></x-slot:button>
        
</x-form>