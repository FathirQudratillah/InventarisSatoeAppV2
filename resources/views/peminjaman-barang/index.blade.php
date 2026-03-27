<x-layout>
    <x-slot:title>Peminjaman Barang</x-slot:title>
            <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
                <p class="text-gray-600">Peminjaman Barang</p>
            </div>
            <div class="md:p-6">

            <h1 class="text-2xl font-bold mb-4">Peminjaman Barang</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Peminjaman</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">User Id</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Data Admin</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Peminjaman</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Peminjaman</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengembalian</th>                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($peminjamanBarangs as $peminjaman_barang)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $peminjaman_barang->id_peminjaman }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $peminjaman_barang->user_id }}
                                </td>
                                
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $peminjaman_barang->data_admin }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $peminjaman_barang->status_peminjaman }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $peminjaman_barang->tanggal_peminjaman }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $peminjaman_barang->tanggal_pengembalian }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Data Peminjaman Barang belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
</x-layout>