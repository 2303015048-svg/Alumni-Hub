<x-app-layout>
    <div class="max-w-5xl mx-auto space-y-6">

        @if (session('status') === 'profile-updated')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-2xl text-sm font-semibold flex items-center gap-2 shadow-sm animate-fade-in">
                <i class="fa-solid fa-circle-check text-base"></i> Profil Anda berhasil diperbarui!
            </div>
        @endif

        {{-- FORM EDIT PROFIL --}}
        <div id="editProfileForm" class="hidden animate-fade-in">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Perbarui Data Akun</h2>
                    <p class="text-slate-500 text-xs mt-0.5">Silakan sesuaikan informasi profil, kontak, dan informasi akademik Anda.</p>
                </div>
                <button onclick="toggleEditForm()" class="bg-slate-100 text-slate-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-slate-200 transition">
                    Batal
                </button>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('patch')

                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm space-y-5">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Alamat Email Sistem</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">No. Telepon / WA</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Alamat Domisili / Lokasi</label>
                            <input type="text" name="location" value="{{ old('location', $user->location) }}" placeholder="Contoh: Jakarta, Indonesia" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Tanggal Lahir</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Jenis Kelamin</label>
                            <select name="gender" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                                <option value="" {{ old('gender', $user->gender) == '' ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            @if (Str::lower($user->role) === 'kaprodi')
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Jabatan Akademik / Struktural</label>
                                <input type="text" name="skills" value="{{ old('skills', $user->skills) }}" placeholder="Contoh: Lektor / Kepala Program Studi" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @else
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Bidang Keahlian <span class="text-[10px] text-slate-400">(Pisah dengan koma)</span></label>
                                <input type="text" name="skills" value="{{ old('skills', $user->skills) }}" placeholder="Contoh: PHP, Laravel, UI/UX" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @endif
                            @error('skills') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 border-t border-slate-50">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Program Studi</label>
                            <input type="text" name="major" value="{{ old('major', $user->major) }}" placeholder="Contoh: Informatika" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @error('major') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            @if (Str::lower($user->role) === 'kaprodi')
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">NIDN / NIP Dosen</label>
                                <input type="text" name="batch" value="{{ old('batch', $user->batch) }}" placeholder="Masukkan nomor induk dosen" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @else
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Tahun Angkatan</label>
                                <input type="number" name="batch" value="{{ old('batch', $user->batch) }}" placeholder="Contoh: 2023" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @endif
                            @error('batch') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Fakultas</label>
                            <input type="text" name="faculty" value="{{ old('faculty', $user->faculty) }}" placeholder="Contoh: Ilmu Komputer" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @error('faculty') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Tentang Saya</label>
                        <textarea name="about_me" rows="4" placeholder="Tuliskan deskripsi singkat diri Anda..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">{{ old('about_me', $user->about_me) }}</textarea>
                        @error('about_me') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2 border-t border-slate-100">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password Saat Ini <span class="text-slate-400 font-normal">(Diperlukan jika ingin ganti password)</span></label>
                        <input type="password" name="current_password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                        @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password Baru</label>
                            <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-blue-600/10 transition">
                        Simpan Perubahan Akun
                    </button>
                </div>
            </form>
        </div>


        {{-- PANEL TAMPILAN PROFIL --}}
        <div id="profileViewPanel" class="space-y-6">
            
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                    <span>Dashboard</span>
                    <i class="fa-solid fa-chevron-right text-[9px]"></i>
                    <span class="text-blue-600 font-semibold">Profil Saya</span>
                </div>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight mt-1">Profil Saya</h2>
                <p class="text-slate-500 text-sm">Kelola informasi profil dan pengaturan akun Anda</p>
            </div>

            {{-- KARTU UTAMA USER --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center gap-6 z-10">
                    <div class="relative group">
                        <div class="w-28 h-28 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-black text-white text-4xl shadow-xl border-4 border-white shadow-blue-600/10">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div onclick="toggleEditForm()" class="absolute bottom-1 right-1 bg-white border border-slate-100 text-slate-600 w-7 h-7 rounded-full flex items-center justify-center shadow-md text-xs cursor-pointer hover:bg-slate-50 transition">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                        </div>
                    </div>

                    <div class="text-center md:text-left space-y-1.5">
                        <div class="flex flex-col md:flex-row items-center gap-2">
                            <h3 class="text-xl font-bold text-slate-900 tracking-tight">{{ $user->name }}</h3>
                            <i class="fa-solid fa-circle-check text-blue-500 text-sm" title="Verified Account"></i>
                        </div>
                        
                        <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full capitalize">
                            @if (Str::lower($user->role) === 'kaprodi')
                                Dosen / Kaprodi {{ $user->major }}
                            @else
                                {{ $user->major ? 'Mahasiswa ' . $user->major : 'Mahasiswa' }}
                            @endif
                        </span>

                        <div class="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-1.5 text-xs font-medium text-slate-500">
                            <div class="flex items-center gap-2">
                                <i class="fa-regular fa-envelope text-slate-400 text-sm w-4"></i> {{ $user->email }}
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-phone text-slate-400 text-sm w-4"></i> 
                                <span class="{{ !$user->phone ? 'text-slate-300 italic' : '' }}">
                                    {{ $user->phone ?? 'Belum diisi' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-2 col-span-1 sm:col-span-2">
                                <i class="fa-solid fa-location-dot text-slate-400 text-sm w-4"></i> 
                                <span class="{{ !$user->location ? 'text-slate-300 italic' : '' }}">
                                    {{ $user->location ?? 'Lokasi belum ditentukan' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <button onclick="toggleEditForm()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold text-xs shadow-md shadow-blue-600/10 transition flex items-center gap-2 self-center md:self-start z-10">
                    <i class="fa-regular fa-pen-to-square text-sm"></i> Edit Profil
                </button>

                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-slate-50/50 rounded-full pointer-events-none"></div>
            </div>

            {{-- PANEL INFORMASI DETIL --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- TENTANG SAYA --}}
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-slate-800 font-bold text-sm mb-4">
                            <i class="fa-regular fa-user text-blue-500 text-base"></i> Tentang Saya
                        </div>
                        <p class="text-xs leading-relaxed font-medium {{ !$user->about_me ? 'text-slate-300 italic' : 'text-slate-500' }}">
                            {{ $user->about_me ?? 'Belum ada deskripsi profil diri yang ditambahkan.' }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-50 space-y-2.5 text-xs font-medium">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Tanggal Lahir</span>
                            <span class="{{ !$user->birth_date ? 'text-slate-300 italic' : 'text-slate-700 font-semibold' }}">
                                {{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') : 'Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Jenis Kelamin</span>
                            <span class="{{ !$user->gender ? 'text-slate-300 italic' : 'text-slate-700 font-semibold' }}">
                                {{ $user->gender ?? 'Belum diisi' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Jabatan</span>
                            <span class="text-slate-700 font-semibold">
                                {{ Str::lower($user->role) === 'kaprodi' ? 'Ketua Program Studi' : 'Mahasiswa S1' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- INFORMASI AKADEMIK --}}
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-slate-800 font-bold text-sm mb-4">
                            <i class="fa-solid fa-graduation-cap text-blue-500 text-base"></i> Informasi Akademik
                        </div>
                        <div class="space-y-3 text-xs font-medium">
                            <div class="flex justify-between pb-2 border-b border-slate-50">
                                <span class="text-slate-400">Program Studi</span>
                                <span class="{{ !$user->major ? 'text-slate-300 italic' : 'text-slate-700 font-semibold' }}">{{ $user->major ?? 'Belum diisi' }}</span>
                            </div>
                            <div class="flex justify-between pb-2 border-b border-slate-50">
                                <span class="text-slate-400">Status Akun</span>
                                <span class="text-emerald-600 font-bold">Aktif / Peninjau</span>
                            </div>
                            <div class="flex justify-between pb-2 border-b border-slate-50">
                                <span class="text-slate-400">{{ Str::lower($user->role) === 'kaprodi' ? 'NIDN / NIP' : 'Tahun Angkatan' }}</span>
                                <span class="{{ !$user->batch ? 'text-slate-300 italic' : 'text-slate-700 font-semibold' }}">{{ $user->batch ?? 'Belum diisi' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Fakultas</span>
                                <span class="{{ !$user->faculty ? 'text-slate-300 italic' : 'text-slate-700 font-semibold' }}">{{ $user->faculty ?? 'Belum diisi' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-2">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                            {{ Str::lower($user->role) === 'kaprodi' ? 'Fokus Utama / Jabatan Struktural' : 'Bidang Keahlian' }}
                        </span>
                        <div class="flex flex-wrap gap-1.5">
                            @if($user->skills)
                                @foreach(explode(',', $user->skills) as $skill)
                                    <span class="text-[10px] bg-slate-50 text-slate-600 px-2.5 py-1 rounded-md font-semibold border border-slate-100">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                <span class="text-xs text-slate-300 italic font-medium">Belum diisi</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- KONTAK & ALAMAT --}}
                <div class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm space-y-4">
                    <div class="flex items-center gap-2 text-slate-800 font-bold text-sm">
                        <i class="fa-solid fa-phone text-blue-500 text-base"></i> Kontak & Alamat
                    </div>
                    
                    <div class="space-y-3 text-xs font-medium text-slate-600">
                        <div>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-0.5">Email Utama</span>
                            <span class="text-slate-800 font-semibold">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-0.5">No. Telepon / WA</span>
                            <span class="{{ !$user->phone ? 'text-slate-300 italic' : 'text-slate-800 font-semibold' }}">
                                {{ $user->phone ?? 'Belum diisi' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-0.5">Alamat Domisili</span>
                            <span class="text-slate-700 leading-relaxed block {{ !$user->location ? 'text-slate-300 italic' : '' }}">
                                {{ $user->location ?? 'Alamat lengkap belum diisi' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        function toggleEditForm() {
            const viewPanel = document.getElementById('profileViewPanel');
            const editForm = document.getElementById('editProfileForm');
            
            if (editForm.classList.contains('hidden')) {
                editForm.classList.remove('hidden');
                viewPanel.classList.add('hidden');
            } else {
                editForm.classList.add('hidden');
                viewPanel.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>