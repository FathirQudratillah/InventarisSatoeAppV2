<x-layout>
    <x-slot:title>Data Siswa</x-slot:title>
        <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
            <p class="text-gray-600">Data Siswa</p>

            <!-- Tombol Tambah Data dengan Titik Tiga -->
            <x-dropdown type="create" route="data-siswa"></x-dropdown-c>
        </div>

        <div class="md:p-6">
            <h1 class="text-2xl font-bold mb-4">Data Siswa</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">

                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">User ID</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
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
                        @forelse ($siswas as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->nis }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->user_id }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->id_kelas }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->nama }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->email }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->jenis_kelamin }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->no_kontak }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $siswa->alamat }}</td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">
                                    <x-dropdown route="data-siswa" :id="$siswa->nis"></x-dropdown> 
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                    Data siswa belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    <!-- JavaScript Vanilla -->
    

</x-layout>