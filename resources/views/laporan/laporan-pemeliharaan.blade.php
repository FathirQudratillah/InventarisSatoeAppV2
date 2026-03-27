<x-layout title="">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-8 space-y-6">

        {{-- HERO HEADER --}}
        <div class="rounded-2xl sm:rounded-3xl p-6 sm:p-8 text-white shadow-lg bg-gray-900">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">

                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold">Laporan Pemeliharaan</h1>

                    <p class="opacity-80 text-sm sm:text-base">
                        Periode
                        @php
                            $bulanRequest = request('bulan') ? (int) request('bulan') : (int) date('m');
                            $tahunRequest = request('tahun', date('Y'));
                        @endphp

                        {{ \Carbon\Carbon::create()->month($bulanRequest)->translatedFormat('F') }}
                        {{ $tahunRequest }}
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
                <p class="text-gray-400 text-sm">Total Pemeliharaan</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                    {{ $data->count() }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Barang Terpelihara</p>
                <h2 class="text-2xl sm:text-3xl font-bold text-blue-500">
                    {{ $data->groupBy('kode_barang')->count() }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Periode Ini</p>
                <h2 class="text-lg sm:text-2xl font-bold text-green-500">
                    {{ \Carbon\Carbon::create()->month($bulanRequest)->translatedFormat('F') }}
                    {{ $tahunRequest }}
                </h2>
            </div>

        </div>


        {{-- FILTER --}}
        <div class="bg-white p-5 rounded-2xl shadow">

            <form method="GET" action="{{ route('laporan.laporan-pemeliharaan') }}" id="filterForm"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Kode Barang --}}
                <div class="col-span-1">
                    <label class="text-sm text-gray-600 font-medium block mb-1">Kode Barang</label>

                    <select name="kode_barang" id="kode_barang" class="rounded-xl border-gray-300 w-full">

                        <option value="">Seluruh Barang</option>

                        @foreach ($barangList as $barang)
                            <option value="{{ $barang->kode_barang }}"
                                {{ request('kode_barang') == $barang->kode_barang ? 'selected' : '' }}>

                                {{ $barang->kode_barang }}

                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Bulan --}}
                <div>
                    <label class="text-sm text-gray-600 font-medium block mb-1">Bulan</label>

                    <select name="bulan" id="bulan" class="rounded-xl border-gray-300 w-full">

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
                            <option value="{{ $k }}" {{ request('bulan', date('m')) == $k ? 'selected' : '' }}>

                                {{ $v }}

                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Tahun --}}
                <div>
                    <label class="text-sm text-gray-600 font-medium block mb-1">Tahun</label>

                    <select name="tahun" id="tahun" class="rounded-xl border-gray-300 w-full">

                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('tahun', date('Y')) == $i ? 'selected' : '' }}>

                                {{ $i }}

                            </option>
                        @endfor

                    </select>
                </div>


                {{-- Button --}}
                <div class="flex items-end">
                    <button class="w-full bg-blue-600 text-white py-2 rounded-xl shadow hover:bg-blue-700 transition">

                        Filter

                    </button>
                </div>

            </form>


            {{-- BUTTON CETAK --}}
            <div class="mt-4 flex flex-col sm:flex-row gap-3">

                <button onclick="cetakPDF()"
                    class="w-full sm:w-auto inline-flex justify-center items-center bg-red-600 text-white px-6 py-2 rounded-xl shadow hover:bg-red-700 transition">

                    Cetak PDF

                </button>


                {{-- INFO --}}
                @if (request('kode_barang'))
                    <div class="flex items-center text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-xl">

                        <span>
                            Format:
                            <strong>Kartu Pemeliharaan {{ request('kode_barang') }}</strong>
                        </span>

                    </div>
                @else
                    <div class="flex items-center text-sm text-gray-600 bg-green-50 px-4 py-2 rounded-xl">

                        <span>
                            Format:
                            <strong>Laporan Rekap Seluruh Barang</strong>
                        </span>

                    </div>
                @endif

            </div>

        </div>



        {{-- TABLE --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow overflow-hidden">

            <div class="px-6 py-4 border-b">
                <h3 class="font-semibold text-gray-700">Daftar Pemeliharaan</h3>
            </div>

            @if ($data->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-6 py-3 text-left">No</th>
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-left">Kode</th>
                                <th class="px-6 py-3 text-left">Nama Barang</th>
                                <th class="px-6 py-3 text-left">Kegiatan</th>
                                <th class="px-6 py-3 text-left">Penanggung Jawab</th>
                                <th class="px-6 py-3 text-left">Keterangan</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach ($data as $i => $item)
                                <tr class="hover:bg-blue-50 transition">

                                    <td class="px-6 py-3">
                                        {{ $i + 1 }}
                                    </td>

                                    <td class="px-6 py-3 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pemeliharaan)->format('d M Y') }}
                                    </td>

                                    <td class="px-6 py-3 font-semibold">
                                        {{ $item->kode_barang }}
                                    </td>

                                    <td class="px-6 py-3">
                                        {{ $item->jenis->barang->nama_barang ?? '-' }}
                                    </td>

                                    <td class="px-6 py-3">
                                        {{ $item->kegiatan_pemeliharaan }}
                                    </td>

                                    <td class="px-6 py-3">
                                        {{ $item->penanggungjawab->nama ?? '-' }}
                                    </td>

                                    <td class="px-6 py-3 text-xs text-gray-600">
                                        {{ $item->keterangan ?? '-' }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            @else
                <div class="py-16 text-center text-gray-400">
                    Tidak ada data pemeliharaan
                </div>

            @endif

        </div>

    </div>


    {{-- JS CETAK --}}
    <script>
        function cetakPDF() {

            const kodeBarang = document.getElementById('kode_barang').value
            const bulan = document.getElementById('bulan').value
            const tahun = document.getElementById('tahun').value

            const url = new URL('{{ route('laporan.pemeliharaan.cetak') }}', window.location.origin)

            url.searchParams.append('kode_barang', kodeBarang)
            url.searchParams.append('bulan', bulan)
            url.searchParams.append('tahun', tahun)

            window.open(url.toString(), '_blank')

        }
    </script>

</x-layout>
