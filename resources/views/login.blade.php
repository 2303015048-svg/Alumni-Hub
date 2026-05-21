<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Hub - Masuk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin:0; padding:0; font-family: 'Segoe UI', sans-serif; }
        body { display: flex; height: 100vh; background-color: #0b1a30; color: #fff; }
        .left-panel { width: 40%; background-color: #081426; padding: 60px; display: flex; flex-direction: column; justify-content: space-between; position: relative;}
        .brand { display: flex; align-items: center; gap: 12px; }
        .brand-logo { background: #1e3d6b; width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .main-title { font-size: 32px; font-weight: 700; line-height: 1.3; margin-top: 40px; }
        .role-indicator { margin-top: 30px; display: flex; flex-direction: column; gap: 15px; }
        .indicator-card { padding: 15px; border-radius: 10px; display: flex; flex-direction: column; border-left: 5px solid; }
        .indicator-card.mhs { background: rgba(30,61,107,0.2); border-color: #38b6ff; }
        .indicator-card.dsn { background: rgba(21,87,36,0.1); border-color: #155724; }
        .right-panel { width: 60%; background: #f4f7f6; display: flex; align-items: center; justify-content: center; padding: 40px; border-radius: 30px 0 0 30px; }
        .login-card { background: #fff; width: 100%; max-width: 500px; padding: 40px; border-radius: 20px; color: #333; }
        .role-selector { display: flex; gap: 20px; margin: 25px 0; }
        .role-btn { flex: 1; padding: 12px; border: 2px solid #1e56a0; border-radius: 8px; background: transparent; color: #1e56a0; font-weight: 600; cursor: pointer; text-align: center; }
        .role-btn.active { background: #1e56a0; color: #fff; }
        .form-group { margin-bottom: 20px; position: relative; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #444; }
        .form-group input { width: 100%; padding: 14px; border: 1px solid #ccc; border-radius: 8px; font-size: 14px; outline: none; }
        .remember-forgot { display: flex; justify-content: space-between; align-items: center; font-size: 13px; margin-bottom: 25px; }
        .btn-primary { width:100%; padding: 14px; background: #1e56a0; border: none; color: #fff; font-size: 16px; font-weight: 600; border-radius: 8px; cursor: pointer; }
        .btn-primary:hover { background: #123c73; }
        .register-link { text-align: center; margin-top: 25px; font-size: 13px; color: #666; }
        .register-link a { color: #1e56a0; text-decoration: none; font-weight: 700; }
    </style>
</head>
<body>

    <div class="left-panel">
        <div class="brand">
            <div class="brand-logo"><i class="fa-solid fa-graduation-cap"></i></div>
            <div><h4 style="margin:0;">Alumni Hub</h4><small style="color:#777;">Job Portal Platform</small></div>
        </div>
        <div>
            <h2 class="main-title">Temukan Karir<br>Impianmu.</h2>
            <p style="color:#aaa; font-size:14px; margin-top:10px;">Platform lowongan kerja eksklusif untuk civitas akademika</p>
            <div class="role-indicator">
                <div class="indicator-card mhs">
                    <small style="color:#38b6ff; font-weight:bold;">MAHASISWA</small>
                    <span style="font-size:13px; margin-top:5px;">Jelajahi & Simpan Lowongan Pekerjaan</span>
                </div>
                <div class="indicator-card dsn">
                    <small style="color:#28a745; font-weight:bold;">DOSEN</small>
                    <span style="font-size:13px; margin-top:5px;">Post & Kelola Lowongan Pekerjaan</span>
                </div>
            </div>
        </div>
        <p style="font-size:11px; color:#555;">&copy; 2026 Alumni Hub - Universitas Muhammadiyah Prof. Dr. Hamka</p>
    </div>

    <div class="right-panel">
        <div class="login-card">
            <h2 style="text-align:center;">Selamat Datang!</h2>
            <p style="text-align:center; color:#777; font-size:14px; margin-top:5px;">Masuk ke akun Alumni Hub kamu</p>
            
            @if(session()->has('suksesDaftar'))
                <div style="background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-top:15px; font-size:13px;">{{ session('suksesDaftar') }}</div>
            @endif
            @if(session()->has('loginError'))
                <div style="background:#f8d7da; color:#721c24; padding:10px; border-radius:5px; margin-top:15px; font-size:13px;">{{ session('loginError') }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="role-selector">
                    <div class="role-btn active" onclick="setRole('mahasiswa')">Mahasiswa</div>
                    <div class="role-btn" onclick="setRole('kaprodi')">Dosen</div>
                </div>
                <input type="hidden" name="selected_role" id="role_input" value="mahasiswa">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="nindiasrai@gmail.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="********" required>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Ingat saya di perangkat ini</label>
                    <a href="#" style="color:#1e56a0; text-decoration:none;">Lupa Password?</a>
                </div>
                <button type="submit" class="btn-primary">Masuk</button>
                <div class="register-link">
                    Belum punya akun? <a href="/daftar">Daftar sekarang</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setRole(role) {
            document.getElementById('role_input').value = role;
            const buttons = document.querySelectorAll('.role-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
        }
    </script>
</body>
</html>