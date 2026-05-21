<x-app-layout>
    <div class="mb-6">
        <a href="/dashboard" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-blue-600 transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">
        
        <div class="lg:col-span-2 space-y-6">
            <div>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-full uppercase tracking-wider">
                    {{ $job->job_type ?? 'Full-Time' }}
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3 tracking-tight">{{ $job->title }}</h2>
                <p class="text-base font-semibold text-slate-600 mt-1 flex items-center gap-1.5">
                    <i class="fa-solid fa-building text-slate-400"></i> {{ $job->company }}
                </p>
            </div>

            <hr class="border-slate-100">

            <div>
                <h3 class="text-lg font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-file-text text-blue-500"></i> Deskripsi & Persyaratan Pekerjaan
                </h3>
                <div class="text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50/60 p-6 rounded-2xl border border-slate-100/80">
                    {{ $job->description }}
                </div>
            </div>
        </div>

        <div class="bg-slate-50/80 p-6 rounded-2xl border border-slate-100 h-fit space-y-5">
            <h3 class="text-base font-bold text-slate-900 border-b border-slate-200/60 pb-3">
                Ringkasan Pekerjaan
            </h3>

            <div class="space-y-4 text-sm">
                <div>
                    <span class="text-xs font-semibold text-slate-400 block mb-0.5">Kategori Bidang</span>
                    <span class="font-bold text-slate-800"><i class="fa-solid fa-tags text-slate-400 mr-1"></i> {{ $job->category }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 block mb-0.5">Tingkat Posisi</span>
                    <span class="font-bold text-slate-800"><i class="fa-solid fa-layer-group text-slate-400 mr-1"></i> {{ $job->position_level ?? 'Fresh Graduate' }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 block mb-0.5">Lokasi Penempatan</span>
                    <span class="font-bold text-slate-800"><i class="fa-solid fa-location-dot text-slate-400 mr-1"></i> {{ $job->location }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 block mb-0.5">Kisaran Gaji</span>
                    <span class="font-bold text-emerald-600 bg-emerald-50/60 px-2.5 py-1 rounded-md"><i class="fa-solid fa-money-bill-wave mr-1"></i> {{ $job->salary_range }}</span>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 block mb-0.5">Batas Akhir Lamaran</span>
                    <span class="font-bold text-rose-600"><i class="fa-regular fa-calendar-xmark mr-1"></i> {{ $job->deadline_date }}</span>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200/60 text-xs text-slate-400">
                <span>Diposting oleh: <strong class="text-slate-600">{{ $job->user->name ?? 'User' }}</strong></span>
            </div>
        </div>
    </div>
</x-app-layout>