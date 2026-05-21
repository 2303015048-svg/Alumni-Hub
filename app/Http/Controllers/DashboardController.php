<?php

namespace App\Http\Controllers;

use App\Models\Job; // <-- PASTIKAN IMPORT MODEL JOB INI SUDAH ADA
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung statistik untuk kotak atas dashboard
        $totalJobs        = Job::count();
        $postingMahasiswa = Job::whereHas('user', function($query) {
            $query->where('role', 'mahasiswa');
        })->count();
        
        // UBAH: dari $userAktif menjadi $totalUsers agar cocok dengan Blade
        $totalUsers       = User::count(); 
        
        // UBAH: dari $deadlineDekat menjadi $deadlineClose agar cocok dengan Blade
        $deadlineClose   = Job::where('deadline_date', '<=', now()->addDays(7))->count();

        // 2. KITA AMBIL SEMUA DATA LOWONGAN UNTUK DITAMPILKAN DI BAWAHNYA
        $jobs = Job::with('user')->latest()->get();

        // 3. Kirim semua variabel ke file Blade (Jangan lupa sesuaikan isi compact-nya)
        return view('dashboard', compact('totalJobs', 'postingMahasiswa', 'totalUsers', 'deadlineClose', 'jobs'));
    }
}