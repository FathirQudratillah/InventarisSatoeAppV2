<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Peminjaman Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #111;
            padding: 20px 24px;
        }

        /* KOP */
        .kop {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #111;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .kop-logo {
            width: 65px;
            margin-right: 12px;
        }

        .kop-text {
            text-align: center;
            flex: 1;
            line-height: 1.5;
        }

        .kop-text .instansi {
            font-size: 9px;
            text-transform: uppercase;
        }

        .kop-text .nama-sekolah {
            font-size: 17px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .kop-text .alamat {
            font-size: 8.5px;
        }

        /* JUDUL */
        .judul {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin: 12px 0 4px 0;
        }

        .periode {
            text-align: center;
            font-size: 11px;
            margin-bottom: 12px;
        }

        /* TABEL */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5px;
        }

        .kop {
            border-bottom: 3px solid #111;
            padding-bottom: 8px;
            margin-bottom: 12px;
            text-align: center;
        }

        .kop-logo {
            width: 65px;
            display: block;
            margin: 0 auto 6px auto;
        }

        .kop-text {
            text-align: center;
            line-height: 1.5;
        }

        th {
            background: #f0f0f0;
            border: 1px solid #333;
            padding: 4px 5px;
            text-align: center;
            font-weight: bold;
        }

        td {
            border: 1px solid #333;
            padding: 4px 5px;
            vertical-align: middle;
            text-align: center;
        }

        td.left {
            text-align: left;
        }

        td.ttd {
            height: 28px;
        }

        /* SUMMARY */
        .summary {
            margin-top: 12px;
            font-size: 11px;
            font-weight: bold;
        }

        /* TANDA TANGAN */
        .signature {
            margin-top: 40px;
            text-align: right;
            margin-right: 30px;
            font-size: 11px;
            line-height: 1.6;
        }

        /* NO DATA */
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <div class="kop">
        <div class="kop-text">
            <img src="{{ public_path('images/logo-smk.png') }}" class="kop-logo">
            <div class="instansi">Pemerintah Daerah Provinsi Jawa Barat</div>
            <div class="instansi">Dinas Pendidikan</div>
            <div class="instansi">Cabang Dinas Pendidikan Wilayah III</div>
            <div class="nama-sekolah">SMK Negeri 1 Kota Bekasi</div>
            <div class="alamat">Jln. Bintara VIII No. 2 Kec. Bekasi Barat Kota Bekasi 17134 Tlp/Fax : (021) 88951151
            </div>
            <div class="alamat">Website : http://www.smkn1kotabekasi.sch.id &nbsp; Email : info@smkn1kotabekasi.sch.id
            </div>
        </div>
    </div>

    {{-- JUDUL --}}
    <div class="judul">Data Peminjaman Barang</div>
    <div class="periode">Periode {{ $namaBulan }} {{ $tahun }}</div>

    @if ($data->count() > 0)

        <table>
            <thead>
                <tr>
                    <th rowspan="2" width="5%">No</th>
                    <th rowspan="2" width="8%">ID Peminjaman</th>
                    <th rowspan="2" width="15%">Nama Peminjam</th>
                    <th rowspan="2" width="25%">Barang yang Dipinjam</th>
                    <th colspan="2" width="20%">Tanggal</th>
                    <th rowspan="2" width="12%">Status</th>
                    <th rowspan="2" width="15%">Tanda Tangan</th>
                </tr>
                <tr>
                    <th width="10%">Peminjaman</th>
                    <th width="10%">Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $jumlahData = $data->count();
                    $minimalBaris = 15;
                    $totalBaris = max($jumlahData, $minimalBaris);
                @endphp

                @for ($i = 0; $i < $totalBaris; $i++)
                    <tr>
                        <td>{{ $i + 1 }}</td>

                        @if ($i < $jumlahData)
                            <td>{{ $data[$i]->id_peminjaman }}</td>

                            <td class="center">
                                {{ $data[$i]->user_id }}
                            </td>

                            <td class="center">
                                @forelse ($data[$i]->detail as $detail)
                                    {{ $detail->barang->dataBarang->nama_barang ?? $detail->kode_barang }}<br>
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($data[$i]->tanggal_peminjaman)->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($data[$i]->tanggal_pengembalian)->format('d/m/Y') }}
                            </td>

                            <td>
                                {{ $data[$i]->status_peminjaman }}
                            </td>

                            <td class="ttd"></td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="ttd"></td>
                        @endif
                    </tr>
                @endfor
            </tbody>
        </table>

        {{-- SUMMARY --}}
        <div class="summary">
            Total Transaksi: {{ $data->count() }}
        </div>

        {{-- TANDA TANGAN --}}
        <div class="signature">
            <p>Bekasi, {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
            <p>Mengetahui,</p>
            <br><br><br>
            <p>______________________</p>
            <p>Petugas Inventaris</p>
        </div>
    @else
        <div class="no-data">
            Tidak ada data peminjaman pada periode {{ $namaBulan }} {{ $tahun }}
        </div>
    @endif

</body>

</html>
