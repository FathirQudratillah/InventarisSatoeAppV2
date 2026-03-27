<x-layout type="dashboard" title="Laporan">

    <div class="space-y-8">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Laporan Transaksi</h1>
            <p class="text-gray-600 mt-2">
                Cetak rekap laporan transaksi inventaris per bulan
            </p>
        </div>

        {{-- Grid Card --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Peminjaman --}}
            <a href="{{ route('laporan.laporan-peminjaman') }}" class="group">
                <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-6 border-t-4 border-blue-600">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Peminjaman Barang</h3>
                    <p class="text-sm text-gray-700">Laporan data peminjaman barang inventaris</p>

                    <div class="mt-4 text-blue-600 font-medium group-hover:translate-x-2 transition">
                        Lihat Laporan →
                    </div>
                </div>
            </a>

           

            {{-- Pemeliharaan --}}
            <a href="{{ route('laporan.laporan-pemeliharaan') }}" class="group">
                <div class="bg-white rounded-xl shadow hover:shadow-xl transition p-6 border-t-4 border-red-500">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">Pemeliharaan Barang</h3>
                    <p class="text-sm text-gray-500">Laporan data pemeliharaan barang inventaris</p>

                    <div class="mt-4 text-red-500 font-medium group-hover:translate-x-2 transition">
                        Lihat Laporan →
                    </div>
                </div>
            </a>

        </div>

    </div>

</x-layout>
