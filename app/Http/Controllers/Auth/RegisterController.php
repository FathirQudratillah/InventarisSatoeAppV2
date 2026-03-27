<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DataAkun;
use App\Models\DataAngkatan;
use App\Models\DataJurusan;
use App\Models\DataKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $angkatan = DataAngkatan::all();
        $jurusan = DataJurusan::all();
        return view('signup.index', compact('angkatan', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => ['required', Rule::in(['siswa', 'guru'])],

            'username' => 'required|string|max:50|unique:data_akun,username',
            'password' => 'required|string|min:6|confirmed',

            // ====== KHUSUS SISWA ======
            'nis' => 'required_if:role,siswa|nullable|unique:data_siswa,nis',
            'angkatan' => 'required_if:role,siswa',
            'id_jurusan' => 'required_if:role,siswa',
            'subkelas' => 'required_if:role,siswa',
            'no_absen' => 'required_if:role,siswa|integer|min:1|max:99',

            // ====== KHUSUS GURU ======
            'nip' => 'required_if:role,guru|nullable|unique:data_guru,nip',

            // ====== UMUM ======
            'nama' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'no_kontak' => 'required|string|min:10|max:13',
            'alamat' => 'required|string|max:255',

        ], [
            'role.required' => 'Role wajib dipilih.',

            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',

            // Siswa
            'nis.required_if' => 'NIS wajib diisi untuk siswa.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'angkatan.required_if' => 'Angkatan wajib dipilih.',
            'id_jurusan.required_if' => 'Jurusan wajib dipilih.',
            'subkelas.required_if' => 'Subkelas wajib dipilih.',
            'no_absen.required_if' => 'No absen wajib diisi.',
            'no_absen.string' => 'No absen harus berupa angka.',

            // Guru
            'nip.required_if' => 'NIP wajib diisi untuk guru.',
            'nip.unique' => 'NIP sudah terdaftar.',

            // Umum
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'no_kontak.required' => 'No kontak wajib diisi.',
            'no_kontak.Integer' => 'No kontak harus berupa angka.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        try {
            $role = $request->role;

            // Hitung nomor urut berdasarkan role
            $lastUser = DataAkun::where('role', $role)
                ->orderBy('user_id', 'desc')
                ->first();

            $lastNumber = $lastUser ? (int) substr($lastUser->user_id, -8) : 0;

            $kode = str_pad($lastNumber + 1, 8, '0', STR_PAD_LEFT);




            DB::transaction(function () use ($request, $role, $kode) {
                // Generate user_id
                if ($role === 'siswa') {
                    $kelas = $request->angkatan . $request->id_jurusan . $request->subkelas;
                    $checkKelas = DataKelas::findOrFail($kelas);
                    $no_absen = str_pad($request->no_absen, 2, '0', STR_PAD_LEFT);
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

            return redirect()->route('login')->with('success', 'Registrasi Berhasil, Silahkan Login!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan regitrasi')->withInput();
        }
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
