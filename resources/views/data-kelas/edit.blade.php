<x-form type="Edit" action="{{ route('data-kelas.update', $kelas->id_kelas) }}">
    @method('PUT')
    <x-slot:title>
        Data Kelas
    </x-slot:title>
    
    
    <x-select name="kelas" col="col-span-2">
        <option value="10" {{ $kelas->kelas == '10' ? 'selected' : '' }} >10</option>
        <option value="11" {{ $kelas->kelas == '11' ? 'selected' : '' }}>11</option>
        <option value="12" {{ $kelas->kelas == '12' ? 'selected' : '' }}>12</option>
        <option value="Alumni" {{ $kelas->kelas == 'Alumni' ? 'selected' : '' }}>Alumni</option>
    </x-select>
   
    <x-slot:button> <x-back-button href="{{ route('data-kelas.index') }}"></x-back-button></x-slot:button>
        
</x-form>