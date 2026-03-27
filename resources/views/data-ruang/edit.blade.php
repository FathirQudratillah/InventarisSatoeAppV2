<x-form type="Edit" action="{{ route('data-ruang.update', $ruang->id_ruang) }}">
    @method('PUT')
    <x-slot:title>
        Data Ruang
    </x-slot:title>
    <x-input name="id_ruang" :value="$ruang->id_ruang"/>
    <x-input name="nama_ruang" :value="$ruang->nama_ruang"/>
    <x-input name="jenis_ruang" :value="$ruang->jenis_ruang"/>
    <x-input name="kapasitas" :value="$ruang->kapasitas"/>
    <x-input name="lokasi" :value="$ruang->lokasi"/>
    <x-slot:button> <x-back-button href="{{ route('data-ruang.index') }}"></x-back-button></x-slot:button>
        
</x-form>