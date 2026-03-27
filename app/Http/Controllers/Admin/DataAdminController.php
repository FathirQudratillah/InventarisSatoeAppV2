<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataAdmin;
use app\models\DataAkun;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DataAdminController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        $bulan = now()->format('m');
        $tahun = now()->format('Y');
        $admins = DataAdmin::All();
        return view('data-admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = DataAkun::all();
        return view('data-admin.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = new DataAdmin;
        $admin->nip = $request->nip;
        $admin->user_id = $request->user_id;
        $admin->nama = $request->nama;
        $admin->email = $request->email;
        $admin->no_kontak = $request->no_kontak;
        $admin->alamat = $request->alamat;
        $admin->save();

        return redirect('data-admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nip)
    {
        $admin = DataAdmin::findOrFail($nip);
        $user_id = DataAkun::all();
        return view('data-admin.edit', compact('admin', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        $admin = DataAdmin::find($nip);
        $admin->delete();
        return redirect()->route('data-admin.index');
    }
}
