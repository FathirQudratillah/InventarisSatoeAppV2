<x-form type="Ubah" action="{{ route('ubah-password') }}">
    @method('PUT')
    <x-slot:title>
        Password
    </x-slot:title>
    <x-input-password name="current_password">Password</x-input-password>
    <x-input-password name="password">Password Baru</x-input-password>
    <x-input-password name="password_confirmation">Konfirmasi Password</x-input-password>
    <x-slot:button> <x-back-button href="{{route('detail') }}"></x-back-button></x-slot:button>
        
</x-form>