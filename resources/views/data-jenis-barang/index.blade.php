<x-layout>
    <x-slot:title>Data Jenis Barang</x-slot:title>
    

        <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
            <p class="text-gray-600">Data Jenis Barang</p>

            <!-- Tombol Tambah Data dengan Titik Tiga -->
            <x-dropdown type="create" route="data-jenis-barang"></x-dropdown-c>
        </div>

        <div class="md:p-6">
            <h1 class="text-2xl font-bold mb-4">Data Jenis Barang</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">

                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Barang</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Barang</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Sumber</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Spesifikasi</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($jenisBarangs as $jenis_barang)
                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $jenis_barang->jenis_barang }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $jenis_barang->id_kategori }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $jenis_barang->nama_barang }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $jenis_barang->sumber }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $jenis_barang->spesifikasi }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $jenis_barang->keterangan }}

                                </td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">
                                    <div class="flex items-center justify-end">
                                        <x-dropdown route="data-jenis-barang" :id="$jenis_barang->jenis_barang"></x-dropdown>  
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Data Jenis Barang belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

   

</x-layout>