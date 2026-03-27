    <x-layout>
    <x-slot:title>Tambah Data Admin</x-slot:title>

    <div class="max-w-3xl mx-auto mt-8">
        <div class="bg-white shadow-xl rounded-2xl p-8">

            <!-- Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">
                    Tambah Data Admin
                </h1>
                <p class="text-gray-500 mt-1">
                    Silakan isi informasi akun dengan lengkap dan benar.
                </p>
            </div>

            <form action="{{ route('data-akun.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    <!-- User ID -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            User ID
                        </label>
                        <input type="text"
                               name="user_id"
                               value="{{ old('user_id') }}"
                               placeholder="Contoh: ADM001"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                      transition duration-200 outline-none"
                               required>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Username
                        </label>
                        <input type="text"
                               name="username"
                               value="{{ old('username') }}"
                               placeholder="Masukkan username"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                      transition duration-200 outline-none"
                               required>
                        @error('username')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="text"
                        name="Nama"
                         value="{{ old('Nama') }}"
                               placeholder="Masukkan Nama"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                      transition duration-200 outline-none">
                    </div>
                                        <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="text"
                               name="no_kontak"
                               value="{{ old('no_kontak') }}"
                               placeholder="Masukkan Nomor Kontak"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                      transition duration-200 outline-none"
                               required>
                        @error('no_kontak')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                     <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">No Kontak</label>
                        <input type="text"
                        name="Nama"
                         value="{{ old('no_kontak') }}"
                               placeholder="Masukkan Nama"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                      transition duration-200 outline-none">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <div class="relative">
                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Minimal 6 karakter"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl 
                                          focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                                          transition duration-200 outline-none"
                                   required>

                            <button type="button"
                                    onclick="togglePassword()"
                                    class="absolute right-3 top-3 text-gray-500 hover:text-gray-700 text-sm">
                                Lihat
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Button Section -->
                <div class="flex justify-between items-center pt-6 border-t">
                    <a href="{{ route('data-akun.index') }}"
                       class="px-6 py-3 rounded-xl bg-gray-200 text-gray-700 
                              hover:bg-gray-300 transition duration-200">
                        Batal
                    </a>

                    <button type="submit"
                            class="px-8 py-3 rounded-xl bg-indigo-600 text-white 
                                   font-semibold shadow-md 
                                   hover:bg-indigo-700 hover:shadow-lg 
                                   transition duration-200">
                        Simpan Data
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            password.type = password.type === 'password' ? 'text' : 'password';
        }
    </script>

</x-layout>