<x-app-layout>
    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Ringkasan Aktivitas</span>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-2">Dashboard</h2>
            <p class="text-slate-500 mt-1 font-medium">Selamat datang kembali, <span class="text-slate-800 font-bold">{{ Auth::user()->name }}</span>! 👋</p>
        </div>
        
        <div class="flex items-center space-x-2 bg-slate-50 border border-slate-200/60 p-2 rounded-xl text-xs font-semibold text-slate-600">
            <i class="fa-solid fa-calendar px-1 text-slate-400"></i>
            <span>{{ date('d M Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Postingan</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ $totalJobs ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shadow-sm"><i class="fa-solid fa-signs-post"></i></div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Postingan Mahasiswa</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ $postingMahasiswa ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-sm"><i class="fa-solid fa-briefcase"></i></div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">User Aktif</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ $totalUsers ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-sm"><i class="fa-solid fa-user-graduate"></i></div>
        </div>
        
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Deadline Dekat</p>
                <h3 class="text-3xl font-extrabold text-slate-900">{{ $deadlineClose ?? 0 }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-sm"><i class="fa-solid fa-clock"></i></div>
        </div>
    </div>

    <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
        <i class="fa-solid fa-fire text-amber-500"></i> Lowongan Terbaru
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse(($jobs ?? []) as $job)
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col justify-between p-5 group relative">
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md uppercase tracking-wide">
                            {{ $job->job_type ?? 'Full-Time' }}
                        </span>
                        
                        <div class="flex items-center space-x-1">
                            @if(Str::lower(Auth::user()->role) === 'kaprodi' || Auth::id() == $job->created_by)
                                <a href="{{ route('lowongan.edit', $job->id) }}" class="text-slate-400 hover:text-amber-500 p-1.5 rounded-lg hover:bg-amber-50 transition flex items-center justify-center" title="Edit Lowongan">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>
                            @endif

                            @if(Str::lower(Auth::user()->role) === 'kaprodi' || Auth::id() == $job->created_by)
                                <form action="{{ route('lowongan.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan lowongan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-500 p-1.5 rounded-lg hover:bg-red-50 transition flex items-center justify-center" title="Hapus Lowongan">
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
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
                
                <div class="mt-5 pt-4 border-t border-slate-100 flex flex-col gap-2">
                    <div class="flex justify-between items-center text-[11px] text-slate-400">
                        <span>Gaji: <strong class="text-slate-700 font-bold">{{ $job->salary_range ?? 'Kompetitif' }}</strong></span>
                        <span class="text-rose-500 font-medium"><i class="fa-regular fa-calendar-xmark mr-0.5"></i> {{ $job->deadline_date }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center text-xs pt-1">
                        <span class="text-slate-400 font-medium">Oleh: <strong class="text-slate-600 font-semibold">{{ $job->user->name ?? 'User' }}</strong></span>
                        
                        <a href="{{ route('lowongan.show', $job->id) }}" class="text-blue-600 font-bold hover:underline flex items-center gap-0.5">
                            Detail <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-3 bg-white border border-dashed border-slate-200 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl text-slate-400 flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h4 class="font-bold text-slate-800 text-lg">Belum Ada Lowongan Pekerjaan</h4>
                <p class="text-slate-400 text-sm mt-1 max-w-sm mx-auto">Angka statistik dan kartu lowongan akan terhitung serta terisi otomatis setelah Anda atau mahasiswa menginput data baru.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>