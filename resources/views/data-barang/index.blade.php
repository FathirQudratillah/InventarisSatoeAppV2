<x-layout>
    <x-slot:title>Data Barang</x-slot:title>
    <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
        <p class="text-gray-600">Data Barang</p>

        <div class="flex items-center gap-2">
            <button class="bg-orange-100 hover:bg-orange-300 py-1 px-3 rounded-md ">
                <a href="{{ route('cetakQr') }}">Cetak Qr</a>
            </button>
            <!-- Tombol Tambah Data dengan Titik Tiga -->
            <x-dropdown type="create" route="data-barang"></x-dropdown>
        </div>
    </div>

    <div class="md:p-6">
        <h1 class="text-2xl font-bold mb-4">Data Barang</h1>

        <div class="bg-white shadow rounded-lg overflow-x-auto no-scrollbar">
            <table class="min-w-full divide-y divide-gray-200 ">

                <!-- Header -->
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode
                            Barang</th>
                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">Id
                            Ruang</th>
                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Jenis Barang</th>

                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Tahun Perolehan</th>
                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Kondisi Barang</th>
                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            Keterangan</th>
                        <th class="px-2 py-1 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase">
                        </th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($barangs as $barang)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                {{ $barang->kode_barang }}
                            </td>
                            <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                {{ $barang->id_ruang }}
                            </td>

                            <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                {{ $barang->jenis_barang }}
                            </td>

                            <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                {{ $barang->tahun_perolehan }}
                            </td>
                            <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                {{ $barang->kondisi_barang }}
                            </td>
                            <td class="px-4 py-1 md:px-6 md:py-2 text-sm text-gray-700">
                                {{ $barang->keterangan }}



                                <!-- Kolom Aksi -->
                            <td class="px-4 py-2 md:px-6 md:py-3 text-sm text-gray-700">
                                <div class="flex items-center justify-end">
                                    <div x-data="{ open: false }">

                                        <!-- Button -->
                                        <button @click="open = true" type="submit"
                                            class="flex items-center gap-3 w-full px-4 py-2.5 transition">
                                            <span
                                                class="flex items-center justify-center w-7 h-7 rounded-md bg-orange-100 hover:bg-orange-200 text-orange-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <rect x="2" y="2" width="8" height="8"></rect>
                                                        <path d="M6 6h.01"></path>
                                                        <rect x="14" y="2" width="8" height="8"></rect>
                                                        <path d="M18 6h.01"></path>
                                                        <rect x="2" y="14" width="8" height="8"></rect>
                                                        <path d="M6 18h.01"></path>
                                                        <path d="M14 14h.01"></path>
                                                        <path d="M18 18h.01"></path>
                                                        <path d="M18 22h4v-4"></path>
                                                        <path d="M14 18v4"></path>
                                                        <path d="M22 14h-4"></path>
                                                    </g>
                                                </svg>
                                            </span>

                                        </button>

                                        <!-- Overlay -->
                                        <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50 z-40"
                                            @click="open = false">
                                        </div>

                                        <!-- Modal -->
                                        <div x-cloak x-show="open" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center">

                                            <div @click.stop class="bg-white rounded-xl p-4 w-auto">
                                                <div class="flex justify-between items-center mb-2">
                                                    <h2 class="font-bold">Scan QR Barang</h2>
                                                    <button @click="open = false" type="button" id="closeScan"
                                                        class="text-red-500 text-xl">&times;</button>
                                                </div>
                                                    @php
                                                        $qr = QrCode::size(250)
                                                            ->backgroundColor(255, 255, 255)
                                                            ->color(0, 0, 0)
                                                            ->generate($barang->kode_barang);
                                                    @endphp
                                                    <div>
                                                        {!! $qr !!}
                                                    </div>

                                            </div>
                                        </div>
                                    </div>

                                    <x-dropdown route="data-barang" :id="$barang->kode_barang"></x-dropdown>


                                </div>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Data Barang belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript Vanilla -->


</x-layout>
