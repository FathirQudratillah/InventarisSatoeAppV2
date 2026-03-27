<x-layout>
    <x-slot:title>Detail  {{ auth()->user()->$role?->nama ?? 'Akun'}}</x-slot:title>
    <a href="{{ url()->previous() }}"
        class="fixed top-4 right-4 flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-150 ">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <p class="hidden md:block">Kembali</p>
    </a>
    <div class="mt-4 p-3 md:p-6 bg-white rounded-lg shadow-md flex flex-col gap-4">
        
            <table class="w-full text-sm text-gray-700">
                <tbody class="divide-y divide-gray-100">

                    <tr class="py-2">
                        <td class="py-2 font-semibold w-40">User ID</td>
                        <td class="py-2 w-4">:</td>
                        <td class="py-2">{{ auth()->user()->user_id }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-semibold">Username</td>
                        <td>:</td>
                        <td>{{ auth()->user()->username }}</td>
                    </tr>
                    
                    @php
                        $label = $role === 'siswa' ? 'NIS' : ($role === 'guru' ? 'NIP' : null);
                    @endphp
                    @if($label)
                    <tr>
                        <td class="py-2 font-semibold">{{ $label }}</td>
                        <td>:</td>
                        <td>{{ auth()->user()->$role?->nis ?? auth()->user()->$role?->nip ?? '-' }}</td>
                    </tr>
                    @endif

                    @if($role == 'siswa')
                    @php
                        $kelas = auth()->user()->siswa->id_kelas;

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
                        <td>{{ auth()->user()->$role?->nama ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-semibold">Email</td>
                        <td>:</td>
                        <td>{{ auth()->user()->$role?->email ?? '-' }}</td>
                    </tr>

                    @if ($label)
                        
                    <tr>
                        <td class="py-2 font-semibold">Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ auth()->user()->$role?->jenis_kelamin ?? '-' }}</td>
                    </tr>
                    @endif

                    <tr>
                        <td class="py-2 font-semibold">No Kontak</td>
                        <td>:</td>
                        <td>{{ auth()->user()->$role?->no_kontak ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td class="py-2 font-semibold">Alamat</td>
                        <td>:</td>
                        <td>{{ auth()->user()->$role?->alamat ?? '-' }}</td>
                    </tr>

                </tbody>
            </table>
            
            <div class="flex gap-3 justify-between">
                     <a href="{{ route('data-akun.edit', 1) }}"
                         class="w-20 mt-5 flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-150 ">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                             <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                         </svg>
         
                         Edit
                     </a>
                 <a href="{{ route('ubah') }}"
                         class="mt-5 flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-150 ">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                         </svg>
         
         
                         Ubah Password
                     </a>
             </div>
   </div>


</x-layout>
