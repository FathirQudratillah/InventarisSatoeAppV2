<x-form action="{{ route('data-siswa.store')}}">
    <x-slot:title>
        Data Siswa
    </x-slot:title>
    
    
    <x-input name="tahun_perolehan" />
    <x-input name="keterangan" />
    <x-slot:button> <x-back-button href="{{ route('data-siswa.index') }}"></x-back-button></x-slot:button>
</x-form>