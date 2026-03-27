<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DataAkun;
use App\Models\DataAngkatan;
use App\Models\DataJurusan;
use App\Models\DataKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DataAkunController extends Controller
{
    protected $middleware = [
        'role:admin' => [
            'only' => ['show', 'index', 'destroy', 'store']
        ],
    ];

    public function index()
    {
        $akuns = DataAkun::All();
        return view('data-akun.index', compact('akuns'));
    }

    public function create()
    {
        $angkatan = DataAngkatan::all();
        $jurusan = DataJurusan::all();
        return view('signup.index', compact('angkatan', 'jurusan'));
    }


    public function show($id)
    {
        $prefix = substr($id, 0, 2);

        $roles = [
            'SI' => 'siswa',
            'GU' => 'guru',
            'AD' => 'admin',
        ];

        $role = $roles[$prefix] ?? 'admin';

        $akun = DataAkun::with($role)->findOrFail($id);

        return view('data-akun.show', compact('akun', 'role'));
    }


    public function store(Request $request): RedirectResponse
    {
        
            // Validasi input
            $request->validate([
                'role' => 'required|in:siswa,guru',
                'username' => 'required|unique:data_akuns,username|max:255',
                'password' => 'required|min:6|confirmed',
                'nama' => 'required|max:255',
                'email' => 'required|email|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'no_kontak' => 'required|max:15',
                'alamat' => 'required',
                // Validasi khusus untuk siswa
                'nis' => 'required_if:role,siswa|max:10',
                'angkatan' => 'required_if:role,siswa',
                'id_jurusan' => 'required_if:role,siswa',
                'subkelas' => 'required_if:role,siswa',
                'no_absen' => 'required_if:role,siswa|integer',
                // Validasi khusus untuk guru
                'nip' => 'required_if:role,guru|max:20|exist:data_guru,nip',
            ]);

        try {

            $role = $request->role;

            // Hitung nomor urut berdasarkan role
            $lastUser = DataAkun::where('role', $role)
                ->orderBy('user_id', 'desc')
                ->first();

            $lastNumber = $lastUser ? (int) substr($lastUser->user_id, -8) : 0;

            $kode = str_pad($lastNumber + 1, 8, '0', STR_PAD_LEFT);

            // Validasi kelas untuk siswa
            if ($role === 'siswa') {
                $kelas = $request->angkatan . $request->id_jurusan . $request->subkelas;
                $checkKelas = DataKelas::findOrFail($kelas);
                $no_absen = str_pad($request->no_absen, 2, '0', STR_PAD_LEFT);
            }

            DB::transaction(function () use ($request, $role, $checkKelas, $no_absen, $kode) {
                // Generate user_id
                if ($role === 'siswa') {
                    $user_id = 'SI' . $checkKelas->id_kelas . $no_absen;
                } else {
                    $user_id = 'GU' . $kode;
                }

                $akun = DataAkun::create([
                    'user_id' => $user_id,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role' => $role,
                ]);

                // Simpan detail berdasarkan role
                if ($role === 'siswa') {
                    $akun->siswa()->create([
                        'user_id' => $akun->user_id,
                        'nis' => $request->nis,
                        'id_kelas' => $checkKelas->id_kelas,
                        'no_absen' => $no_absen,
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'no_kontak' => $request->no_kontak,
                        'alamat' => $request->alamat,
                    ]);
                } elseif ($role === 'guru') {
                    $akun->guru()->create([
                        'user_id' => $akun->user_id,
                        'nip' => $request->nip,
                        'nama' => $request->nama,
                        'email' => $request->email,
                        'jenis_kelamin' => $request->jenis_kelamin,
                        'no_kontak' => $request->no_kontak,
                        'alamat' => $request->alamat,
                    ]);
                }
            });

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan akun!')->withInput();
        }
    }



    public function destroy($user_id)
    {
        try {
            $akun = DataAkun::findOrFail($user_id);
            $akun->delete();
            return redirect()->route('data-akun.index')->with('success', 'Akun berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus akun!');
        }
    }

    public function edit()
    {
        $user_id = auth()->user();
        $role = auth()->user()->role;
        $akun = DataAkun::findOrFail($user_id->user_id);
        return view('data-akun.edit', compact('akun', 'user_id', 'role'));
    }

    public function update(Request $request)
    {
        try {
            $id = auth()->user()->user_id;
            $akun = DataAkun::findOrFail($id);
            $role = auth()->user()->role;

            $validated = $request->validate([
                'nis' => 'required|max:10',
                'nama' => 'required|max:255',
                'email' => 'required|email|max:255',
                'jenis_kelamin' => 'required|in:L,P',
                'no_kontak' => 'required|max:15',
                'alamat' => 'required',
            ]);

            $akun->$role()->update([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'email' => $request->email,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_kontak' => $request->no_kontak,
                'alamat' => $request->alamat,
            ]);

            return redirect()->route('detail')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data!')->withInput();
        }
    }

    public function ubah()
    {
        $user_id = auth()->user();
        $akun = DataAkun::findOrFail($user_id->user_id);
        return view('data-akun.ubah-password', compact('akun'));
    }

    public function ubahPassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'min:6', 'confirmed'],
            ]);

            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('detail')->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah password!');
        }
    }
}
