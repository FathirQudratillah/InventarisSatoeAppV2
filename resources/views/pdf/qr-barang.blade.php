<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    @page {
        margin: 10mm;
    }

    body {
        font-family: sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        width: 25%; /* 4 kolom */
        text-align: center;
        padding: 5mm 0;
    }

    .qr {
        width: 4cm;
        height: 4cm;
    }

    .kode {
        font-size: 10px;
        margin-top: 3px;
    }
</style>
</head>
<body>

<table>
    <tr>
    @foreach($barangs as $index => $barang)

        <td>
            <img class="qr" src="data:image/png;base64,{{ $barang->qr }}">
            <div class="kode">{{ $barang->kode_barang }}</div>
        </td>

        {{-- setiap 4 item, tutup row --}}
        @if(($index + 1) % 4 == 0)
            </tr><tr>
        @endif

    @endforeach
    </tr>
</table>

</body>
</html>