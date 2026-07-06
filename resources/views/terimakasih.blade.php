<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - IKM Diskominfo Toba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #002366; --gold: #C5A059; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); 
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            margin: 0; 
            overflow: hidden;
        }
        .card { 
            border: none; 
            border-radius: 30px; 
            box-shadow: 0 20px 50px rgba(0,35,102,0.1); 
            padding: 50px; 
            text-align: center; 
            max-width: 550px; 
            background: white;
            transform: translateY(0);
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .icon-wrapper {
            width: 100px;
            height: 100px;
            background: #f0fdf4;
            color: #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin: 0 auto 25px;
            animation: scaleIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .btn-home { 
            background: var(--primary); 
            color: white; 
            border-radius: 15px; 
            padding: 14px 40px; 
            text-decoration: none; 
            transition: 0.3s; 
            display: inline-block; 
            font-weight: 700;
            border: none;
            margin-top: 10px;
        }
        .btn-home:hover { 
            background: var(--gold); 
            color: white; 
            box-shadow: 0 10px 20px rgba(197, 160, 89, 0.3);
            transform: translateY(-3px);
        }
        .countdown {
            font-size: 0.85rem;
            color: #94a3b8;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="card shadow-lg">
        <div class="icon-wrapper">
            <i class="fas fa-check"></i>
        </div>
        <h2 class="fw-800 mb-3" style="color: var(--primary)">Berhasil Terkirim!</h2>
        <p class="text-muted mb-4 px-3">
            Horas! Terima kasih atas partisipasi Anda. Data survei telah kami simpan dengan aman untuk kemajuan layanan <strong>Diskominfo Kabupaten Toba</strong>.
        </p>
        
        <a href="/" class="btn btn-home shadow">
            <i class="fas fa-arrow-left me-2"></i> Kembali Sekarang
        </a>

        <div class="countdown">
            Mengalihkan otomatis dalam <span id="timer" class="fw-bold text-dark">5</span> detik...
        </div>
    </div>

    <script>
        let timeLeft = 5;
        const timerElement = document.getElementById('timer');
        
        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = "/";
            }
        }, 1000);
    </script>
</body>
</html>