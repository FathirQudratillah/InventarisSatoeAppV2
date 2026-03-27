<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DetailPeminjaman;


class DetailPeminjamanController extends Controller
{
    public function index()
    {
        $detailPeminjamans = DetailPeminjaman::All();
        return view('detail-peminjaman.index', compact('detailPeminjamans'));
    }

    
}
