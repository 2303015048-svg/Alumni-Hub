<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Alumni Hub - Pendaftaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin:0; padding:0; font-family: 'Segoe UI', sans-serif; }
        body { display:flex; justify-content:center; align-items:center; height:100vh; background:#0b1a30; color:#333; }
        .reg-card { background:#fff; padding:40px; border-radius:15px; width:100%; max-width:450px; }
        .form-group { margin-bottom:15px; }
        .form-group label { display:block; font-size:14px; font-weight:600; margin-bottom:5px; }
        .form-group input, .form-group select { width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; }
        .btn-reg { width:100%; padding:12px; background:#1e56a0; border:none; color:#fff; font-weight:bold; border-radius:6px; cursor:pointer; }
    </style>
</head>
<body>
    <div class="reg-card">
        <h3 style="text-align:center; margin-bottom:20px;">Daftar Akun Baru</h3>
        @if(session('suksesDaftar'))
    <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:5px;">
        {{ session('suksesDaftar') }}
    </div>
@endif

@if($errors->any())
    <div style="background:#f8d7da; color:#721c24; padding:10px; margin-bottom:15px; border-radius:5px;">
        <ul style="margin-left:20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="/daftar" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Mendaftar Sebagai</label>
                <select name="role" required>
                    <option value="mahasiswa">Mahasiswa (Pelamar)</option>
                    <option value="kaprodi">Dosen / Kaprodi (Pemberi Kerja)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn-reg">Daftar Sekarang</button>
            <p style="text-align:center; font-size:13px; margin-top:15px;">Sudah punya akun? <a href="/login" style="color:#1e56a0; text-decoration:none;">Masuk</a></p>
        </form>
    </div>
</body>
</html>