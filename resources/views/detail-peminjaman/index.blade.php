<x-layout>
    <x-slot:title>Detail Peminjaman</x-slot:title>
            <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
                <p class="text-gray-600">Detail Peminjaman</p>
            </div>
            <div class="md:p-6">

            <h1 class="text-2xl font-bold mb-4">Data Detail Peminjaman</h1>

            <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar" >
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <!-- Header -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Detail</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Barang</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Id Peminjaman</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi Sebelum</th>
                            <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kondisi Sesudah</th>
                        </tr>
                    </thead>

                    <!-- Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($detailPeminjamans as $detail_peminjaman)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $detail_peminjaman->id_detail }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $detail_peminjaman->kode_barang }}
                                </td>
                                
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $detail_peminjaman->id_peminjaman }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $detail_peminjaman->kondisi_sebelum }}
                                </td>
                                <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                    {{ $detail_peminjaman->kondisi_sesudah }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Data Detail Peminjaman belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
</x-layout>