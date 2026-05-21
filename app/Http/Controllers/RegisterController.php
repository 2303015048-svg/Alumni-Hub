<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // 1. Menampilkan Form Registrasi
    public function index()
    {
        return view('daftar');
    }

    // 2. Menyimpan data akun baru ke database
    public function simpanAkun(Request $request)
    {
        // Aturan Validasi data pendaftaran
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users', // Email tidak boleh kembar di tabel users
            'password' => 'required|min:8|confirmed', // Wajib sama dengan input password_confirmation
            'role' => 'required|in:kaprodi,mahasiswa'
        ]);

        // Proses memasukkan data ke tabel MySQL
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password) // Enkripsi password demi keamanan database
        ]);

        // Berhasil, lempar ke halaman login dengan pesan sukses
        return redirect('/login')->with('suksesDaftar', 'Akun berhasil dibuat! Silakan masuk.');
    }
}