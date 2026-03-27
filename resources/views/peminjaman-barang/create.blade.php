<x-form action="{{ route('user.peminjaman-barang.store') }}">
    <x-slot:title>
        Peminjaman Barang
    </x-slot:title>

    <div class="md:col-span-2 " id="barang-wrapper">
        <div class="barang-item">

            <div class="flex justify-between items-center mb-2">
                <label class="block text-sm font-semibold text-gray-700 ">
                    Kode Barang
                </label>
                <div class="flex gap-2 md:hidden">

                    <button type="button"
                        class="openScan bg-orange-400 hover:bg-orange-500
                                text-white w-7 h-7 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">

                            <!-- Frame -->
                            <path d="M4 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M20 7V5a2 2 0 0 0-2-2h-2" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h2" />
                            <path d="M20 17v2a2 2 0 0 1-2 2h-2" />

                            <!-- Scan line -->
                            <line x1="4" y1="12" x2="20" y2="12" />
                        </svg>
                    </button>
                    <button type="button"
                        class="tambah bg-indigo-500 hover:bg-indigo-600
                            text-white w-7 h-7 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="w-4 h-4 pointer-events-none">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                    </button>
                </div>

            </div>
            <div class="relative flex items-center gap-2">
                <input type="text" name="kode_barang[]" placeholder="Masukkan Kode Barang"
                    class="kode-barang flex-1 px-4 py-3 border rounded-xl
                            focus:ring-2 transition outline-none">

                <button type="button"
                    class="openScan bg-orange-400 hover:bg-orange-500 hidden md:flex gap-2
                                text-white w-10 h-10 rounded-lg  items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">

                        <!-- Frame -->
                        <path d="M4 7V5a2 2 0 0 1 2-2h2" />
                        <path d="M20 7V5a2 2 0 0 0-2-2h-2" />
                        <path d="M4 17v2a2 2 0 0 0 2 2h2" />
                        <path d="M20 17v2a2 2 0 0 1-2 2h-2" />

                        <!-- Scan line -->
                        <line x1="4" y1="12" x2="20" y2="12" />
                    </svg>
                </button>
                <button type="button"
                    class="tambah bg-indigo-500 hover:bg-indigo-600 hidden md:flex gap-2
                            text-white w-10 h-10 rounded-lg  items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4 pointer-events-none">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                </button>


            </div>

            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal!',
                            html: '<ul style="text-align: left;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                            showConfirmButton: true,
                            confirmButtonColor: '#ef4444'
                        });
                    });
                </script>
            @endif
        </div>

    </div>



    <div id="scanModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl p-4 w-[360px]">
            <div class="flex justify-between items-center mb-2">
                <h2 class="font-bold">Scan QR Barang</h2>
                <button type="button" id="closeScan" class="text-red-500 text-xl">&times;</button>
            </div>

            <div id="reader" class="w-full h-[300px] border rounded"></div>
        </div>
    </div>






    <x-input name="tanggal_peminjaman" type="date" :value="date('Y-m-d')" />
    <x-input name="tanggal_pengembalian" type="date" :value="date('Y-m-d')" />

    <x-slot:button>
        <x-back-button :href="route('dashboard.user')"></x-back-button>
    </x-slot:button>
</x-form>



<script>
    let qr;
    let scanning = false;
    let activeInput = null;

    const modal = document.getElementById('scanModal');
    const closeBtn = document.getElementById('closeScan');

    document.addEventListener('click', function(e) {
        const scanBtn = e.target.closest('.openScan');
        if (!scanBtn) return;

        activeInput = scanBtn.closest('.barang-item').querySelector('.kode-barang');
        bukaScanner();
    });

    function bukaScanner() {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (!scanning) {
            qr = new Html5Qrcode("reader");
            scanning = true;

            qr.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText) => {
                    if (activeInput) {
                        activeInput.value = decodedText;
                    }
                    stopScan();
                }
            );
        }
    }

    closeBtn.onclick = stopScan;

    function stopScan() {
        if (qr) {
            qr.stop().then(() => {
                qr.clear();
                scanning = false;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        }
    }

    let index = 1;

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('hapus')) {
            e.target.closest('.barang-item').remove();
        }
        if (e.target.classList.contains('tambah')) {

            let html = `
        <div class="barang-item">

            <div class="flex justify-between items-center mt-2 mb-2">
                <label class="block text-sm font-semibold text-gray-700 ">
                    Kode Barang
                </label>
                <div class="flex gap-2 md:hidden">
    
                    <button type="button"
                        class="openScan bg-orange-400 hover:bg-orange-500
                                text-white w-7 h-7 rounded-md flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4">
        
                            <!-- Frame -->
                            <path d="M4 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M20 7V5a2 2 0 0 0-2-2h-2" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h2" />
                            <path d="M20 17v2a2 2 0 0 1-2 2h-2" />
        
                            <!-- Scan line -->
                            <line x1="4" y1="12" x2="20" y2="12" />
                        </svg>
                    </button>
                    <button type="button"
                        class="hapus bg-red-500 hover:bg-red-600
                            text-white w-7 h-7 rounded-md flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>
                </div>
    
            </div>
            <div class="relative flex items-center gap-2">
                <input type="text" name="kode_barang[]" placeholder="Masukkan Kode Barang"
                    class="kode-barang flex-1 px-4 py-3 border rounded-xl
                            focus:ring-2 transition outline-none">
    
                    <button type="button"
                        class="openScan bg-orange-400 hover:bg-orange-500 hidden md:flex gap-2
                                text-white w-10 h-10 rounded-lg  items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
        
                            <!-- Frame -->
                            <path d="M4 7V5a2 2 0 0 1 2-2h2" />
                            <path d="M20 7V5a2 2 0 0 0-2-2h-2" />
                            <path d="M4 17v2a2 2 0 0 0 2 2h2" />
                            <path d="M20 17v2a2 2 0 0 1-2 2h-2" />
        
                            <!-- Scan line -->
                            <line x1="4" y1="12" x2="20" y2="12" />
                        </svg>
                    </button>
                    <button type="button"
                        class="hapus bg-red-500 hover:bg-red-600 hidden md:flex gap-2
                            text-white w-10 h-10 rounded-lg  items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>

                    </button>
                
                
            </div>
    
            @error('kode_barang[]')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        
    `;

            document.getElementById('barang-wrapper')
                .insertAdjacentHTML('beforeend', html);
        }
    });
</script>
