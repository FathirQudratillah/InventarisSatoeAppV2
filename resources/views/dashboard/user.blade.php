<x-layout type="dashboard">
    <x-slot:title>Dashboard</x-slot:title>

    {{-- Notifikasi Success/Error --}}
    @if (session('success'))
        <div id="notification"
            class="fixed top-4 right-4 left-4 sm:left-auto sm:right-6 bg-green-500 text-white px-4 py-3 
                rounded-xl shadow-2xl z-50 transform translate-x-0 opacity-100 transition-all duration-500 
                flex items-center gap-3 max-w-md">
            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <p class="text-sm font-medium flex-1">{{ session('success') }}</p>
            <button onclick="closeNotification()" class="text-white/80 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div id="notification"
            class="fixed top-4 right-4 left-4 sm:left-auto sm:right-6 bg-red-500 text-white px-4 py-3 
                rounded-xl shadow-2xl z-50 transform translate-x-0 opacity-100 transition-all duration-500 
                flex items-center gap-3 max-w-md">
            <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <p class="text-sm font-medium flex-1">{{ session('error') }}</p>
            <button onclick="closeNotification()" class="text-white/80 hover:text-white">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <script>
        function closeNotification() {
            const notif = document.getElementById('notification');
            if (notif) {
                notif.classList.add('translate-x-96', 'opacity-0');
                setTimeout(() => notif.remove(), 300);
            }
        }

        // Auto close after 5 seconds
        if (document.getElementById('notification')) {
            setTimeout(() => {
                closeNotification();
            }, 5000);
        }
    </script>
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

    {{-- Welcome Toast - MOBILE OPTIMIZED --}}
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
            // Toast will stay until user clicks close button
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

    {{-- PROFILE SECTION - MOBILE OPTIMIZED --}}
    <div
        class="mb-5 md:mb-6 bg-gradient-to-r from-indigo-600 to-indigo-500 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md text-white">
        <div class="flex items-center gap-3 md:gap-5">
            <div
                class="w-14 h-14 md:w-16 md:h-16 rounded-full bg-white/20 flex items-center justify-center flex-shrink-0 ring-2 md:ring-4 ring-white/30">
                <span class="text-white text-xl md:text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                </span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs text-indigo-200 uppercase tracking-widest">
                    {{ \Carbon\Carbon::parse($jakartaTime)->locale('id')->translatedFormat('l, d F Y') }}
                </p>
                <h1 class="text-xl md:text-2xl lg:text-3xl font-bold mt-1">
                    {{ $greeting }}, <span class="text-yellow-300">{{ auth()->user()->username }}</span>
                </h1>
                <div class="flex flex-wrap items-center gap-2 mt-1.5">
                    <span class="text-xs bg-white/20 text-white font-semibold px-2.5 py-0.5 rounded-full">
                        {{ ucfirst(auth()->user()->role ?? 'User') }}
                    </span>
                    <span class="text-xs text-indigo-200">{{ auth()->user()->user_id }}</span>
                    <span class="text-xs text-indigo-200 hidden sm:inline">{{ auth()->user()->email }}</span>
                </div>
                <p class="text-xs text-indigo-200 mt-1.5">
                    Sekarang pukul {{ $jakartaTime->format('H:i') }} WIB — Kelola peminjaman barang kamu hari ini.
                </p>
            </div>
        </div>

        {{-- Stat Mini User - MOBILE OPTIMIZED --}}
        <div class="grid grid-cols-3 gap-2 md:gap-3 mt-4 md:mt-5">
            <div class="bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl px-3 md:px-4 py-2.5 md:py-3 text-center">
                <p class="text-lg md:text-xl font-bold text-white">{{ $peminjamanAktifUser }}</p>
                <p class="text-[10px] md:text-xs text-indigo-200 mt-0.5">Dipinjam</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl px-3 md:px-4 py-2.5 md:py-3 text-center">
                <p class="text-lg md:text-xl font-bold text-white">{{ $pengembalianUser }}</p>
                <p class="text-[10px] md:text-xs text-indigo-200 mt-0.5">Dikembalikan</p>
            </div>
            <div class="bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl px-3 md:px-4 py-2.5 md:py-3 text-center">
                <p class="text-lg md:text-xl font-bold text-white">{{ $totalRiwayatUser }}</p>
                <p class="text-[10px] md:text-xs text-indigo-200 mt-0.5">Total Riwayat</p>
            </div>
        </div>
    </div>

    {{-- TOP 3 BARANG PALING SERING DIPINJAM - MOBILE OPTIMIZED --}}
    <div class="mb-5 md:mb-6">
        <h2 class="text-base md:text-lg font-bold text-slate-800 mb-3 md:mb-4 px-1">Barang Terpopuler</h2>
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
                $rankLabels = ['#1', '#2', '#3'];
            @endphp

            @forelse($topBarang as $index => $item)
                <div
                    class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-5 hover:shadow-lg transition-all duration-200 hover:-translate-y-1">
                    <div class="flex items-start gap-3 mb-3">
                        <div
                            class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br {{ $gradients[$index]['from'] }} {{ $gradients[$index]['to'] }} rounded-xl flex items-center justify-center shadow-lg ring-4 {{ $gradients[$index]['ring'] }} flex-shrink-0">
                            @php $namaBarang = strtolower($item->jenis->kategori->id_kategori ?? ''); @endphp
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
                                    {{ $rankLabels[$index] }}
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

    {{-- PEMINJAMAN AKTIF USER - MOBILE OPTIMIZED --}}
    <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 p-4 md:p-6 mb-5 md:mb-6">
        <div class="flex items-center justify-between mb-4 md:mb-5">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                <h2 class="text-sm md:text-base font-semibold text-slate-800">Detail Peminjaman Aktif Kamu</h2>
            </div>
            <span class="text-xs text-slate-400">Peminjaman Aktif</span>
        </div>
        <div class="space-y-2 md:space-y-3">
            @forelse($peminjamanTerbaru as $item)
                <div
                    class="flex items-center gap-3 md:gap-4 p-2.5 md:p-3 rounded-lg md:rounded-xl hover:bg-slate-50 transition-colors duration-150">
                    <div
                        class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <span
                            class="text-indigo-600 text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs md:text-sm font-medium text-slate-800 truncate">{{ $item->id_peminjaman }}
                        </p>
                        <p class="text-[10px] md:text-xs text-slate-400 truncate">Kembali:
                            {{ $item->tanggal_pengembalian ?? '-' }}</p>
                        @if ($item->detail && $item->detail->count())
                            <p class="text-[10px] md:text-xs text-slate-400 truncate">
                                Barang: {{ $item->detail->pluck('kode_barang')->implode(', ') }}
                            </p>
                        @endif
                    </div>
                    <div class="text-right flex-shrink-0">
                        @if ($item->status_peminjaman === 'dipinjam')
                            <div class="flex flex-col items-end gap-1.5 md:gap-2">
                                <span
                                    class="inline-block text-[10px] md:text-xs px-2 md:px-2.5 py-0.5 md:py-1 rounded-full bg-blue-100 text-blue-600 font-medium">
                                    Dipinjam
                                </span>
                                <button
                                    onclick="konfirmasiKembalikan('{{ $item->id_peminjaman }}', '{{ $item->id_peminjaman }}')"
                                    class="text-[10px] md:text-xs px-2.5 md:px-3 py-1 md:py-1.5 rounded-lg 
                                    bg-green-500 hover:bg-green-600 active:bg-green-700 text-white font-medium 
                                    transition-all duration-200 active:scale-95 shadow-sm hover:shadow flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-3 h-3 md:w-3.5 md:h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Kembalikan
                                </button>
                                <p class="text-[10px] md:text-xs text-slate-400 mt-0.5 hidden md:block">
                                    {{ $item->created_at?->locale('id')->diffForHumans() }}
                                </p>
                            </div>
                        @else
                            <div class="flex flex-col items-end gap-1">
                                <span
                                    class="inline-block text-[10px] md:text-xs px-2 md:px-2.5 py-0.5 md:py-1 rounded-full font-medium
                                {{ $item->status_peminjaman === 'dikembalikan'
                                    ? 'bg-green-100 text-green-600'
                                    : 'bg-yellow-100 text-yellow-600' }}">
                                    {{ ucfirst($item->status_peminjaman) }}
                                </span>
                                <p class="text-[10px] md:text-xs text-slate-400 mt-0.5 hidden md:block">
                                    {{ $item->created_at?->locale('id')->diffForHumans() }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8 md:py-10">
                    <svg class="w-10 h-10 md:w-12 md:h-12 text-slate-200 mx-auto mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-xs md:text-sm text-slate-400">Kamu belum memiliki peminjaman aktif</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- JavaScript untuk Konfirmasi Pengembalian --}}
    <script>
        function konfirmasiKembalikan(id, idPeminjaman) {
            Swal.fire({
                title: 'Kembalikan Barang?',
                html: `
                <div class="text-left">
                    <p class="text-sm text-gray-600 mb-3">Apakah kamu yakin ingin mengembalikan peminjaman:</p>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                        <p class="text-sm font-semibold text-blue-900">
                            ${idPeminjaman}
                        </p>
                    </div>
                    <p class="text-xs text-gray-500">
                        <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                        Status akan berubah menjadi <strong>"Dikembalikan"</strong>
                    </p>
                </div>
            `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '✓ Ya, Kembalikan',
                cancelButtonText: '✕ Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'px-6 py-2.5 rounded-lg font-medium shadow-sm',
                    cancelButton: 'px-6 py-2.5 rounded-lg font-medium'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memproses...',
                        html: '<div class="flex items-center justify-center gap-2"><div class="animate-spin rounded-full h-6 w-6 border-b-2 border-green-500"></div><span>Mengembalikan barang ke sistem</span></div>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Redirect ke route kembalikan
                    window.location.href = `/peminjaman/${id}/back`;
                }
            });
        }
    </script>

    {{-- LOG AKTIVITAS USER - MOBILE OPTIMIZED --}}
    <div class="mb-5 md:mb-6">
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div
                class="bg-gradient-to-r from-indigo-50 to-indigo-100/50 px-4 md:px-5 py-3 md:py-4 border-b border-indigo-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                        <h2 class="text-sm md:text-base font-semibold text-slate-800">Log Aktivitas Kamu</h2>
                    </div>
                    <span class="text-[10px] md:text-xs text-slate-400">Aktivitas terbaru</span>
                </div>
            </div>
            <div class="divide-y divide-slate-100 max-h-80 md:max-h-96 overflow-y-auto">
                @forelse($peminjamanTerbaru as $item)
                    <div
                        class="flex items-center gap-2 md:gap-3 px-4 md:px-5 py-2.5 md:py-3 hover:bg-indigo-50/50 transition-colors">
                        <div
                            class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 flex-shrink-0">
                            <span
                                class="text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs md:text-sm font-medium text-slate-800 truncate">
                                {{ $item->id_peminjaman }}</p>
                            <p class="text-[10px] md:text-xs text-slate-400 truncate">
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
                                class="inline-block text-[10px] md:text-xs px-2 md:px-2.5 py-0.5 md:py-1 rounded-full font-medium
            {{ $item->status_peminjaman === 'dipinjam'
                ? 'bg-blue-100 text-blue-600'
                : ($item->status_peminjaman === 'dikembalikan'
                    ? 'bg-green-100 text-green-600'
                    : 'bg-yellow-100 text-yellow-600') }}">
                                {{ ucfirst($item->status_peminjaman) }}
                            </span>
                            <p class="text-[10px] md:text-xs text-slate-400 mt-0.5 md:mt-1 hidden md:block">
                                {{ $item->created_at?->locale('id')->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-6 md:py-8 text-xs md:text-sm">Belum ada log aktivitas.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- PENGEMBALIAN USER - MOBILE OPTIMIZED --}}
    <div class="mb-5 md:mb-6">
        <div class="bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-gradient-to-r from-green-50 to-green-100/50 px-4 md:px-5 py-3 border-b border-green-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <h2 class="text-sm md:text-base font-semibold text-slate-800">Pengembalian Kamu</h2>
                    </div>
                    <span class="text-xs text-slate-400">Riwayat Pengembalian</span>
                </div>
            </div>
            <div class="divide-y divide-slate-100 max-h-72 md:max-h-80 overflow-y-auto">
                @forelse($peminjamanTerbaru->where('status_peminjaman', 'dikembalikan') as $item)
                    <div
                        class="flex items-center gap-2 md:gap-3 px-4 md:px-5 py-2.5 md:py-3 hover:bg-green-50/50 transition-colors">
                        <div
                            class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                            <span
                                class="text-xs font-bold">{{ strtoupper(substr(auth()->user()->username, 0, 2)) }}</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs md:text-sm font-medium text-slate-800 truncate">
                                {{ $item->id_peminjaman }}</p>
                            <p class="text-[10px] md:text-xs text-slate-400 truncate">Dikembalikan:
                                {{ $item->tanggal_pengembalian ?? '-' }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span
                                class="inline-block text-[10px] md:text-xs px-2 md:px-2.5 py-0.5 md:py-1 rounded-full font-medium bg-green-100 text-green-600">
                                Dikembalikan
                            </span>
                            <p class="text-[10px] md:text-xs text-slate-400 mt-0.5 md:mt-1 hidden md:block">
                                {{ $item->created_at?->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-8 md:py-10 text-xs md:text-sm">Belum ada pengembalian.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- BARANG TERSEDIA & TIDAK TERSEDIA - MOBILE OPTIMIZED --}}
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
                    <div
                        class="flex items-center gap-2 md:gap-3 px-4 md:px-5 py-2.5 hover:bg-green-50/50 transition-colors">
                        <div
                            class="w-7 h-7 md:w-8 md:h-8 rounded-lg bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] md:text-xs font-mono text-slate-400">{{ $barang->kode_barang }}</p>
                            <p class="text-xs md:text-sm font-medium text-slate-800 truncate">
                                {{ $barang->jenis->nama_barang ?? 'Nama tidak tersedia' }}</p>
                        </div>
                        <span
                            class="text-[10px] md:text-xs text-slate-400 flex-shrink-0">{{ ucfirst($barang->kondisi_barang) }}</span>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-8 md:py-10 text-xs md:text-sm">Semua barang sedang
                        dipinjam.</div>
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
                    <div
                        class="flex items-center gap-2 md:gap-3 px-4 md:px-5 py-2.5 hover:bg-red-50/50 transition-colors">
                        <div
                            class="w-7 h-7 md:w-8 md:h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-500 flex-shrink-0">
                            <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] md:text-xs font-mono text-slate-400">{{ $barang->kode_barang }}</p>
                            <p class="text-xs md:text-sm font-medium text-slate-800 truncate">
                                {{ $barang->jenis->nama_barang ?? 'Nama tidak tersedia' }}</p>
                        </div>
                        <span
                            class="text-[10px] md:text-xs px-2 py-0.5 md:py-1 rounded-full bg-red-100 text-red-600 flex-shrink-0 font-medium">
                            Dipinjam
                        </span>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-8 md:py-10 text-xs md:text-sm">Tidak ada barang yang
                        sedang dipinjam.</div>
                @endforelse
            </div>
        </div>
    </div>

</x-layout>
