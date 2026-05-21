<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController; 

// Halaman Utama: Diarahkan langsung ke login
Route::get('/', function () {
    return view('login');
});

// Halaman yang HANYA bisa diakses setelah pengguna berhasil login (Grup Auth)
Route::middleware(['auth', 'verified'])->group(function () {
    // Rute utama dashboard aplikasi
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- KELOMPOK RUTE LOWONGAN KERJA (JOB SYSTEM) ---
    Route::get('/lowongan/tambah', [JobController::class, 'create'])->name('lowongan.create');
    Route::post('/lowongan', [JobController::class, 'store'])->name('lowongan.store');
    Route::get('/postingan-saya', [JobController::class, 'myPosts'])->name('lowongan.myPosts');
    
    // Fitur Edit & Update data
    Route::get('/lowongan/{id}/edit', [JobController::class, 'edit'])->name('lowongan.edit');
    Route::put('/lowongan/{id}', [JobController::class, 'update'])->name('lowongan.update');
    
    Route::get('/lowongan/{id}', [JobController::class, 'show'])->name('lowongan.show');
    Route::delete('/lowongan/{id}', [JobController::class, 'destroy'])->name('lowongan.destroy');

    // --- KELOMPOK RUTE PROFILE USER ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- KELOMPOK RUTE SISTEM OTENTIKASI & REGISTRASI (GUEST / PUBLIC) ---
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/daftar', [RegisterController::class, 'index'])->name('register'); 
Route::post('/daftar', [RegisterController::class, 'simpanAkun']);