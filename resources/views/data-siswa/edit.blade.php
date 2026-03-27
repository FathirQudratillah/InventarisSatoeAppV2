<x-form action="{{ route('data-akun.update', $akun->user_id) }}">
    @method('PUT')
    <x-slot:title>
        Data akun
    </x-slot:title>
    <x-input name="username" :value="$akun->username"/>
    <x-slot:button> <x-back-button href="{{ route('data-akun.index') }}"></x-back-button></x-slot:button>
        
</x-form>