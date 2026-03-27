<x-layout>
    <x-slot:title>Dashboard Guru</x-slot:title>

    {{-- Greeting Logic --}}
    @php
        $jakartaTime = \Carbon\Carbon::now('Asia/Jakarta');
        $hour = $jakartaTime->format('H');

        if ($hour < 11) {
            $greeting = 'Selamat Pagi';
        } elseif ($hour < 15) {
            $greeting = 'Selamat Siang';
        } elseif ($hour < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }
    @endphp

    {{-- Welcome Toast --}}
    <div id="welcomeToast"
        class="fixed top-6 right-6 bg-slate-100 border border-slate-300 shadow-xl rounded-2xl p-5 w-80 z-50 transform translate-x-96 opacity-0 transition-all duration-500">
        <div class="flex items-start gap-3">
            <div class="flex-1">
                <p class="text-sm font-semibold text-slate-800">
                    {{ $greeting }}, {{ auth()->user()->username }}!
                </p>
                <p class="text-xs text-slate-400 mt-1">
                    Semoga harimu produktif dan menyenangkan
                </p>
            </div>
            <button onclick="closeToast()" class="text-slate-400 hover:text-slate-600 text-sm">✕</button>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const toast = document.getElementById('welcomeToast');
            setTimeout(() => {
                toast.classList.remove('translate-x-96', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 400);
            setTimeout(() => closeToast(), 5000);
        });

        function closeToast() {
            const toast = document.getElementById('welcomeToast');
            toast.classList.add('translate-x-96', 'opacity-0');
        }
    </script>

    {{-- 1.a PROFILE --}}
    <div class="mb-8 bg-gradient-to-r from-indigo-600 to-indigo-500 p-6 rounded-2xl shadow-md text-white">
        <div class="flex items-center gap-5">
            <div
                class="w-16 h-16 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0 ring-4 ring-white/30">
                <span class="text-white text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-indigo-200 uppercase tracking-widest">
                    {{ $jakartaTime->translatedFormat('l, d F Y') }}
                </p>
                <h1 class="text-2xl md:text-3xl font-bold mt-1">
                    {{ $greeting }}, <span class="text-yellow-300">{{ auth()->user()->username }}</span>
                </h1>
                <div class="flex flex-wrap items-center gap-2 mt-2">
                    <span class="text-xs bg-white/20 text-white font-semibold px-2.5 py-0.5 rounded-full">
                        {{ ucfirst(auth()->user()->role ?? 'Guru') }}
                    </span>
                    <span class="text-xs text-indigo-200">{{ auth()->user()->user_id }}</span>
                    <span class="text-xs text-indigo-200">{{ auth()->user()->email }}</span>
                </div>
                <p class="text-xs text-indigo-200 mt-1">
                    Sekarang pukul {{ $jakartaTime->format('H:i') }} WIB — Kelola peminjaman barang kamu hari ini.
                </p>
            </div>
        </div>

        {{-- Stat Mini Guru --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-5">
            <div class="bg-white/10 rounded-xl px-4 py-3 text-center">
                <p class="text-xl font-bold text-white">{{ $peminjamanAktifGuru }}</p>
                <p class="text-xs text-indigo-200 mt-0.5">Dipinjam</p>
            </div>

            <div class="bg-white/10 rounded-xl px-4 py-3 text-center">
                <p class="text-xl font-bold text-white">{{ $pengembalianGuru }}</p>
                <p class="text-xs text-indigo-200 mt-0.5">Dikembalikan</p>
            </div>
            <div class="bg-white/10 rounded-xl px-4 py-3 text-center">
                <p class="text-xl font-bold text-white">{{ $totalRiwayatGuru }}</p>
                <p class="text-xs text-indigo-200 mt-0.5">Total Riwayat</p>
            </div>
        </div>
    </div>

    {{-- 1.b TOP 3 BARANG PALING SERING DIPINJAM --}}
    <div class="mb-8">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Top 3 Barang Paling Sering Dipinjam</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @php
                $gradients = [
                    'from-yellow-400 to-amber-500',
                    'from-slate-400 to-slate-500',
                    'from-orange-400 to-orange-500',
                ];
                $badges = [
                    'bg-yellow-100 text-yellow-700',
                    'bg-slate-200 text-slate-600',
                    'bg-orange-100 text-orange-600',
                ];
                $rankLabels = ['#1', '#2', '#3'];
                $rankEmoji = ['', '', ''];
            @endphp

            @forelse($topBarang as $index => $item)
                <div
                    class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                    <div
                        class="w-16 h-16 rounded-full bg-gradient-to-br {{ $gradients[$index] }} flex items-center justify-center shadow-md mb-2">
                        @php $namaBarang = strtolower($item->jenis->kategori->id_kategori ?? ''); @endphp
                        @if (str_contains($namaBarang, 'laptop') || str_contains($namaBarang, 'komputer') || str_contains($namaBarang, 'pc'))
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        @elseif(str_contains($namaBarang, 'proyektor') || str_contains($namaBarang, 'projector'))
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.893L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                            </svg>
                        @else
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                            </svg>
                        @endif
                    </div>
                    <span class="text-lg mb-1">{{ $rankEmoji[$index] }}</span>
                    <span
                        class="text-xs font-bold {{ $badges[$index] }} px-2 py-0.5 rounded-full mb-3">{{ $rankLabels[$index] }}</span>
                    <span class="text-xs font-mono font-semibold text-slate-400 mb-1">{{ $item->kode_barang }}</span>
                    <h3 class="text-sm font-bold text-slate-800 mb-1 leading-snug">
                        {{ $item->jenis->nama_barang ?? 'Nama tidak tersedia' }}
                    </h3>
                    <p class="text-xs text-slate-400 mb-3">Kondisi: {{ ucfirst($item->kondisi_barang ?? '-') }}</p>
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $badges[$index] }}">
                        {{ $item->detail_count }}× dipinjam
                    </span>
                </div>
            @empty
                <div class="col-span-3 text-center text-slate-400 py-10">Belum ada data peminjaman.</div>
            @endforelse
        </div>
    </div>

    {{-- 1.c DAFTAR BARANG SEDANG DIPINJAM PENGGUNA --}}
    <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 mb-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-semibold text-slate-800">Detail Peminjaman Aktif Kamu</h2>
            <a href="{{ route('peminjaman-barang.index') }}"
                class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Lihat semua →</a>
        </div>
        <div class="space-y-3">
            @forelse($peminjamanTerbaru as $item)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-200 transition-colors duration-150">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <span
                            class="text-indigo-600 text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $item->id_peminjaman }}</p>
                        <p class="text-xs text-slate-400">Kembali: {{ $item->tanggal_pengembalian ?? '-' }}</p>
                        @if ($item->detail && $item->detail->count())
                            <p class="text-xs text-slate-400">
                                Barang: {{ $item->detail->pluck('kode_barang')->implode(', ') }}
                            </p>
                        @endif
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span
                            class="inline-block text-xs px-2 py-1 rounded-full font-medium
                                {{ $item->status_peminjaman === 'dipinjam'
                                    ? 'bg-red-100 text-red-600'
                                    : ($item->status_peminjaman === 'dikembalikan'
                                        ? 'bg-green-100 text-green-600'
                                        : 'bg-yellow-100 text-yellow-600') }}">

                            @if ($item->status_peminjaman === 'dipinjam')
                                <a href="{{ route('peminjaman-barang.back', $item->id_peminjaman) }}"
                                    >
                                    Kembalikan
                                </a>
                            @else
                                {{ ucfirst($item->status_peminjaman) }}
                            @endif

                        </span>
                        <p class="text-xs text-slate-400 mt-1">{{ $item->created_at?->diffForHumans() }}</p>
                    </div>

                </div>
            @empty
                <div class="text-center py-10">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-sm text-slate-400">Kamu belum memiliki peminjaman aktif</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- 1.d LOG AKTIVITAS Guru --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 inline-block"></span>
                    <h2 class="text-base font-semibold text-slate-800">Log Aktivitas Kamu</h2>
                </div>
                <span class="text-xs text-slate-400">Aktivitas terbaru milikmu</span>
            </div>
            <div class="divide-y divide-slate-300 max-h-96 overflow-y-auto">
                @forelse($peminjamanTerbaru as $item)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-slate-200 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0 text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800">{{ $item->id_peminjaman }}</p>
                            <p class="text-xs text-slate-400">
                                Peminjaman ·
                                @if ($item->detail && $item->detail->count())
                                    {{ $item->detail->pluck('kode_barang')->implode(', ') }}
                                @else
                                    -
                                @endif
                            </p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span
                                class="inline-block text-xs px-2 py-1 rounded-full font-medium
                                {{ $item->status_peminjaman === 'dipinjam'
                                    ? 'bg-blue-100 text-blue-600'
                                    : ($item->status_peminjaman === 'dikembalikan'
                                        ? 'bg-green-100 text-green-600'
                                        : 'bg-yellow-100 text-yellow-600') }}">
                                {{ ucfirst($item->status_peminjaman) }}
                            </span>
                            <p class="text-xs text-slate-400 mt-1">{{ $item->created_at?->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-6 text-sm">Belum ada log aktivitas.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- 1.e PENGEMBALIAN Guru --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                    <h2 class="text-base font-semibold text-slate-800">Pengembalian Kamu</h2>
                </div>
                <a href="{{ route('peminjaman-barang.index') }}"
                    class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-300 max-h-80 overflow-y-auto">
                @forelse($peminjamanTerbaru->where('status_peminjaman', 'dikembalikan') as $item)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-green-50 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0 text-xs font-bold">
                            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800">{{ $item->id_peminjaman }}</p>
                            <p class="text-xs text-slate-400">Dikembalikan: {{ $item->tanggal_pengembalian ?? '-' }}
                            </p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span
                                class="inline-block text-xs px-2 py-1 rounded-full font-medium bg-green-100 text-green-600">
                                Dikembalikan
                            </span>
                            <p class="text-xs text-slate-400 mt-1">{{ $item->created_at?->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-10 text-sm">Belum ada pengembalian.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- 4.a BARANG TERSEDIA & TIDAK TERSEDIA --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Barang Tersedia --}}
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center gap-2 px-6 py-4 border-b border-slate-300">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                <h2 class="text-base font-semibold text-slate-800">Daftar Barang Tersedia</h2>
                <span class="ml-auto bg-green-100 text-green-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                    {{ $barangTersedia->count() }} barang
                </span>
            </div>
            <div class="divide-y divide-slate-300 max-h-72 overflow-y-auto">
                @forelse($barangTersedia as $barang)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-green-50 transition">
                        <div
                            class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-mono text-slate-400">{{ $barang->kode_barang }}</p>
                            <p class="text-sm font-medium text-slate-800 truncate">
                                {{ $barang->jenis->nama_barang ?? 'Nama tidak tersedia' }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="text-xs text-slate-400">{{ ucfirst($barang->kondisi_barang) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-10 text-sm">Semua barang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>

        {{-- Barang Tidak Tersedia --}}
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center gap-2 px-6 py-4 border-b border-slate-300">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span>
                <h2 class="text-base font-semibold text-slate-800">Daftar Barang Tidak Tersedia</h2>
                <span class="ml-auto bg-red-100 text-red-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                    {{ $barangTidakTersedia->count() }} barang
                </span>
            </div>
            <div class="divide-y divide-slate-300 max-h-72 overflow-y-auto">
                @forelse($barangTidakTersedia as $barang)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-red-50 transition">
                        <div
                            class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-500 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-mono text-slate-400">{{ $barang->kode_barang }}</p>
                            <p class="text-sm font-medium text-slate-800 truncate">
                                {{ $barang->jenis->nama_barang ?? 'Nama tidak tersedia' }}</p>
                        </div>
                        <span
                            class="text-xs px-2 py-0.5 rounded-full bg-red-100 text-red-600 flex-shrink-0 font-medium">Dipinjam</span>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-10 text-sm">Tidak ada barang yang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- PEMINJAMAN AKTIF Guru (detail) --}}


</x-layout>
