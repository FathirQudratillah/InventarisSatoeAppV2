<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">

        {{-- HERO HEADER --}}
        <div class="rounded-3xl p-8 text-white shadow-lg bg-gray-900">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold">Laporan Pengajuan</h1>
                    <p class="opacity-80">Periode {{ $namaBulan }} {{ $tahun }}</p>
                </div>
                <a href="{{ route('laporan.index') }}"
                    class="bg-white/20 hover:bg-white/30 backdrop-blur px-5 py-2 rounded-xl">
                    Kembali
                </a>
            </div>
        </div>

        {{-- SUMMARY CARD --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Total Pengajuan</p>
                <h2 class="text-3xl font-bold text-gray-800">{{ $data->count() }}</h2>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Disetujui</p>
                <h2 class="text-3xl font-bold text-green-500">
                    {{ $data->where('status_pengajuan', 'Disetujui')->count() }}
                </h2>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <p class="text-gray-400 text-sm">Ditolak / Pending</p>
                <h2 class="text-3xl font-bold text-red-500">
                    {{ $data->where('status_pengajuan', '!=', 'Disetujui')->count() }}
                </h2>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="bg-white p-6 rounded-2xl shadow flex flex-col md:flex-row gap-4 items-end">
            <form method="GET" action="{{ route('laporan.laporan-pengajuan') }}"
                class="flex flex-col md:flex-row gap-4 w-full">

                <select name="bulan" class="rounded-xl border-gray-300">
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
                        {{-- FIX: bandingkan $bulan bukan $namaBulan --}}
                        <option value="{{ $k }}" {{ $bulan == $k ? 'selected' : '' }}>
                            {{ $v }}
                        </option>
                    @endforeach
                </select>

                <select name="tahun" class="rounded-xl border-gray-300">
                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}
                        </option>
                    @endfor
                </select>

                <button class="bg-green-600 text-white px-6 py-2 rounded-xl shadow hover:bg-green-700">
                    Filter
                </button>

                {{-- FIX: kirim $bulan (angka) bukan $namaBulan (string) --}}
                <a href="{{ route('laporan.pengajuan.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                    class="bg-red-600 text-white px-6 py-2 rounded-xl shadow hover:bg-red-700">
                    Cetak PDF
                </a>

            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-3xl shadow overflow-hidden">
            <div class="px-8 py-6 border-b">
                <h3 class="font-semibold text-gray-700">Daftar Pengajuan</h3>
            </div>

            @if ($data->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-8 py-4 text-left">No</th>
                                <th class="px-8 py-4 text-left">ID Pengajuan</th>
                                <th class="px-8 py-4 text-left">Tanggal</th>
                                <th class="px-8 py-4 text-left">Nama Barang</th>
                                <th class="px-8 py-4 text-left">User ID Pengaju</th>
                                <th class="px-8 py-4 text-left">Jumlah</th>
                                <th class="px-8 py-4 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($data as $i => $item)
                                <tr class="hover:bg-green-50 transition">
                                    <td class="px-8 py-4">{{ $i + 1 }}</td>
                                    <td class="px-8 py-4">{{ $item->id_pengajuan }}</td>
                                    <td class="px-8 py-4">
                                        {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d M Y') }}
                                    </td>
                                    <td class="px-8 py-4 font-semibold">{{ $item->nama_barang }}</td>
                                    <td class="px-8 py-4">{{ $item->user_id }}</td>
                                    <td class="px-8 py-4">{{ $item->jumlah_pengajuan }}</td>
                                    <td class="px-8 py-4">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $item->status_pengajuan == 'Disetujui' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->status_pengajuan ?? 'Pending' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="py-20 text-center text-gray-400">
                    Belum ada data pengajuan pada periode ini
                </div>
            @endif
        </div>

    </div>
</body>

</html>
