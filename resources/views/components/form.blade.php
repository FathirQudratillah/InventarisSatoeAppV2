@props(['type' => 'Tambah'])

<x-layout>
    <x-slot:title>{{ $type }} {{ $title }}</x-slot:title>

    <div class="max-w-3xl mx-auto mt-8">
        <div class="bg-white shadow-xl rounded-2xl p-8">

            <!-- Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $type }} {{ $title }}
                </h1>
                <p class="text-gray-500 mt-1">
                    Silakan isi informasi {{ $title }} dengan lengkap dan benar.
                </p>
            </div>

            <form {{ $attributes->merge(['method' => 'POST', 'class' => 'space-y-6']) }}>
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    {{ $slot }}
                </div>

                <!-- Button Section -->
                {{ $button }}

            </form>

        </div>
    </div>

</x-layout>
