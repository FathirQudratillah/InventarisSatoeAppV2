<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Kartu Pemeliharaan Barang</title>

    <style>
        @page {
            size: A4;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #111;
        }

        /* ================= KOP ================= */
        .kop {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 6px;
            margin-bottom: 10px;
        }

        .kop-logo {
            width: 60px;
            margin-bottom: 5px;
        }

        .kop-text {
            line-height: 1.2;
        }

        .kop-text .instansi {
            font-size: 8px;
            text-transform: uppercase;
        }

        .kop-text .nama-sekolah {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 3px 0;
        }

        .kop-text .alamat {
            font-size: 8px;
        }

        /* ================= INFO BARANG ================= */
        .info-section {
            margin: 12px 0;
            font-size: 10px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .info-label {
            display: table-cell;
            width: 120px;
            font-weight: bold;
        }

        .info-value {
            display: table-cell;
            width: 20px;
            text-align: center;
        }

        .info-content {
            display: table-cell;
        }

        /* ================= TABEL PEMELIHARAAN ================= */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: middle;
        }

        th {
            background: #f5f5f5;
            text-align: center;
            font-weight: bold;
            font-size: 9px;
        }

        td.center {
            text-align: center;
        }

        td.paraf {
            height: 28px;
        }

        tbody tr {
            height: 28px;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>

    @if ($data)
        {{-- CETAK PER BARANG - HANYA 1 HALAMAN --}}

        {{-- KOP --}}
        <div class="kop">
            <img src="{{ public_path('images/logo-smk.png') }}" class="kop-logo">
            <div class="kop-text">
                <div class="instansi">Pemerintah Daerah Provinsi Jawa Barat</div>
                <div class="instansi">Dinas Pendidikan</div>
                <div class="instansi">Cabang Dinas Pendidikan Wilayah III</div>
                <div class="nama-sekolah">SMK Negeri 1 Kota Bekasi</div>
                <div class="alamat">
                    Jln. Bintara VIII No. 2 Kec. Bekasi Barat Kota Bekasi 17134 Tlp/Fax : (021) 88951151
                </div>
                <div class="alamat">
                    Website : http://www.smkn1kotabekasi.sch.id Email : info@smkn1kotabekasi.sch.id
                </div>
            </div>
        </div>

        {{-- INFO BARANG --}}
        <div class="info-section">
            <div class="info-row">
                <span class="info-label">Nama Alat</span>
                <span class="info-value">:</span>
                <span class="info-content">{{ $dataFirst->barang[0]->jenis->nama_barang  ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kode Barang</span>
                <span class="info-value">:</span>
                <span class="info-content">{{ $dataFirst->barang[0]->kode_barang ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Spesifikasi</span>
                <span class="info-value">:</span>
                <span class="info-content">{{ $dataFirst->barang[0]->jenis->spesifikasi  ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Ruang</span>
                <span class="info-value">:</span>
                <span class="info-content">{{ $dataFirst->barang[0]->id_ruang ?? '-' }}</span>
            </div>
        </div>

        {{-- TABEL PEMELIHARAAN - MAKSIMAL 15 BARIS --}}
        <table>
            <thead>
                <tr>
                    <th rowspan="2" width="5%">No</th>
                    <th rowspan="2" width="15%">Hari/Tanggal</th>
                    <th rowspan="2" width="35%">Kegiatan Pemeliharaan</th>
                    <th colspan="2" width="30%">Pelaksana</th>
                    <th rowspan="2" width="15%">Keterangan</th>
                </tr>
                <tr>
                    <th width="15%">Nama</th>
                    <th width="15%">Paraf</th>
                </tr>
            </thead>

            <tbody>
                @php
                    $barisPerHalaman = 15;
                    $jumlahData = $data->count();
                @endphp

                @for ($i = 0; $i < $barisPerHalaman; $i++)
                    <tr>
                        <td class="center">{{ $i + 1 }}</td>

                        @if ($i < $jumlahData && isset($data[$i]))
                            <td class="center">
                                {{ \Carbon\Carbon::parse($data[$i]->tanggal_pemeliharaan)->translatedFormat('l, d/m/Y') }}
                            </td>
                            <td>{{ $data[$i]->kegiatan_pemeliharaan }}</td>
                            <td>{{ $data[$i]->penanggungjawab->nama ?? '-' }}</td>
                            <td class="paraf"></td>
                            <td>{{ $data[$i]->keterangan }}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="paraf"></td>
                            <td></td>
                        @endif
                    </tr>
                @endfor
            </tbody>
        </table>
    @else
        {{-- KOP --}}
        <div class="kop">
            <img src="{{ public_path('images/logo-smk.png') }}" class="kop-logo">
            <div class="kop-text">
                <div class="instansi">Pemerintah Daerah Provinsi Jawa Barat</div>
                <div class="instansi">Dinas Pendidikan</div>
                <div class="instansi">Cabang Dinas Pendidikan Wilayah III</div>
                <div class="nama-sekolah">SMK Negeri 1 Kota Bekasi</div>
                <div class="alamat">Jl. Bintara VIII No. 2 Bekasi Barat Kota Bekasi 17134</div>
            </div>
        </div>

        <div
            style="text-align: center; font-size: 13px; font-weight: bold; margin: 15px 0; text-decoration: underline;">
            LAPORAN PEMELIHARAAN BARANG
        </div>
        <div style="text-align: center; font-size: 10px; margin-bottom: 15px;">
            Periode {{ $namaBulan }} {{ $tahun }}
        </div>

        @php
            $barisPerHalaman = 15;
            $jumlahData = $data->count();
        @endphp

        @if ($jumlahData > 0)
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">Tanggal</th>
                        <th width="12%">Kode Barang</th>
                        <th width="20%">Nama Barang</th>
                        <th width="25%">Kegiatan</th>
                        <th width="13%">Penanggung Jawab</th>
                        <th width="7%">Paraf</th>
                        <th width="6%">Ket</th>
                    </tr>
                </thead>

                <tbody>
                    @for ($i = 0; $i < $barisPerHalaman; $i++)
                        <tr>
                            <td class="center">{{ $i + 1 }}</td>

                            @if ($i < $jumlahData && isset($data[$i]))
                                <td class="center">
                                    {{ \Carbon\Carbon::parse($data[$i]->tanggal_pemeliharaan)->format('d/m/Y') }}
                                </td>
                                <td class="center">{{ $data[$i]->kode_barang }}</td>
                                <td class="center">{{ $data[$i]->barang->nama_barang ?? '-' }}</td>
                                <td class="center">{{ $data[$i]->kegiatan_pemeliharaan }}</td>
                                <td class="center">{{ $data[$i]->penanggungjawab->nama ?? '-' }}</td>
                                <td class="paraf"></td>
                                <td>{{ $data[$i]->keterangan }}</td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="paraf"></td>
                                <td></td>
                            @endif
                        </tr>
                    @endfor
                </tbody>
            </table>

            <div style="margin-top: 12px; font-size: 10px; font-weight: bold;">
                Total Pemeliharaan: {{ $data->count() }} kegiatan |
                Jumlah Barang: {{ $data->groupBy('kode_barang')->count() }} unit
            </div>

            <div
                style="margin-top: 40px; width: 220px; margin-left: auto; text-align: center; font-size: 10px; line-height: 1.5;">
                Bekasi, {{ now()->locale('id')->translatedFormat('d F Y') }}<br>
                Mengetahui,<br><br><br><br>
                ______________________<br>
                Petugas Inventaris
            </div>
        @else
            <div class="no-data">
                Tidak ada data pemeliharaan pada periode {{ $namaBulan }} {{ $tahun }}
            </div>
        @endif

    @endif

</body>

</html>
