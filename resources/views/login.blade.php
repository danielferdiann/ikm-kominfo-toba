<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Executive - IKM Toba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: url("{{ asset('img/danautoba.png') }}") no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            width: 900px;
            height: 550px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            border-radius: 20px;
            overflow: hidden;
        }
        .login-side-info {
            background: linear-gradient(135deg, #002366, #001529);
            width: 40%;
            padding: 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .login-form-area {
            width: 60%;
            padding: 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .btn-login {
            background: #002366;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 8px;
            border: none;
            letter-spacing: 1px;
            transition: 0.3s;
        }
        .btn-login:hover { background: #C5A059; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-side-info">
            <img src="{{ asset('img/pemkabtoba.png') }}" width="80" class="mb-4">
            <h3 class="fw-bold">IKM SYSTEM</h3>
            <p class="small opacity-75">Panel Administrator Dinas Komunikasi dan Informatika Kabupaten Toba</p>
            <div class="mt-4 border-top pt-3 w-100 opacity-50 small">Secure Access Only</div>
        </div>

        <div class="login-form-area">
            <div class="mb-4">
                <img src="{{ asset('img/kominfotoba.png') }}" width="50" class="mb-3">
                <h2 class="fw-bold text-dark">Selamat Datang</h2>
                <p class="text-muted">Silahkan masukkan kredensial admin Anda.</p>
            </div>
            
            @if(session('error'))
                <div class="alert alert-danger py-2" style="font-size: 0.8rem;">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="/login" method="POST">
                @csrf
                <label class="small fw-bold text-secondary">USERNAME</label>
                <input type="text" name="username" class="form-control" placeholder="admin@toba.go.id" required>
                
                <label class="small fw-bold text-secondary">PASSWORD</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                
                <button type="submit" class="btn btn-login w-100 shadow-sm mt-2">AUTENTIKASI MASUK</button>
            </form>
            
            <div class="mt-4 text-center">
                <a href="/" class="text-decoration-none small text-muted">← Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</body>
</html>