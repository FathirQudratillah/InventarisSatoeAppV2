<x-layout type="dashboard">
    <x-slot:title>Dashboard</x-slot:title>

    {{-- Header Sambutan --}}
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

    {{-- 1.a PROFILE --}}
    <div class="mb-8 bg-slate-100 p-6 rounded-2xl shadow-sm border border-slate-300">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                <span class="text-indigo-600 text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                </span>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-widest">
                    {{ $jakartaTime->translatedFormat('l, d F Y') }}
                </p>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 mt-1">
                    {{ $greeting }},
                    <span class="text-indigo-600">{{ auth()->user()->username }}</span>
                </h1>
                <div class="flex items-center gap-3 mt-1">
                    <span class="text-xs bg-indigo-100 text-indigo-600 font-semibold px-2 py-0.5 rounded-full">
                        {{ ucfirst(auth()->user()->role ?? 'Super Admin') }}
                    </span>
                    <span class="text-xs text-slate-400">{{ auth()->user()->user_id }}</span>
                    <span class="text-xs text-slate-400">{{ auth()->user()->email }}</span>
                </div>
                <p class="text-sm text-slate-400 mt-1">
                    Sekarang pukul {{ $jakartaTime->format('H:i') }} WIB —
                    Kelola inventaris dengan lebih efisien hari ini.
                </p>
            </div>
        </div>
    </div>
    
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
            setTimeout(() => {
                closeToast();
            }, 5000);
        });

        function closeToast() {
            const toast = document.getElementById('welcomeToast');
            toast.classList.add('translate-x-96', 'opacity-0');
        }
    </script>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div
            class="bg-slate-100 rounded-2xl p-5 shadow-sm border border-slate-300 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">Total</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalBarang }}</p>
            <p class="text-xs text-slate-400 mt-1">Total Barang</p>
        </div>

        <div
            class="bg-slate-100 rounded-2xl p-5 shadow-sm border border-slate-300 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Aktif</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $peminjaman }}</p>
            <p class="text-xs text-slate-400 mt-1">Peminjaman Aktif</p>
        </div>

        <div
            class="bg-slate-100 rounded-2xl p-5 shadow-sm border border-slate-300 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Pending</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $pengajuan }}</p>
            <p class="text-xs text-slate-400 mt-1">Pengajuan Barang</p>
        </div>

        <div
            class="bg-slate-100 rounded-2xl p-5 shadow-sm border border-slate-300 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-xs font-medium text-red-600 bg-red-100 px-2 py-1 rounded-full">Total</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $pemeliharaan }}</p>
            <p class="text-xs text-slate-400 mt-1">Pemeliharaan Barang</p>
        </div>
    </div>

    {{-- 1.c Request Peminjaman --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span>
                    <h2 class="text-base font-semibold text-slate-800">Permintaan Peminjaman Barang</h2>
                </div>
                <span class="ml-auto bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                    {{ $requestPeminjaman->count() }} barang
                </span>
            </div>
            <div class="divide-y divide-slate-300 max-h-80 overflow-y-auto">
                @forelse($requestPeminjaman as $barang)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-blue-50 transition">
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-mono text-slate-400">{{ $barang->id_peminjaman }}</p>
                            @foreach ($barang->detail as $detail)
                                
                            <p class="text-sm font-medium text-slate-800 truncate">
                                {{ $detail->kode_barang ?? 'Nama tidak tersedia' }}</p>
                             @endforeach
                        </div>
                        <div class="text-right flex-shrink-0">
                            <a href="{{ route('peminjaman-barang.accept', $barang->id_peminjaman) }}"
                                class="text-xs px-2 py-0.5 rounded-full bg-green-100 text-green-600 hover:bg-green-300 font-medium">Accept</a>
                            <p class="text-xs text-slate-400 mt-0.5">{{ ucfirst($barang->status_peminjaman) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-10 text-sm">Tidak ada barang yang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- 1.b TOP 3 BARANG TERPOPULER --}}
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
                @php $barang = $allBarang[$item->kode_barang] ?? null; @endphp
                <div
                    class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow">
                    <div
                        class="w-16 h-16 rounded-full bg-gradient-to-br {{ $gradients[$index] }} flex items-center justify-center shadow-md mb-2">
                        @php $namaBarang = strtolower($barang->nama_barang ?? ''); @endphp
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
                        {{ $barang->nama_barang ?? 'Nama tidak tersedia' }}
                    </h3>
                    <p class="text-xs text-slate-400 mb-3">Kondisi: {{ ucfirst($barang->kondisi_barang ?? '-') }}</p>
                    <span
                        class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold {{ $badges[$index] }}">
                        {{ $item->total_dipinjam }}× dipinjam
                    </span>
                </div>
            @empty
                <div class="col-span-3 text-center text-slate-400 py-10">Belum ada data peminjaman.</div>
            @endforelse
        </div>
    </div>

    {{-- 1.c DAFTAR BARANG SEDANG DIPINJAM PENGGUNA --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span>
                    <h2 class="text-base font-semibold text-slate-800">Daftar Barang Sedang Dipinjam Pengguna</h2>
                </div>
                <span class="ml-auto bg-blue-100 text-blue-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                    {{ $requestPeminjaman->count() }} barang
                </span>
            </div>
            <div class="divide-y divide-slate-300 max-h-80 overflow-y-auto">
                @forelse($requestPeminjaman as $barang)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-blue-50 transition">
                        <div
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs font-mono text-slate-400">{{ $barang->kode_barang }}</p>
                            <p class="text-sm font-medium text-slate-800 truncate">
                                {{ $barang->nama_barang ?? 'Nama tidak tersedia' }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span
                                class="text-xs px-2 py-0.5 rounded-full bg-blue-100 text-blue-600 font-medium">Dipinjam</span>
                            <p class="text-xs text-slate-400 mt-0.5">{{ ucfirst($barang->kondisi_barang) }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-10 text-sm">Tidak ada barang yang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- 1.d LOG AKTIVITAS --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 inline-block"></span>
                    <h2 class="text-base font-semibold text-slate-800">Log Aktivitas Terbaru</h2>
                </div>
                <span class="text-xs text-slate-400">Semua aktivitas</span>
            </div>
            <div class="divide-y divide-slate-300 max-h-[420px] overflow-y-auto">
                {{-- Gabungkan peminjaman + pengajuan + pemeliharaan sebagai log --}}
                @forelse($peminjamanTerbaru as $item)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-slate-200 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0 text-xs font-bold">
                            {{ strtoupper(substr($item->user_id, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800">{{ $item->user_id }}</p>
                            <p class="text-xs text-slate-400">Peminjaman · {{ $item->id_peminjaman }}</p>
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

                @foreach ($pengajuanTerbaru as $item)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-slate-200 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 flex-shrink-0 text-xs font-bold">
                            {{ strtoupper(substr($item->user->name ?? 'US', 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800">{{ $item->user_id }}</p>
                            <p class="text-xs text-slate-400">Pengajuan · {{ $item->id_pengajuan }} ·
                                {{ $item->nama_barang }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span
                                class="inline-block text-xs px-2 py-1 rounded-full font-medium
                                    {{ $item->status_pengajuan === 'menunggu'
                                        ? 'bg-yellow-100 text-yellow-600'
                                        : ($item->status_pengajuan === 'disetujui'
                                            ? 'bg-green-100 text-green-600'
                                            : 'bg-red-100 text-red-600') }}">
                                {{ ucfirst($item->status_pengajuan) }}
                            </span>
                            <p class="text-xs text-slate-400 mt-1">{{ $item->created_at?->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach

                @foreach ($pemeliharaanTerbaru as $item)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-slate-200 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 flex-shrink-0 text-xs font-bold">
                            PM
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800">{{ $item->id_pj }}</p>
                            <p class="text-xs text-slate-400">Pemeliharaan · {{ $item->tanggal_pemeliharaan }} ·
                                {{ $item->kegiatan_pemeliharaan }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span
                                class="inline-block text-xs px-2 py-1 rounded-full font-medium
                                    {{ $item->status_pemeliharaan === 'disetujui'
                                        ? 'bg-green-100 text-green-600'
                                        : ($item->status_pemeliharaan === 'ditolak'
                                            ? 'bg-red-100 text-red-600'
                                            : 'bg-slate-200 text-slate-600') }}">
                                {{ ucfirst($item->status_pemeliharan) }}
                            </span>
                            <p class="text-xs text-slate-400 mt-1">{{ $item->created_at?->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 1.e PENGEMBALIAN --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                    <h2 class="text-base font-semibold text-slate-800">Pengembalian Terbaru</h2>
                </div>
                <a href="{{ route('peminjaman-barang.index') }}"
                    class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Lihat semua →</a>
            </div>
            <div class="divide-y divide-slate-300 max-h-80 overflow-y-auto">
                @php $pengembalian = $peminjamanTerbaru->where('status_peminjaman', 'dikembalikan'); @endphp
                @forelse($pengembalian as $item)
                    <div class="flex items-center gap-3 px-6 py-3 hover:bg-green-50 transition">
                        <div
                            class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0 text-xs font-bold">
                            {{ strtoupper(substr($item->user_id, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-slate-800">{{ $item->user_id }}</p>
                            <p class="text-xs text-slate-400">{{ $item->id_peminjaman }}</p>
                            <p class="text-xs text-slate-400">Dikembalikan: {{ $item->tanggal_pengembalian }}</p>
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

    {{-- BARANG SERING DIPINJAM (TOP 10) --}}
    <div class="mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-300">
                <h2 class="text-base font-semibold text-slate-800">Barang Sering Dipinjam</h2>
                <span class="text-xs text-slate-400">Top 10</span>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 p-5">
                @forelse($barangSeringDipinjam as $index => $item)
                    @php $barang = $allBarang[$item->kode_barang] ?? null; @endphp
                    <div
                        class="bg-slate-200 rounded-xl p-3 flex flex-col items-center text-center hover:bg-blue-50 transition group">
                        <div
                            class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold mb-2 group-hover:bg-blue-200 transition">
                            #{{ $index + 1 }}
                        </div>
                        <p class="text-xs font-mono text-slate-400 mb-0.5">{{ $item->kode_barang }}</p>
                        <p class="text-xs font-semibold text-slate-800 leading-tight mb-2">
                            {{ Str::limit($barang->nama_barang ?? '-', 20) }}</p>
                        <span class="text-xs font-bold text-blue-600">{{ $item->total_dipinjam }}× dipinjam</span>
                    </div>
                @empty
                    <div class="col-span-5 text-center text-slate-400 py-8">Belum ada data.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- BARANG TERSEDIA & TIDAK TERSEDIA (5.a) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center gap-2 px-6 py-4 border-b border-slate-300">
                <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                <h2 class="text-base font-semibold text-slate-800">Daftar Barang Tersedia</h2>
                <span
                    class="ml-auto bg-green-100 text-green-700 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $barangTersedia->count() }}
                    barang</span>
            </div>
            <div class="divide-y divide-slate-300 max-h-[420px] overflow-y-auto">
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
                                {{ $barang->nama_barang ?? 'Nama tidak tersedia' }}</p>
                        </div>
                        <span
                            class="text-xs text-slate-400 flex-shrink-0">{{ ucfirst($barang->kondisi_barang) }}</span>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-10 text-sm">Semua barang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300">
            <div class="flex items-center gap-2 px-6 py-4 border-b border-slate-300">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span>
                <h2 class="text-base font-semibold text-slate-800">Daftar Barang Tidak Tersedia</h2>
                <span
                    class="ml-auto bg-red-100 text-red-700 text-xs font-bold px-2.5 py-0.5 rounded-full">{{ $barangTidakTersedia->count() }}
                    barang</span>
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
                                {{ $barang->nama_barang ?? 'Nama tidak tersedia' }}</p>
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

    {{-- Peminjaman Terbaru --}}
    <div class="lg:col-span-2 bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 mb-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-semibold text-slate-800">Peminjaman Terbaru</h2>
            <a href="{{ route('peminjaman-barang.index') }}"
                class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Lihat semua →</a>
        </div>
        <div class="space-y-3">
            @forelse($peminjamanTerbaru as $item)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-200 transition-colors duration-150">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <span
                            class="text-indigo-600 text-xs font-bold">{{ strtoupper(substr($item->user_id, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $item->user_id }}</p>
                        <p class="text-xs text-slate-400">{{ $item->id_peminjaman }}</p>
                        <p class="text-xs text-slate-400">{{ $item->tanggal_pengembalian }}</p>
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
                <div class="text-center py-10">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-sm text-slate-400">Belum ada peminjaman</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pengajuan Terbaru --}}
    <div class="lg:col-span-2 bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 mb-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-semibold text-slate-800">Pengajuan Terbaru</h2>
            <a href="{{ route('pengajuan-barang.index') }}"
                class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Lihat semua →</a>
        </div>
        <div class="space-y-3">
            @forelse($pengajuanTerbaru as $item)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-200 transition-colors duration-150">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <span
                            class="text-indigo-600 text-xs font-bold">{{ strtoupper(substr($item->user->name ?? 'US', 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $item->user_id }}</p>
                        <p class="text-xs text-slate-400">{{ $item->id_pengajuan }}</p>
                        <p class="text-xs text-slate-400">{{ $item->tanggal_pengajuan }}</p>
                        <p class="text-xs text-slate-400">{{ $item->nama_barang }}</p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span
                            class="inline-block text-xs px-2 py-1 rounded-full font-medium
                                {{ $item->status_pengajuan === 'menunggu'
                                    ? 'bg-yellow-100 text-yellow-600'
                                    : ($item->status_pengajuan === 'disetujui'
                                        ? 'bg-green-100 text-green-600'
                                        : ($item->status_pengajuan === 'ditolak'
                                            ? 'bg-red-100 text-red-600'
                                            : 'bg-slate-200 text-slate-600')) }}">
                            {{ ucfirst($item->status_pengajuan) }}
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
                    <p class="text-sm text-slate-400">Belum ada pengajuan</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pemeliharaan Terbaru --}}
    <div class="lg:col-span-2 bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 mb-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-base font-semibold text-slate-800">Pemeliharaan Terbaru</h2>
            <a href="{{ route('pemeliharaan-barang.index') }}"
                class="text-xs text-indigo-500 hover:text-indigo-700 font-medium">Lihat semua →</a>
        </div>
        <div class="space-y-3">
            @forelse($pemeliharaanTerbaru as $item)
                <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-slate-200 transition-colors duration-150">
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <span class="text-indigo-600 text-xs font-bold">
                            {{ strtoupper(substr($item->user_id->name ?? 'US', 0, 2)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate">{{ $item->id_pj }}</p>
                        <p class="text-xs text-slate-400">{{ $item->tanggal_pemeliharaan }}</p>
                        <p class="text-xs text-slate-500 font-medium truncate">{{ $item->kegiatan_pemeliharaan }}
                        </p>
                        <p class="text-xs text-slate-400 truncate">Barang: {{ $item->kode_barang }}</p>
                        @if ($item->keterangan)
                            <p class="text-xs text-slate-400 truncate">{{ $item->keterangan }}</p>
                        @endif
                    </div>
                    <div class="text-right flex-shrink-0">
                        <span
                            class="inline-block text-xs px-2 py-1 rounded-full font-medium
                        {{ $item->status_pemeliharaan === 'disetujui'
                            ? 'bg-green-100 text-green-600'
                            : ($item->status_pemeliharaan === 'ditolak'
                                ? 'bg-red-100 text-red-600'
                                : 'bg-slate-200 text-slate-600') }}">
                            {{ ucfirst($item->status_pemeliharaan) }}
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
                    <p class="text-sm text-slate-400">Belum ada pemeliharaan</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Detail Peminjaman Terbaru --}}
    @php $peminjaman = $peminjamanTerbaru->first(); @endphp
    <div class="bg-slate-100 rounded-2xl shadow-sm border border-slate-300 p-6 mb-6">
        <h2 class="text-base font-semibold text-slate-800 mb-6">Detail Peminjaman</h2>
        @if ($peminjaman)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-slate-400">Id_Detail</p>
                    <p class="text-sm font-medium text-slate-800">{{ $peminjaman->id_detail ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Barang</p>
                    <p class="text-sm font-medium text-slate-800">{{ $peminjaman->barang->kode_barang ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Tanggal Peminjaman</p>
                    <p class="text-sm font-medium text-slate-800">{{ $peminjaman->tanggal_peminjaman }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Tanggal Pengembalian</p>
                    <p class="text-sm font-medium text-slate-800">{{ $peminjaman->tanggal_pengembalian ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Status</p>
                    <span
                        class="inline-block mt-1 text-xs px-3 py-1 rounded-full font-medium
                            {{ $peminjaman->status_peminjaman === 'dipinjam'
                                ? 'bg-blue-100 text-blue-600'
                                : ($peminjaman->status_peminjaman === 'dikembalikan'
                                    ? 'bg-green-100 text-green-600'
                                    : 'bg-yellow-100 text-yellow-600') }}">
                        {{ ucfirst($peminjaman->status_peminjaman) }}
                    </span>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Keterangan</p>
                    <p class="text-sm text-slate-600">{{ $peminjaman->keterangan ?? '-' }}</p>
                </div>
            </div>
        @else
            <p class="text-sm text-slate-400">Belum ada data peminjaman.</p>
        @endif
    </div>

    {{-- Info Ringkasan --}}
    <div class="bg-indigo-600 rounded-2xl p-6 text-white border border-indigo-500">
        <p class="text-xs font-medium tracking-widest uppercase text-indigo-200 mb-1">Ringkasan</p>
        <h3 class="text-base font-bold mb-3">InventarisSatoeApp</h3>
        <div class="space-y-2 text-sm text-indigo-100">
            <div class="flex justify-between"><span>Total Pengguna</span><span
                    class="font-semibold text-white">{{ $totalAkun }}</span></div>
            <div class="flex justify-between"><span>Total Ruang</span><span
                    class="font-semibold text-white">{{ $totalRuang }}</span></div>
            <div class="flex justify-between"><span>Total Jurusan</span><span
                    class="font-semibold text-white">{{ $totalJurusan }}</span></div>
            <div class="flex justify-between"><span>Total Kelas</span><span
                    class="font-semibold text-white">{{ $totalKelas }}</span></div>
            <div class="flex justify-between"><span>Total Barang</span><span
                    class="font-semibold text-white">{{ $totalBarang }}</span></div>
            <div class="flex justify-between"><span>Total Jenis Barang</span><span
                    class="font-semibold text-white">{{ $totalJenisBarang }}</span></div>
            <div class="flex justify-between"><span>Total Kategori Barang</span><span
                    class="font-semibold text-white">{{ $totalKategoriBarang }}</span></div>
            <div class="flex justify-between"><span>Total Penanggung Jawab</span><span
                    class="font-semibold text-white">{{ $totalPenanggungJawab }}</span></div>
            <div class="flex justify-between"><span>Total Angkatan</span><span
                    class="font-semibold text-white">{{ $totalAngkatan }}</span></div>
        </div>
    </div>

</x-layout>
