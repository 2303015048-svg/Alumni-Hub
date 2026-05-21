<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Lowongan Baru - Alumni Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f4f7fa; 
            display: flex;
            min-height: 100vh;
            color: #334155;
        }

        /* --- SIDEBAR STYLE --- */
        .sidebar {
            width: 260px;
            background-color: #0f1e36; 
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 16px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
        }

        .sidebar-top {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-left: 8px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .brand-icon svg {
            width: 22px;
            height: 22px;
            fill: white;
        }

        .brand-text h1 {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .brand-text p {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            margin-top: 2px;
        }

        /* Menu Navigasi */
        .menu-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            list-style: none;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .menu-item a:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.04);
        }

        /* Menu Aktif saat di halaman Tambah Postingan */
        .menu-item.active a {
            background-color: #2563eb; 
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .menu-item svg {
            width: 20px;
            height: 20px;
            transition: transform 0.2s;
        }

        .menu-item a:hover svg {
            transform: scale(1.05);
        }

        /* Profil Pengguna Di Bagian Bawah Sidebar */
        .sidebar-bottom {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .user-profile-card {
            display: flex;
            align-items: center;
            gap: 12px;
            background-color: rgba(255, 255, 255, 0.03);
            padding: 12px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .avatar-box {
            width: 38px;
            height: 38px;
            background-color: #2563eb;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 16px;
            color: white;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #ffffff; /* Mengubah warna menjadi putih agar terbaca di background gelap */
        }

        .user-role {
            font-size: 11px;
            color: #94a3b8; /* Mengubah kontras warna role agar seimbang */
            margin-top: 1px;
        }

        .btn-logout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            font-size: 13px;
            font-weight: 500;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-color: rgba(239, 68, 68, 0.2);
        }

        /* --- AREA KONTEN UTAMA (Sisi Kanan) --- */
        .main-content {
            margin-left: 260px; 
            padding: 40px;
            width: calc(100% - 260px);
        }

        /* Card Form Biru Estetik Kustom */
        .container-form {
            width: 100%;
            max-width: 950px;
            background: #0f2c59; 
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(15, 44, 89, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .header-form {
            background-color: #003366; 
            color: white;
            padding: 30px 40px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .header-form h2 {
            font-size: 24px;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        .header-form p {
            margin-top: 6px;
            opacity: 0.75;
            font-size: 14px;
        }

        .body-form {
            padding: 40px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        .grid-inputs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            font-size: 11px;
            font-weight: 700;
            color: #cbd5e1; 
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 8px;
        }

        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 12px 16px;
            border-radius: 8px;
            background-color: #eef5fc; 
            color: #1e293b;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #94a3b8;
        }

        .form-group input:focus, 
        .form-group select:focus, 
        .form-group textarea:focus {
            border-color: #3b82f6;
            outline: none;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }

        .radio-group-container {
            grid-column: span 2;
        }

        .radio-group {
            display: flex;
            gap: 14px;
            margin-top: 2px;
        }

        .radio-box {
            flex: 1;
        }

        .radio-box input[type="radio"] {
            display: none;
        }

        .radio-box label {
            display: block;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 14px;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: #cbd5e1;
            transition: all 0.2s;
        }

        .radio-box label:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
        }

        .radio-box input[type="radio"]:checked + label {
            background-color: #2563eb;
            color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .footer-form {
            display: flex;
            justify-content: flex-end;
            gap: 14px;
            margin-top: 35px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 25px;
        }

        .btn {
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-publish {
            background-color: #0d7c59; 
            color: white;
            border: none;
        }

        .btn-publish:hover {
            background-color: #0a6346;
            transform: translateY(-1px);
        }

        .btn-back {
            background: transparent;
            color: #94a3b8;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #f1f5f9;
        }

        /* Penyesuaian Responsif Layar Kecil */
        @media (max-width: 992px) {
            .sidebar { width: 70px; padding: 24px 8px; align-items: center; }
            .brand-text, .user-info, .btn-logout span { display: none; }
            .main-content { margin-left: 70px; width: calc(100% - 70px); padding: 20px; }
            .grid-inputs { grid-template-columns: 1fr; }
            .form-group.full-width, .radio-group-container { grid-column: span 1; }
            .radio-group { flex-direction: column; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="brand">
                <div class="brand-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/>
                        <path d="M19.14 12.94L12 16.83l-7.14-3.89L3 14v3c0 2.21 4.03 4 9 4s9-1.79 9-4v-3l-1.86-1.06z"/>
                    </svg>
                </div>
                <div class="brand-text">
                    <h1>Alumni Hub</h1>
                    <p>Portal Panel</p>
                </div>
            </div>

            <ul class="menu-list">
                <li class="menu-item">
                    <a href="/dashboard">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/postingan-saya">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Lihat Lowongan
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="/lowongan/tambah">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Tambah Postingan
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-bottom">
            <div class="user-profile-card">
                <div class="avatar-box">
                    {{ strtoupper(substr(Auth::user()->name ?? 'N', 0, 1)) }}
                </div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name ?? 'nindi asraini' }}</span>
                    <span class="user-role">{{ ucfirst(Auth::user()->role ?? 'Mahasiswa') }}</span>
                </div>
            </div>
            
            <form action="/logout" method="POST" style="width: 100%;">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Keluar Aplikasi</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div class="container-form">
            <div class="header-form">
                <h2>Tambahkan Lowongan Baru</h2>
                <p>Isi semua detail informasi lowongan pekerjaan</p>
            </div>

            <div class="body-form">
                @if ($errors->any())
                    <div class="alert-error">
                        <strong>Penyimpanan Gagal:</strong> Harap pastikan seluruh kolom wajib bertanda (*) sudah diisi.
                    </div>
                @endif

                <form action="{{ route('lowongan.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid-inputs">
                        
                        <div class="form-group">
                            <label>Judul posisi*</label>
                            <input type="text" name="title" placeholder="Contoh: IT Support Specialist" required value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label>Perusahaan*</label>
                            <input type="text" name="company" placeholder="Contoh: PT. Digital Nusantara" required value="{{ old('company') }}">
                        </div>

                        <div class="form-group radio-group-container">
                            <label>Tipe Pekerjaan</label>
                            <div class="radio-group">
                                <div class="radio-box">
                                    <input type="radio" id="ft" name="job_type" value="Full Time" checked>
                                    <label for="ft">Full Time</label>
                                </div>
                                <div class="radio-box">
                                    <input type="radio" id="pt" name="job_type" value="Part Time">
                                    <label for="pt">Part Time</label>
                                </div>
                                <div class="radio-box">
                                    <input type="radio" id="rem" name="job_type" value="Remote">
                                    <label for="rem">Remote</label>
                                </div>
                                <div class="radio-box">
                                    <input type="radio" id="int" name="job_type" value="Internship">
                                    <label for="int">Internship</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Bidang Pekerjaan (Kategori)*</label>
                            <input type="text" name="category" placeholder="Contoh: Teknologi Informasi" required value="{{ old('category') }}">
                        </div>

                        <div class="form-group">
                            <label>Lokasi*</label>
                            <input type="text" name="location" placeholder="Contoh: Jakarta Pusat" required value="{{ old('location') }}">
                        </div>

                        <div class="form-group">
                            <label>Kisaran Gaji*</label>
                            <input type="text" name="salary_range" placeholder="Contoh: Rp 6.000.000 - Rp 9.000.000" required value="{{ old('salary_range') }}">
                        </div>

                        <div class="form-group">
                            <label>Batas Tanggal Lamaran*</label>
                            <input type="date" name="deadline_date" required value="{{ old('deadline_date') }}">
                        </div>

                        <div class="form-group full-width">
                            <label>Link Lamaran / Kontak Info*</label>
                            <input type="text" name="contact_info" placeholder="Email HRD atau Link portal karir resmi" required value="{{ old('contact_info') }}">
                        </div>

                        <div class="form-group full-width">
                            <label>Deskripsi Lowongan*</label>
                            <textarea name="description" rows="6" placeholder="Sebutkan tanggung jawab pekerjaan serta persyaratan kandidat..." required>{{ old('description') }}</textarea>
                        </div>

                    </div>

                    <div class="footer-form">
                        <button type="button" class="btn btn-back" onclick="window.history.back()">Kembali</button>
                        <button type="submit" class="btn-publish btn">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>