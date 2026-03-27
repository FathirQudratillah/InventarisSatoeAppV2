<x-layout>
    <br class="hidden md:block">
    <x-slot:title>Detail {{ $akun->$role?->nama ?? 'Akun' }}</x-slot:title>
    <a href="{{ url()->previous() }}"
        class="fixed top-4 right-4 flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-150 ">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali
    </a>
    <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex justify-between items-center">
        
            <table class="w-full text-sm text-gray-700">
                <tbody class="divide-y divide-gray-100">

                    <tr class="py-2">
                        <td class="py-2 font-semibold w-40">User ID</td>
                        <td class="py-2 w-4">:</td>
                        <td class="py-2">{{ $akun->user_id }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-semibold">Username</td>
                        <td>:</td>
                        <td>{{ $akun->username }}</td>
                    </tr>
                    
                    @php
                        $label = $role === 'siswa' ? 'NIS' : ($role === 'guru' ? 'NIP' : null);
                    @endphp
                    @if($label)
                    <tr>
                        <td class="py-2 font-semibold">{{ $label }}</td>
                        <td>:</td>
                        <td>{{ $akun->$role?->nis ?? $akun->$role?->nip ?? '-' }}</td>
                    </tr>
                    @endif

                    @if($role == 'siswa')
                    @php
                        $kelas = $akun->siswa->id_kelas;

                        $angkatan = substr($kelas, 0, 2);
                        $jurusan = substr($kelas, 2, 3);
                        $subkelas = substr($kelas, -1);

                        $romawi = [
                            '27' => 'XII',
                            '28' => 'XI',
                            '29' => 'X',
                        ];

                        $kelasFormat = ($romawi[$angkatan] ?? $angkatan) . '-' . $jurusan . '-' . $subkelas
                    @endphp
                    <tr>
                        <td class="py-2 font-semibold">Kelas</td>
                        <td>:</td>
                        <td>{{ $kelasFormat }}</td>
                    </tr>
                    @endif

                    <tr>
                        <td class="py-2 font-semibold">Nama</td>
                        <td>:</td>
                        <td>{{ $akun->$role?->nama ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-semibold">Email</td>
                        <td>:</td>
                        <td>{{ $akun->$role?->email ?? '-' }}</td>
                    </tr>

                    @if ($label)
                        
                    <tr>
                        <td class="py-2 font-semibold">Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $akun->$role?->jenis_kelamin ?? '-' }}</td>
                    </tr>
                    @endif

                    <tr>
                        <td class="py-2 font-semibold">No Kontak</td>
                        <td>:</td>
                        <td>{{ $akun->$role?->no_kontak ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-semibold">Alamat</td>
                        <td>:</td>
                        <td>{{ $akun->$role?->alamat ?? '-' }}</td>
                    </tr>

                </tbody>
            </table>
        



    </div>




</x-layout>
