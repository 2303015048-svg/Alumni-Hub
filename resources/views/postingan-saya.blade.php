<x-app-layout>
    @if(request()->routeIs('lowongan.edit'))
        <div class="max-w-3xl mx-auto">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm mb-6">
                <h2 class="text-2xl font-bold text-slate-900">Edit Lowongan Kerja</h2>
                <p class="text-slate-500 text-sm mt-1">Perbarui informasi detail lowongan pekerjaan yang Anda kelola.</p>
            </div>

            <form action="{{ route('lowongan.update', $job->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Posisi / Judul Lowongan</label>
                        <input type="text" name="title" value="{{ old('title', $job->title) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Nama Perusahaan</label>
                            <input type="text" name="company" value="{{ old('company', $job->company) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Tipe Pekerjaan</label>
                            <select name="job_type" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                                <option value="Full-Time" {{ old('job_type', $job->job_type) == 'Full-Time' ? 'selected' : '' }}>Full-Time</option>
                                <option value="Part-Time" {{ old('job_type', $job->job_type) == 'Part-Time' ? 'selected' : '' }}>Part-Time</option>
                                <option value="Internship" {{ old('job_type', $job->job_type) == 'Internship' ? 'selected' : '' }}>Internship</option>
                                <option value="Contract" {{ old('job_type', $job->job_type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Kategori Industri</label>
                            <input type="text" name="category" value="{{ old('category', $job->category) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Lokasi Kerja</label>
                            <input type="text" name="location" value="{{ old('location', $job->location) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Rentang Gaji</label>
                            <input type="text" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Batas Akhir / Deadline</label>
                            <input type="date" name="deadline_date" value="{{ old('deadline_date', $job->deadline_date) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Deskripsi Kualifikasi & Pekerjaan</label>
                        <textarea name="description" rows="5" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-blue-500 outline-none transition" required>{{ old('description', $job->description) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('lowongan.myPosts') }}" class="bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-blue-600/10 transition">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Manajemen Karir</span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-2">Postingan Saya</h2>
                <p class="text-slate-500 mt-1 font-medium">Berikut adalah daftar lowongan pekerjaan yang telah Anda publikasikan.</p>
            </div>
            
            <a href="/lowongan/tambah" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-bold text-sm shadow-lg shadow-blue-600/20 transition group">
                <i class="fa-solid fa-plus transition group-hover:rotate-90"></i> Tambah Lowongan Baru
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse(($jobs ?? []) as $job)
                <div class="bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col justify-between p-5 group">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wide">
                                {{ $job->job_type ?? 'Full-Time' }}
                            </span>
                            
                            <form action="{{ route('lowongan.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan lowongan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-300 hover:text-red-500 p-1.5 rounded-lg hover:bg-red-50 transition" title="Hapus Lowongan">
                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                </button>
                            </form>
                        </div>

                        <h4 class="font-bold text-slate-900 group-hover:text-blue-600 transition mb-1 text-base">
                            {{ $job->title }}
                        </h4>
                        <p class="text-xs text-slate-500 font-medium mb-1">
                            <i class="fa-solid fa-building mr-1 text-slate-400"></i> {{ $job->company }}
                        </p>
                        <p class="text-[11px] text-slate-400 font-medium mb-3">
                            <i class="fa-solid fa-location-dot mr-1 text-slate-400"></i> {{ $job->location }}
                        </p>

                        <p class="text-sm text-slate-500 line-clamp-3 leading-relaxed bg-slate-50/50 p-3 rounded-xl border border-slate-100/40">
                            {{ $job->description }}
                        </p>
                    </div>
                    
                    <div class="mt-5 pt-4 border-t border-slate-100 flex flex-col gap-3">
                        <div class="flex justify-between items-center text-[11px] text-slate-400">
                            <span>Gaji: <strong class="text-slate-700 font-bold">{{ $job->salary_range }}</strong></span>
                            <span class="text-rose-500 font-medium"><i class="fa-regular fa-calendar-xmark mr-0.5"></i> {{ $job->deadline_date }}</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 pt-1">
                            <a href="{{ route('lowongan.edit', $job->id) }}" class="flex items-center justify-center gap-1.5 border border-slate-200 text-slate-600 font-bold text-xs py-2 rounded-xl hover:bg-slate-50 transition">
                                <i class="fa-regular fa-pen-to-square text-[13px]"></i> Edit Data
                            </a>

                            <a href="{{ route('lowongan.show', $job->id) }}" class="flex items-center justify-center gap-1.5 bg-slate-900 text-white font-bold text-xs py-2 rounded-xl hover:bg-slate-800 transition">
                                Detail Lowongan <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 text-lg">Anda Belum Mengunggah Postingan</h4>
                    <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">Gunakan tombol "Tambah Lowongan Baru" di atas untuk membagikan informasi lowongan karir Anda ke mahasiswa lainnya.</p>
                </div>
            @endforelse
        </div>
    @endif
</x-app-layout>