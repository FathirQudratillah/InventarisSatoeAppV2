<x-layout title="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 space-y-6">

        {{-- HERO HEADER --}}
        <div class="rounded-2xl sm:rounded-3xl p-6 sm:p-8 text-white shadow-lg bg-gray-900">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold">Laporan Peminjaman</h1>
                    <p class="opacity-80 text-sm sm:text-base">
                        Periode {{ $namaBulan }} {{ $tahun }}
                    </p>
                </div>

                <a href="{{ route('laporan.index') }}"
                    class="w-full sm:w-auto text-center bg-white/20 hover:bg-white/30 backdrop-blur px-5 py-2 rounded-xl">
                    Kembali
                </a>
            </div>
        </div>


        {{-- SUMMARY CARD --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Total Transaksi</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    {{ $data->count() }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Dipinjam</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-yellow-500">
                    {{ $data->where('status_peminjaman', 'Dipinjam')->count() }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Selesai</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-green-500">
                    {{ $data->where('status_peminjaman', 'Dikembalikan')->count() }}
                </h2>
            </div>

        </div>


        {{-- FILTER --}}
        <div class="bg-white p-5 rounded-2xl shadow">

            <form method="GET" action="{{ route('laporan.laporan-peminjaman') }}"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <select name="bulan" class="rounded-xl border-gray-300 w-full">
                    @foreach ([
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ] as $k => $v)
                        <option value="{{ $k }}" {{ $bulan == $k ? 'selected' : '' }}>
                            {{ $v }}
                        </option>
                    @endforeach
                </select>

                <select name="tahun" class="rounded-xl border-gray-300 w-full">
                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>

                <button class="bg-blue-600 text-white py-2 rounded-xl shadow hover:bg-blue-700 w-full">
                    Filter
                </button>

                <a href="{{ route('laporan.peminjaman.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                    class="bg-red-600 text-white py-2 rounded-xl shadow hover:bg-red-700 text-center w-full">
                    Cetak PDF
                </a>

            </form>

        </div>


        {{-- TABLE --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow overflow-hidden">

            <div class="px-6 py-4 border-b">
                <h3 class="font-semibold text-gray-700">Daftar Peminjaman</h3>
            </div>

            @if ($data->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-6 py-3 text-left">No</th>
                                <th class="px-6 py-3 text-left">ID</th>
                                <th class="px-6 py-3 text-left">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-left">Barang</th>
                                <th class="px-6 py-3 text-left">User</th>
                                <th class="px-6 py-3 text-left">Tgl Kembali</th>
                                <th class="px-6 py-3 text-left">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($data as $i => $item)
                                <tr class="hover:bg-blue-50 transition">

                                    <td class="px-6 py-3">
                                        {{ $i + 1 }}
                                    </td>

                                    <td class="px-6 py-3">
                                        {{ $item->id_peminjaman }}
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-3">
                                        @forelse ($item->detail as $detail)
                                            {{ $detail->barang->dataBarang->nama_barang ?? $detail->kode_barang }}
                                            <br>

                                        @empty
                                            -
                                        @endforelse
                                    </td>

                                    <td class="px-6 py-3">
                                        {{ $item->user_id }}
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $item->status_peminjaman == 'Dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">

                                            {{ $item->status_peminjaman }}

                                        </span>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            @else
                <div class="py-16 text-center text-gray-400">
                    Tidak ada data
                </div>

            @endif

        </div>

    </div>
</x-layout>
