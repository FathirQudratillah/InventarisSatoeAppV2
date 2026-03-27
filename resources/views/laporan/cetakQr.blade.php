<x-layout type="dashboard" title="Cetak Qr">

    <div class="max-w-3xl mx-auto mt-8">
        <div class="bg-white shadow-xl rounded-2xl p-8">

            <!-- Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    Cetak Qr
                </h1>
                <p class="text-gray-500 mt-1">
                    Silakan pilih barang yang ingin di cetak.
                </p>
            </div>

            <form action="{{ route('cetakQrPdf') }}" method="POST">
                @csrf
                <div class="mb-4 ">
                    <label class="flex items-center gap-2 cursor-pointer font-medium">
                        <input type="checkbox" id="selectAll" class="w-4 h-4">
                        <span>Pilih Semua</span>
                    </label>
                </div>

                <div class="grid md:grid-cols-3 gap-3 mb-4">
                    @foreach ($barangs as $barang)
                        <label class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 cursor-pointer">

                            <input type="checkbox" name="barang_ids[]" value="{{ $barang->kode_barang }}"
                                class="barang-checkbox w-4 h-4">

                            <span class="text-sm leading-none">
                                {{ $barang->kode_barang }}
                            </span>

                        </label>
                    @endforeach
                </div>

                <x-back-button href="{{ route('data-barang.index') }}"></x-back-button>

            </form>

        </div>
    </div>
    <script>
    document.getElementById('selectAll').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.barang-checkbox');
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

</x-layout>
