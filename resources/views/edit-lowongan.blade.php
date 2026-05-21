<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl border border-slate-100 shadow-sm my-6">
        
        <div class="flex items-center space-x-3 mb-8 pb-4 border-b border-slate-100">
            <div class="bg-amber-500 p-2.5 rounded-xl text-white shadow-md shadow-amber-500/20">
                <i class="fa-solid fa-pen-to-square text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Edit Lowongan Kerja</h2>
                <p class="text-sm text-slate-500 font-medium">Perbarui rincian informasi lowongan pekerjaan Anda</p>
            </div>
        </div>

        <form action="{{ route('lowongan.update', $job->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Lowongan / Posisi</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Perusahaan</label>
                    <input type="text" name="company" value="{{ old('company', $job->company) }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tipe Pekerjaan</label>
                    <select name="job_type" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm bg-white">
                        <option value="FULL TIME" {{ old('job_type', $job->job_type) == 'FULL TIME' ? 'selected' : '' }}>Full Time</option>
                        <option value="PART TIME" {{ old('job_type', $job->job_type) == 'PART TIME' ? 'selected' : '' }}>Part Time</option>
                        <option value="INTERNSHIP" {{ old('job_type', $job->job_type) == 'INTERNSHIP' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kategori Bidang</label>
                    <input type="text" name="category" value="{{ old('category', $job->category) }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Lokasi Kerja</label>
                    <input type="text" name="location" value="{{ old('location', $job->location) }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Rentang Gaji</label>
                    <input type="text" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm" placeholder="Contoh: Rp4.000.000 - Rp5.500.000">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Batas Akhir (Deadline)</label>
                    <input type="date" name="deadline_date" value="{{ old('deadline_date', $job->deadline_date) }}" required 
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi Pekerjaan & Persyaratan</label>
                <textarea name="description" rows="6" required 
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition font-medium text-sm leading-relaxed">{{ old('description', $job->description) }}</textarea>
            </div>

            <div class="flex items-center justify-end space-x-3 pt-5 border-t border-slate-100 mt-6">
                <a href="/dashboard" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-600/10 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</x-app-layout>