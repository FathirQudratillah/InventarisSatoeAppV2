<x-layout>
    <x-slot:title>Data Kategori Barang</x-slot:title>
        <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
            <p class="text-gray-600">Data Kategori Barang</p>

            <!-- Tombol Tambah Data dengan Titik Tiga -->
            <x-dropdown type="create" route="data-kategori-barang"></x-dropdown-c>
        </div>

        <div class="md:p-6">
            <h1 class="text-2xl font-bold mb-4">Data Kategori Barang</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">

                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>

                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Kategori</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>

                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($kategoriBarangs as $kategori_barang)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $kategori_barang->id_kategori }}</td>
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">{{ $kategori_barang->kategori }}</td>

                                <!-- Kolom Aksi -->
                                <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">
                                    <div class="flex items-center justify-end">
                                        <x-dropdown route="data-kategori-barang" :id="$kategori_barang->id_kategori"></x-dropdown>  
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Data Kategori Barang belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    <!-- JavaScript Vanilla -->
    

</x-layout>