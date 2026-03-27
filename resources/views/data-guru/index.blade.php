<x-layout>
    <x-slot:title>Data Guru</x-slot:title>
        <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
            <p class="text-gray-600">Data Guru</p>

            <!-- Tombol Tambah Data dengan Titik Tiga -->
            <div class="relative inline-block text-left">
                <button
                    type="button"
                    onclick="toggleDropdown(this)"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-600 transition duration-200 focus:outline-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="5" r="2"/>
                        <circle cx="12" cy="12" r="2"/>
                        <circle cx="12" cy="19" r="2"/>
                    </svg>
                </button>

                <!-- Dropdown Tambah Data -->
                <div class="dropdown-menu hidden absolute right-0 z-50 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-xl">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Menu</p>
                    </div>
                    <ul class="py-1 text-sm">
                        <li>
                            <a href="{{ route('data-guru.create') }}"
                                class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition">
                                <span class="flex items-center justify-center w-7 h-7 rounded-md bg-indigo-100 text-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </span>
                                <div>
                                    <p class="font-medium text-sm">Tambah Data</p>
                                    <p class="text-xs text-gray-400">Tambah guru baru</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="md:p-6">
            <h1 class="text-2xl font-bold mb-4">Data Guru</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">

                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">NIP</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">User ID</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Kelamin</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">No Kontak</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($gurus as $guru)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->nip }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->user_id }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->nama }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->email }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->jenis_kelamin }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->no_kontak }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $guru->alamat }}</td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">
                                    <div class="relative inline-block text-left">

                                        <!-- Tombol Titik Tiga -->
                                        <button
                                            type="button"
                                            onclick="toggleDropdown(this)"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-600 transition duration-200 focus:outline-none"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <circle cx="12" cy="5" r="2"/>
                                                <circle cx="12" cy="12" r="2"/>
                                                <circle cx="12" cy="19" r="2"/>
                                            </svg>
                                        </button>

                                        <!-- Dropdown Pop Up -->
                                        <div class="dropdown-menu hidden absolute right-0 z-50 mt-2 w-48 bg-white border border-gray-200 rounded-xl shadow-xl">

                                            <div class="px-4 py-2 border-b border-gray-100">
                                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Pilih Aksi</p>
                                            </div>

                                            <ul class="py-1 text-sm">

                                                <!-- Edit -->
                                                <li>
                                                    <a href="{{ route('data-guru.edit', $guru->nip) }}"
                                                        class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                                        <span class="flex items-center justify-center w-7 h-7 rounded-md bg-blue-100 text-blue-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                            </svg>
                                                        </span>
                                                        <div>
                                                            <p class="font-medium text-sm">Edit</p>
                                                            <p class="text-xs text-gray-400">Ubah data guru</p>
                                                        </div>
                                                    </a>
                                                </li>

                                                <li class="border-t border-gray-100 mx-2"></li>

                                                <!-- Delete -->
                                                <li>
                                                    <form action="{{ route('data-guru.destroy', $guru->nip) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="flex items-center gap-3 w-full px-4 py-2.5 text-gray-700 hover:bg-red-50 hover:text-red-600 transition">
                                                            <span class="flex items-center justify-center w-7 h-7 rounded-md bg-red-100 text-red-500">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16"/>
                                                                </svg>
                                                            </span>
                                                            <div class="text-left">
                                                                <p class="font-medium text-sm">Delete</p>
                                                                <p class="text-xs text-gray-400">Hapus data guru</p>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Data Guru belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    <!-- JavaScript Vanilla -->
    

</x-layout>