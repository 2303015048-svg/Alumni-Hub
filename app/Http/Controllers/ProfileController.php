<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan form profil pengguna.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => Auth::user(), // Menggunakan Auth::user() agar sinkron dengan sistem login kamu
        ]);
    }

    /**
     * Memproses pembaruan informasi profil.
     */
    public function update(Request $request): RedirectResponse
    {
        // Ambil data user yang sedang login saat ini
        $user = Auth::user();

        if (!$user) {
            return Redirect::route('login')->with('error', 'Sesi Anda habis, silakan login kembali.');
        }

        // 1. Validasi inputan form profil sesuai nama kolom di database ( birth_date & gender SEKARANG SUDAH MASUK )
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'], // <-- Ditambahkan agar tidak lolos validasi
            'gender' => ['nullable', 'string', 'max:20'],     // <-- Ditambahkan agar tidak lolos validasi
            'about_me' => ['nullable', 'string', 'max:1000'],
            'skills' => ['nullable', 'string', 'max:255'],
            'major' => ['nullable', 'string', 'max:100'],
            'batch' => ['nullable', 'string', 'max:4'],
            'faculty' => ['nullable', 'string', 'max:100'],
            'current_password' => ['nullable', 'required_with:password', 'current_password'], // Validasi jika mau ganti password
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // 2. Ambil model User yang asli berdasarkan ID
        $userModel = User::find($user->id);

        // 3. Masukkan data baru dari form ke model ( birth_date & gender SUDAH DIMASUKKAN KE ARRAY )
        $fields = ['name', 'email', 'phone', 'location', 'birth_date', 'gender', 'about_me', 'skills', 'major', 'batch', 'faculty'];
        $userModel->fill($request->only($fields));

        if ($userModel->isDirty('email')) {
            $userModel->email_verified_at = null;
        }

        // Fitur Tambahan: Proses Update Password jika user mengisi form password baru
        if ($request->filled('password')) {
            $userModel->password = Hash::make($request->password);
        }

        // 4. Simpan perubahan ke database MySQL secara permanen
        $userModel->save();

        // 5. Segarkan data Auth di session browser agar langsung berubah di tampilan
        Auth::setUser($userModel);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = User::find(Auth::id());

        Auth::logout();

        if ($user) {
            $user->delete();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}