<x-layout type="signup" title=" Sign up">

    <!-- Tombol Kembali -->
    <a href="/"
        class="fixed top-4 left-4 flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-150 ">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali
    </a>

    <div class="w-full max-w-2xl mx-auto bg-gray-800 border border-gray-700 rounded-2xl shadow-2xl px-8 py-10">

        <!-- Logo -->
        <div class="flex items-center justify-center gap-2.5 mb-8">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center shadow">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20 7l-8-4-8 4m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <span class="font-bold text-white text-lg">InventarisSatoeApp</span>
        </div>

        <!-- Judul -->
        <div class="mb-7">
            <h1 class="text-2xl font-bold text-white">Lengkapi Data Diri</h1>
            <p class="text-sm text-gray-400 mt-1">Isi data anda dengan lengkap</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('register.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4 form-group">
            @csrf
            <!-- Username -->
            <div class="md:col-span-2">
                <label for="username" class="block text-sm font-medium text-gray-300 mb-1.5">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        placeholder="Masukkan username" required autofocus
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-150 {{ $errors->has('username') ? 'border-red-500' : '' }}" />
                </div>
                @error('username')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="md:col-span-2" x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input :type="show ? 'text' : 'password'" id="password" name="password"
                        placeholder="Masukkan password" required
                        class="w-full pl-10 pr-10 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-150 {{ $errors->has('password') ? 'border-red-500' : '' }}" />
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-indigo-400 transition-colors duration-150">
                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2" x-data="{ show: false }">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1.5">Konfirmasi Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input :type="show ? 'text' : 'password'" id="password" name="password_confirmation"
                        placeholder="Masukkan password" required
                        class="w-full pl-10 pr-10 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-150 {{ $errors->has('password') ? 'border-red-500' : '' }}" />
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-indigo-400 transition-colors duration-150">
                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24" style="display:none;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-300 mb-1.5">Role</label>
                <select id="role" name="role" required
                    class="role w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 {{ $errors->has('role') ? 'border-red-500' : '' }}">       
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa
                    </option>
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru
                    </option>
                </select>
                @error('role')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
        
            <x-signup.input class="siswaField hidden" name="nis" max="10" />
            <x-signup.input class="nipField" name="nip" max="10" />
            <x-signup.select class="siswaField hidden"  name="angkatan" :datas="$angkatan"></x-signup.select>
            <x-signup.select class="siswaField hidden"  name="id_jurusan" :datas="$jurusan" field="jurusan"></x-signup.select>
            <x-signup.select class="siswaField hidden"  name="subkelas">
                <option value="A">A</option>
                <option value="B">B</option>
            </x-signup.select>
            <x-signup.input class="siswaField hidden"  name="no_absen" max="2" />
            <x-signup.input  name="nama" max="60" />
            
            
            
            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-300 mb-1.5">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required
                    class="w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-white focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 {{ $errors->has('jenis_kelamin') ? 'border-red-500' : '' }}">
                    <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                    </option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                    </option>
                </select>
                @error('jenis_kelamin')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>
         
            <x-signup.input type="email" name="email" max="255" />
            <x-signup.input name="no_kontak" max="13" />
            <x-signup.input class="md:col-span-2" name="alamat" max="255" />
            
            <!-- Tombol -->
            <button type="submit"
                class="md:col-span-2 w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold rounded-lg shadow-sm transition-all duration-150 hover:shadow-lg hover:shadow-indigo-500/20 active:scale-[0.99]">
                Simpan Data
            </button>

            @if (session('error'))
                <div class="p-3 bg-red-500/10 border border-red-500/30 rounded-lg">
                    <p class="text-xs text-red-400 text-center">{{ session('error') }}</p>
                </div>
            @endif

        </form>

        <p class="mt-6 text-center text-xs text-gray-600">© {{ date('Y') }} InventarisSatoeApp</p>

    </div>

</x-layout>





