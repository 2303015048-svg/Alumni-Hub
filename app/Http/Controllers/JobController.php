<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function create()
    {
        return view('tambah-lowongan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'company'       => 'required|string|max:255',
            'job_type'      => 'required|string',
            'category'      => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'salary_range'  => 'required|string|max:255',
            'deadline_date' => 'required|date',
            'contact_info'  => 'required|string|max:255', 
            'description'   => 'required|string',
        ]);

        $fullDescription = $request->description;
        if ($request->has('contact_info') && !empty($request->contact_info)) {
            $fullDescription .= "\n\n--- Kontak Rekrutmen ---\n" . $request->contact_info;
        }

        $userId = Auth::id();
        if (!$userId) {
            return redirect('/login')->with('error', 'Sesi Anda habis, silakan login kembali.');
        }

        Job::create([
            'title'          => $request->title,
            'company'        => $request->company,
            'job_type'       => $request->job_type,
            'category'       => $request->category,
            'location'       => $request->location,
            'salary_range'   => $request->salary_range,
            'deadline_date'  => $request->deadline_date,
            'description'    => $fullDescription,
            'created_by'     => $userId,
        ]);

        return redirect('/dashboard')->with('success', 'Lowongan kerja berhasil dipublikasikan!');
    }

    public function show($id)
    {
        $job = Job::with('user')->findOrFail($id);
        return view('detail-lowongan', compact('job'));
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        if (!$user) {
            return redirect('/login')->with('error', 'Sesi Anda habis.');
        }

        // Kaprodi bisa hapus semua, mahasiswa hanya bisa hapus miliknya sendiri
        if (Str::lower($user->role) === 'kaprodi' || Auth::id() == $job->created_by) {
            $job->delete();
            return redirect('/dashboard')->with('success', 'Postingan berhasil dihapus.');
        }

        return redirect('/dashboard')->with('error', 'Anda tidak memiliki hak akses.');
    }

    public function myPosts()
    {
        $jobs = Job::where('created_by', Auth::id())
                ->latest()
                ->get();

        return view('postingan-saya', compact('jobs'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        // ATURAN HAK AKSES EDIT: Kaprodi bebas edit semua, Mahasiswa hanya milik sendiri (created_by)
        if (Str::lower($user->role) === 'kaprodi' || Auth::id() == $job->created_by) {
            return view('edit-lowongan', compact('job'));
        }

        return redirect('/dashboard')->with('error', 'Akses ditolak. Anda tidak bisa mengedit postingan orang lain.');
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        // Keamanan berlapis di sisi backend server
        if (Str::lower($user->role) !== 'kaprodi' && Auth::id() != $job->created_by) {
            return redirect('/dashboard')->with('error', 'Tindakan tidak diizinkan.');
        }

        $request->validate([
            'title'         => 'required|string|max:255',
            'company'       => 'required|string|max:255',
            'job_type'      => 'required|string',
            'category'      => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'salary_range'  => 'required|string|max:255',
            'deadline_date' => 'required|date',
            'description'   => 'required|string',
        ]);

        $job->update([
            'title'         => $request->title,
            'company'       => $request->company,
            'job_type'      => $request->job_type,
            'category'       => $request->category,
            'location'      => $request->location,
            'salary_range'  => $request->salary_range,
            'deadline_date' => $request->deadline_date,
            'description'   => $request->description,
        ]);

        return redirect('/dashboard')->with('success', 'Lowongan berhasil diperbarui!');
    }
}