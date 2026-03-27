<x-layout>
    <x-slot:title>Data Penanggung Jawab</x-slot:title>
        <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
            <p class="text-gray-600">Data Penanggung Jawab</p>

            <!-- Tombol Tambah Data dengan Titik Tiga -->
            <x-dropdown type="create" route="data-penanggung-jawab"></x-dropdown-c>
        </div>

        <div class="md:p-6">
            <h1 class="text-2xl font-bold mb-4">Data Penanggung Jawab</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">

                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Pj</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Perusahaan</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat Perusahaan</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">No Kontak</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($penanggungJawabs as $penanggung_jawab)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $penanggung_jawab->id_pj }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $penanggung_jawab->nama }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $penanggung_jawab->nama_perusahaan }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $penanggung_jawab->alamat_perusahaan }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $penanggung_jawab->no_kontak }}</td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">
                                    <div class="flex items-center justify-end">
                                        <x-dropdown route="data-penanggung-jawab" :id="$penanggung_jawab->id_pj"></x-dropdown> 
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Data Penanggung Jawab belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    
    

</x-layout>