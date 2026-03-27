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

    {{-- PROFILE SECTION - WITH ORIGINAL COLORS --}}
    <div class="mb-5 md:mb-6 bg-slate-100 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-sm border border-slate-300">
        <div class="flex items-center gap-3 md:gap-4">
            <div
                class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                <span class="text-indigo-600 text-xl md:text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-slate-400 uppercase tracking-widest">
                    {{ $jakartaTime->translatedFormat('l, d F Y') }}
                </p>
                <h1 class="text-xl md:text-2xl font-bold text-slate-800 mt-1">
                    {{ $greeting }},
                    <span class="text-indigo-600">{{ auth()->user()->username }}</span>
                </h1>
                <div class="flex flex-wrap items-center gap-2 mt-1.5">
                    <span class="text-xs bg-indigo-100 text-indigo-600 font-semibold px-2.5 py-0.5 rounded-full">
                        {{ ucfirst(auth()->user()->role ?? 'Super Admin') }}
                    </span>
                    <span class="text-xs text-slate-400">{{ auth()->user()->user_id }}</span>
                    <span class="text-xs text-slate-400 hidden sm:inline">{{ auth()->user()->email }}</span>
                </div>
                <p class="text-xs md:text-sm text-slate-400 mt-1.5">
                    Sekarang pukul {{ $jakartaTime->format('H:i') }} WIB —
                    Kelola inventaris dengan lebih efisien hari ini.
                </p>
            </div>
        </div>
    </div>

    {{-- Welcome Toast - IMPROVED --}}
    <div id="welcomeToast"
        class="fixed top-4 right-4 left-4 sm:left-auto sm:right-6 sm:top-6 bg-white shadow-2xl rounded-xl sm:w-80 z-50 transform translate-y-[-200%] sm:translate-y-0 sm:translate-x-96 opacity-0 transition-all duration-500 border border-slate-200">
        <div class="flex items-start gap-3 p-4">
            <div
                class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800">
                    {{ $greeting }}, {{ auth()->user()->username }}!
                </p>
                <p class="text-xs text-slate-500 mt-0.5">
                    Semoga harimu produktif dan menyenangkan
                </p>
            </div>
            <button onclick="closeToast()" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const toast = document.getElementById('welcomeToast');
            setTimeout(() => {
                if (window.innerWidth < 640) {
                    toast.classList.remove('translate-y-[-200%]', 'opacity-0');
                    toast.classList.add('translate-y-0', 'opacity-100');
                } else {
                    toast.classList.remove('translate-x-96', 'opacity-0');
                    toast.classList.add('translate-x-0', 'opacity-100');
                }
            }, 400);
            // Removed auto-hide - toast will stay until user clicks close button
        });

        function closeToast() {
            const toast = document.getElementById('welcomeToast');
            if (window.innerWidth < 640) {
                toast.classList.add('translate-y-[-200%]', 'opacity-0');
            } else {
                toast.classList.add('translate-x-96', 'opacity-0');
            }
        }
    </script>

    {{-- STATS CARDS - CLEAN DESIGN --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4 mb-5 md:mb-6">
        {{-- Total Barang --}}
        <div
            class="bg-white rounded-xl md:rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-slate-800">{{ $totalBarang }}</p>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Total Barang</p>
        </div>

        {{-- Peminjaman Aktif --}}
        <div
            class="bg-white rounded-xl md:rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 hover:-translate-y-1">
            <div class="flex items-center justify-between mb-3">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-slate-800">{{ $peminjamanAktif }}</p>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Peminjaman Aktif</p>
        </div>

        {{-- Pemeliharaan --}}
        <div
            class="bg-white rounded-xl md:rounded-2xl p-4 md:p-5 shadow-sm border border-slate-200 hover:shadow-md transition-all duration-200 hover:-translate-y-1 col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between mb-3">
                <div
                    class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-md">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl md:text-3xl font-bold text-slate-800">{{ $pemeliharaan }}</p>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Pemeliharaan Barang</p>
        </div>
    </div>

    @if ($requestPeminjaman->count() > 0)
        {{-- REQUEST PEMINJAMAN - COMPACT --}}
        <div class="mb-5 md:mb-6">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div
                    class="bg-gradient-to-r from-blue-50 to-blue-100/50 px-4 md:px-5 py-3 md:py-4 border-b border-blue-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-800">Permintaan Peminjaman</h2>
                        </div>
                        <span class="bg-blue-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            {{ $requestPeminjaman->count() }}
                        </span>
                    </div>
                </div>
                <div class="divide-y divide-slate-100 max-h-80 overflow-y-auto">
                    @forelse($requestPeminjaman as $barang)
                        <div class="flex items-center gap-3 px-4 md:px-5 py-3 hover:bg-blue-50/50 transition-colors">
                            <div
                                class="w-8 h-8 md:w-9 md:h-9 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-mono text-slate-400">{{ $barang->id_peminjaman }}</p>
                                @foreach ($barang->detail as $detail)
                                    <p class="text-sm md:text-base font-medium text-slate-800 truncate">
                                        {{ $detail->kode_barang ?? 'Nama tidak tersedia' }}</p>
                                @endforeach
                            </div>
                            <a href="{{ route('peminjaman-barang.accept', $barang->id_peminjaman) }}"
                                class="text-xs md:text-sm px-3 md:px-4 py-1.5 md:py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 font-medium transition-colors flex-shrink-0">
                                Terima
                            </a>
                        </div>
                    @empty
                        <div class="text-center text-slate-400 py-8 text-sm">Tidak ada permintaan peminjaman.</div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    @if ($requestPengembalian->count() > 0)
        {{-- REQUEST PENGEMBALIAN - COMPACT --}}
        <div class="mb-5 md:mb-6">
            <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div
                    class="bg-gradient-to-r from-amber-50 to-amber-100/50 px-4 md:px-5 py-3 md:py-4 border-b border-amber-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                            <h2 class="text-sm md:text-base font-semibold text-slate-800">Permintaan Pengembalian</h2>
                        </div>
                        <span class="bg-amber-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                            {{ $requestPengembalian->count() }}
                        </span>
                    </div>
                </div>
                <div class="divide-y divide-slate-100 max-h-80 overflow-y-auto">
                    @forelse($requestPengembalian as $barang)
                        <div class="flex items-center gap-3 px-4 md:px-5 py-3 hover:bg-amber-50/50 transition-colors">
                            <div
                                class="w-8 h-8 md:w-9 md:h-9 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0">
                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-mono text-slate-400">{{ $barang->id_peminjaman }}</p>
                                @foreach ($barang->detail as $detail)
                                    <p class="text-sm md:text-base font-medium text-slate-800 truncate">
                                        {{ $detail->kode_barang ?? 'Nama tidak tersedia' }}</p>
                                @endforeach
                            </div>
                            <a href="{{ route('peminjaman-barang.kembalikan', $barang->id_peminjaman) }}"
                                class="text-xs md:text-sm px-3 md:px-4 py-1.5 md:py-2 rounded-lg bg-amber-500 text-white hover:bg-amber-600 font-medium transition-colors flex-shrink-0">
                                Terima
                            </a>
                        </div>
                    @empty
                        <div class="text-center text-slate-400 py-8 text-sm">Tidak ada permintaan pengembalian.</div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    {{-- TOP 3 BARANG TERPOPULER - MODERN CARDS --}}
    <div class="mb-5 md:mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base md:text-lg font-bold text-slate-800">Barang Terpopuler</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 md:gap-4">
            @php
                $gradients = [
                    ['from' => 'from-yellow-400', 'to' => 'to-amber-500', 'ring' => 'ring-yellow-200'],
                    ['from' => 'from-slate-400', 'to' => 'to-slate-500', 'ring' => 'ring-slate-200'],
                    ['from' => 'from-orange-400', 'to' => 'to-orange-500', 'ring' => 'ring-orange-200'],
                ];
                $badges = [
                    'bg-yellow-100 text-yellow-700',
                    'bg-slate-200 text-slate-700',
                    'bg-orange-100 text-orange-700',
                ];
               
            @endphp

            @forelse($topBarang as $index => $item)
                <div
                    class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-5 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-start gap-3 mb-3">
                        <div
                            class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br {{ $gradients[$index]['from'] }} {{ $gradients[$index]['to'] }} rounded-xl flex items-center justify-center shadow-lg ring-4 {{ $gradients[$index]['ring'] }} flex-shrink-0">
                            @php $namaBarang = strtolower($item->jenis->kategori ?? ''); @endphp
                            @if (str_contains($namaBarang, 'laptop') || str_contains($namaBarang, 'komputer') || str_contains($namaBarang, 'pc'))
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @elseif(str_contains($namaBarang, 'proyektor') || str_contains($namaBarang, 'projector'))
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.893L15 14M3 8a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold {{ $badges[$index] }} px-2 py-0.5 rounded-full">
                                    #{{ $index + 1 }}
                                </span>
                            </div>
                            <p class="text-xs font-mono text-slate-400">{{ $item->kode_barang }}</p>
                        </div>
                    </div>
                    <h3 class="text-sm md:text-base font-bold text-slate-800 mb-2 line-clamp-2">
                        {{ $item->jenis->nama_barang ?? 'Nama tidak tersedia' }}
                    </h3>
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                        <span class="text-xs text-slate-500">Kondisi:
                            {{ ucfirst($item->kondisi_barang ?? '-') }}</span>
                        <span class="text-xs font-bold {{ $badges[$index] }} px-2.5 py-1 rounded-full">
                            {{ $item->detail_count }}× dipinjam
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-slate-400 py-10 text-sm">Belum ada data peminjaman.</div>
            @endforelse
        </div>
    </div>

    {{-- BARANG TERSEDIA & TIDAK TERSEDIA - SIDE BY SIDE --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-5 mb-5 md:mb-6">
        {{-- Barang Tersedia --}}
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-green-100/50 px-4 md:px-5 py-3 border-b border-green-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <h2 class="text-sm md:text-base font-semibold text-slate-800">Barang Tersedia</h2>
                    </div>
                    <span class="bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                        {{ $barangTersedia->count() }}
                    </span>
                </div>
            </div>
            <div class="divide-y divide-slate-100 max-h-72 overflow-y-auto">
                @forelse($barangTersedia as $barang)
                    <div class="flex items-center gap-3 px-4 md:px-5 py-2.5 hover:bg-green-50/50 transition-colors">
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
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-8 text-sm">Semua barang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>

        {{-- Barang Tidak Tersedia --}}
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-red-50 to-red-100/50 px-4 md:px-5 py-3 border-b border-red-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <h2 class="text-sm md:text-base font-semibold text-slate-800">Tidak Tersedia</h2>
                    </div>
                    <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                        {{ $barangTidakTersedia->count() }}
                    </span>
                </div>
            </div>
            <div class="divide-y divide-slate-100 max-h-72 overflow-y-auto">
                @forelse($barangTidakTersedia as $barang)
                    <div class="flex items-center gap-3 px-4 md:px-5 py-2.5 hover:bg-red-50/50 transition-colors">
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
                        <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-600 flex-shrink-0 font-medium">
                            Dipinjam
                        </span>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-8 text-sm">Tidak ada barang yang sedang dipinjam.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- LOG AKTIVITAS TERBARU - COMBINED --}}
    <div class="mb-5 md:mb-6">
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div
                class="bg-gradient-to-r from-indigo-50 to-indigo-100/50 px-4 md:px-5 py-3 md:py-4 border-b border-indigo-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                        <h2 class="text-sm md:text-base font-semibold text-slate-800">Log Aktivitas Terbaru</h2>
                    </div>
                    <span class="text-xs text-slate-400">Semua aktivitas</span>
                </div>
            </div>
            <div class="divide-y divide-slate-100 max-h-96 overflow-y-auto">
                @php
                    $allActivities = collect();

                    foreach ($peminjamanTerbaru as $item) {
                        $allActivities->push([
                            'type' => 'peminjaman',
                            'data' => $item,
                            'created_at' => $item->created_at,
                        ]);
                    }

                    foreach ($pemeliharaanTerbaru as $item) {
                        $allActivities->push([
                            'type' => 'pemeliharaan',
                            'data' => $item,
                            'created_at' => $item->created_at,
                        ]);
                    }

                    $allActivities = $allActivities->sortByDesc('created_at')->take(10);
                @endphp

                @forelse($allActivities as $activity)
                    @if ($activity['type'] === 'peminjaman')
                        <div class="flex items-center gap-3 px-4 md:px-5 py-3 hover:bg-indigo-50/50 transition-colors">
                            <div
                                class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                                <span
                                    class="text-xs font-bold">{{ strtoupper(substr($activity['data']->user_id, 0, 2)) }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-slate-800">{{ $activity['data']->user_id }}</p>
                                <p class="text-xs text-slate-400">Peminjaman · {{ $activity['data']->id_peminjaman }}
                                </p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <span
                                    class="inline-block text-xs px-2.5 py-1 rounded-full font-medium
                                    {{ $activity['data']->status_peminjaman === 'dipinjam'
                                        ? 'bg-blue-100 text-blue-600'
                                        : ($activity['data']->status_peminjaman === 'dikembalikan'
                                            ? 'bg-green-100 text-green-600'
                                            : 'bg-yellow-100 text-yellow-600') }}">
                                    {{ ucfirst($activity['data']->status_peminjaman) }}
                                </span>
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ $activity['data']->created_at?->diffForHumans() }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3 px-4 md:px-5 py-3 hover:bg-indigo-50/50 transition-colors">
                            <div
                                class="w-9 h-9 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-slate-800">{{ $activity['data']->id_pj }}</p>
                                <p class="text-xs text-slate-400">Pemeliharaan ·
                                    {{ $activity['data']->kegiatan_pemeliharaan }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <span
                                    class="inline-block text-xs px-2.5 py-1 rounded-full font-medium
                                    {{ $activity['data']->status_pemeliharaan === 'disetujui'
                                        ? 'bg-green-100 text-green-600'
                                        : ($activity['data']->status_pemeliharaan === 'ditolak'
                                            ? 'bg-red-100 text-red-600'
                                            : 'bg-slate-200 text-slate-600') }}">
                                    {{ ucfirst($activity['data']->status_pemeliharaan) }}
                                </span>
                                <p class="text-xs text-slate-400 mt-1">
                                    {{ $activity['data']->created_at?->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-center text-slate-400 py-8 text-sm">Belum ada log aktivitas.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- DETAIL PEMINJAMAN & PEMELIHARAAN GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-5 mb-5 md:mb-6">
        {{-- Peminjaman Terbaru --}}
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm md:text-base font-semibold text-slate-800">Peminjaman Terbaru</h2>
                <a href="{{ route('peminjaman-barang.index') }}"
                    class="text-xs text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-1">
                    Lihat semua
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="space-y-2">
                @forelse($peminjamanTerbaru->take(5) as $item)
                    <div class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                            <span
                                class="text-indigo-600 text-xs font-bold">{{ strtoupper(substr($item->user_id, 0, 2)) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $item->user_id }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $item->id_peminjaman }}</p>
                        </div>
                        <span
                            class="text-xs px-2 py-1 rounded-full font-medium flex-shrink-0
                            {{ $item->status_peminjaman === 'dipinjam'
                                ? 'bg-blue-100 text-blue-600'
                                : ($item->status_peminjaman === 'dikembalikan'
                                    ? 'bg-green-100 text-green-600'
                                    : 'bg-yellow-100 text-yellow-600') }}">
                            {{ ucfirst($item->status_peminjaman) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-slate-200 mx-auto mb-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="text-sm text-slate-400">Belum ada peminjaman</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Pemeliharaan Terbaru --}}
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm md:text-base font-semibold text-slate-800">Pemeliharaan Terbaru</h2>
                <a href="{{ route('pemeliharaan-barang.index') }}"
                    class="text-xs text-indigo-600 hover:text-indigo-700 font-medium flex items-center gap-1">
                    Lihat semua
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div class="space-y-2">
                @forelse($pemeliharaanTerbaru->take(5) as $item)
                    <div class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $item->id_pj }}</p>
                            <p class="text-xs text-slate-400 truncate">{{ $item->kegiatan_pemeliharaan }}</p>
                        </div>
                        <span
                            class="text-xs px-2 py-1 rounded-full font-medium flex-shrink-0
                            {{ $item->status_pemeliharaan === 'disetujui'
                                ? 'bg-green-100 text-green-600'
                                : ($item->status_pemeliharaan === 'ditolak'
                                    ? 'bg-red-100 text-red-600'
                                    : 'bg-slate-200 text-slate-600') }}">
                            {{ ucfirst($item->status_pemeliharaan) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 text-slate-200 mx-auto mb-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        </svg>
                        <p class="text-sm text-slate-400">Belum ada pemeliharaan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- INFO RINGKASAN - MODERN CARD --}}
    <div
        class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl md:rounded-2xl p-5 md:p-6 text-white shadow-xl">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            <h3 class="text-base md:text-lg font-bold">Ringkasan Sistem</h3>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Pengguna</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalAkun }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Ruang</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalRuang }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Jurusan</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalJurusan }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Kelas</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalKelas }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Barang</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalBarang }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Jenis Barang</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalJenisBarang }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Kategori</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalKategoriBarang }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Penanggung Jawab</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalPenanggungJawab }}</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                <p class="text-xs text-indigo-200">Angkatan</p>
                <p class="text-xl md:text-2xl font-bold mt-1">{{ $totalAngkatan }}</p>
            </div>
        </div>
    </div>

</x-layout>
