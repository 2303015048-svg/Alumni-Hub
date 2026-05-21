<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Hub - Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f8fafc] antialiased text-slate-800">

    <div class="flex min-h-screen">
        
        <aside class="w-68 bg-[#0f172a] text-slate-200 flex flex-col justify-between p-6 shrink-0 shadow-xl border-r border-slate-800">
            <div>
                <div class="flex items-center space-x-3 mb-10 px-2">
                    <div class="bg-blue-600 p-2.5 rounded-xl shadow-lg shadow-blue-500/30 text-white">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-extrabold text-lg tracking-tight bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent">Alumni Hub</h1>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Portal Panel</p>
                    </div>
                </div>

                <nav class="space-y-2">
                    <a href="/dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-semibold transition {{ request()->is('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i class="fa-solid fa-chart-pie text-lg"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('lowongan.myPosts') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-semibold transition {{ request()->is('postingan-saya') || request()->is('lowongan/*/edit') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i class="fa-solid fa-briefcase text-lg"></i>
                        <span>Lihat Lowongan</span>
                    </a>

                    @if(Auth::user()->role == 'mahasiswa')
                    <a href="/lowongan/tambah" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-semibold transition {{ request()->is('lowongan/tambah') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i class="fa-solid fa-circle-plus text-lg"></i>
                        <span>Tambah Postingan</span>
                    </a>
                    @endif

                    @if(Auth::user()->role == 'kaprodi')
                    <a href="/lowongan/tambah" class="flex items-center space-x-3 px-4 py-3 rounded-xl font-semibold transition {{ request()->is('lowongan/tambah') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800/50' }}">
                        <i class="fa-solid fa-circle-plus text-lg"></i>
                        <span>Tambah Postingan</span>
                    </a>
                    @endif
                </nav>
            </div>

            <div class="border-t border-slate-800 pt-4 flex flex-col gap-3">
                <a href="{{ route('profile.edit') }}" class="bg-slate-900/50 p-3 rounded-xl flex items-center space-x-3 border border-slate-800 hover:border-slate-700 transition cursor-pointer group block">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center font-bold text-white shadow-md group-hover:scale-105 transition shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden flex-1">
                        <p class="font-semibold text-sm text-white truncate group-hover:text-blue-400 transition">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500 capitalize font-medium">{{ Auth::user()->role }}</p>
                    </div>
                    <div class="text-slate-600 group-hover:text-slate-400 transition pl-1">
                        <i class="fa-solid fa-gear text-xs"></i>
                    </div>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-slate-900 hover:bg-red-950/30 text-slate-400 hover:text-red-400 border border-slate-800 hover:border-red-900/50 py-2.5 rounded-xl text-sm font-semibold transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar Aplikasi</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 h-screen overflow-y-auto">
            <div class="p-10 max-w-[1400px] w-full mx-auto">
                {{ $slot }}
            </div>
        </main>

    </div>

</body>
</html>