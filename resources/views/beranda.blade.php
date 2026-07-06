<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem IKM - Diskominfo Kabupaten Toba</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary-blue: #002366;
            --dark-navy: #001529;
            --gold-accent: #C5A059;
            --gold-hover: #a8874a;
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; color: #1e293b; overflow-x: hidden; }
        h1, h2 { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -1px; }

        .navbar {
            background: rgba(0, 35, 102, 0.8) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(197, 160, 89, 0.3);
            transition: all 0.4s;
        }

        /* INI KUNCINYA BANG: Biar logo & teks brand terbaca jelas */
        .navbar-brand img {
            filter: drop-shadow(0 0 10px rgba(0,0,0,0.8));
        }
        .navbar-brand span, .navbar-brand small {
            text-shadow: 2px 2px 8px rgba(0,0,0,1);
        }

        .nav-link { 
            color: rgba(255,255,255,0.8) !important; 
            font-weight: 600; 
            text-transform: uppercase; 
            font-size: 0.75rem;
            letter-spacing: 1.5px;
            margin: 0 15px;
            transition: 0.3s;
            position: relative;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
        }  
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: -5px; left: 0;
            background-color: var(--gold-accent);
            transition: 0.3s;
        }
        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: var(--gold-accent) !important; }
        
        .btn-login-nav {
            border: 1.5px solid var(--gold-accent);
            color: var(--gold-accent) !important;
            border-radius: 50px;
            padding: 8px 25px !important;
            font-weight: 700;
            font-size: 0.7rem !important;
            transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .btn-login-nav:hover { 
            background: var(--gold-accent); 
            color: white !important; 
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(197, 160, 89, 0.3);
        }
        .hero {
            position: relative;
            height: 100vh;
            background: url("{{ asset('img/danautoba.png') }}") no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-overlay {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to bottom, rgba(0, 21, 41, 0.7), rgba(0, 35, 102, 0.85));
        }
        .hero-content { position: relative; z-index: 5; color: white; text-align: center; max-width: 900px; }
        .hero-title { 
            font-size: 4rem; 
            font-weight: 800;
            line-height: 1.1; 
            margin-bottom: 1.5rem;
        }
        .btn-mulai {
            background: var(--gold-accent);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 18px 45px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(197, 160, 89, 0.4);
        }
        .btn-mulai:hover {
            background: var(--gold-hover);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(197, 160, 89, 0.6);
            color: white;
        }
        .step-card {
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 24px;
            padding: 45px 30px;
            text-align: center;
            transition: 0.4s;
            position: relative;
        }
        .step-card:hover { 
            transform: translateY(-12px); 
            box-shadow: 0 30px 60px rgba(0,35,102,0.08);
            border-color: var(--gold-accent);
        }
        .step-icon-wrapper {
            width: 80px; height: 80px;
            background: rgba(0, 35, 102, 0.05);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 25px;
            color: var(--primary-blue);
            font-size: 2rem;
            transition: 0.4s;
        }
        .step-card:hover .step-icon-wrapper {
            background: var(--primary-blue);
            color: white;
            transform: rotate(-10deg);
        }

        footer { background: #020617; color: #94a3b8; padding: 100px 0 40px; }
        .footer-h { color: white; font-weight: 700; margin-bottom: 25px; font-size: 0.9rem; letter-spacing: 2px; }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .navbar { background: var(--primary-blue) !important; }
        }

        .navbar.scrolled {
            background: rgba(0, 21, 41, 0.95) !important;
            padding: 0.5rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            border-bottom: 2px solid var(--gold-accent);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('img/kominfotoba.png') }}" width="42" alt="Logo" class="animate__animated animate__fadeIn">
                <div class="text-white border-start ps-3 ms-3" style="border-color: rgba(255,255,255,0.4) !important;">
                    <small class="d-block opacity-100 fw-bold" style="font-size: 0.5rem; letter-spacing: 3px;">OFFICIAL SITE</small>
                    <span class="fw-extrabold" style="font-size: 0.9rem; letter-spacing: 1px;">DISKOMINFO TOBA</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/survei">Layanan Survei</a></li>
                    <li class="nav-item ms-lg-4">
                        <a class="nav-link btn-login-nav" href="/login">ADMIN ACCESS</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="animate__animated animate__fadeInDown">
                <img src="{{ asset('img/pemkabtoba.png') }}" width="100" class="mb-4">
            </div>
            <h1 class="hero-title animate__animated animate__fadeInUp">
                Suara Anda Adalah <br><span style="color: var(--gold-accent)">Energi Perubahan</span> Kami
            </h1>
            <p class="lead mb-5 animate__animated animate__fadeIn" style="letter-spacing: 3px; font-weight: 300; opacity: 0.9;">
                SISTEM INDEKS KEPUASAN MASYARAKAT • DISKOMINFO TOBA
            </p>
            <div class="animate__animated animate__zoomIn animate__delay-1s">
                <a href="/survei" class="btn btn-mulai text-uppercase">
                    Mulai Isi Survei <i class="fas fa-chevron-right ms-2"></i>
                </a>
            </div>
        </div>
    </header>

    <section class="py-5" style="background: #ffffff;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-uppercase fw-bold text-primary mb-2" style="letter-spacing: 4px; font-size: 0.7rem;">How it works</h6>
                <h2 class="display-6 fw-800 text-dark">Langkah Pengisian</h2>
                <div class="mx-auto mt-3" style="width: 60px; height: 4px; background: var(--gold-accent); border-radius: 10px;"></div>
            </div>
            
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-icon-wrapper">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Identifikasi</h5>
                        <p class="small text-muted mb-0">Lengkapi data diri singkat Anda sesuai standar pelaporan instansi publik.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-icon-wrapper">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Evaluasi</h5>
                        <p class="small text-muted mb-0">Berikan penilaian terhadap 9 unsur pelayanan yang kami sediakan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-icon-wrapper">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <h5 class="fw-bold mb-3">Selesai</h5>
                        <p class="small text-muted mb-0">Kirim jawaban Anda. Data akan diolah secara anonim untuk evaluasi internal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-md-5">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ asset('img/kominfotoba.png') }}" width="60">
                        <div class="ms-3">
                            <h5 class="text-white fw-bold mb-0">DISKOMINFO TOBA</h5>
                            <p class="small mb-0 opacity-50">Kabupaten Toba, Sumatera Utara</p>
                        </div>
                    </div>
                    <p class="small pe-md-5" style="line-height: 2; font-weight: 300;">Wujud transparansi dan komitmen kami dalam meningkatkan mutu pelayanan publik berbasis digital sesuai amanat Permenpan RB.</p>
                </div>
                
                <div class="col-md-3">
                    <h6 class="footer-h">TENTANG KAMI</h6>
                    <ul class="list-unstyled small fw-light">
                        <li class="mb-3"><a href="https://diskominfo.tobakab.go.id" target="_blank" class="text-decoration-none text-reset hover-gold">Profil Dinas</a></li>
                        <li class="mb-3"><a href="/survei" class="text-decoration-none text-reset hover-gold">Layanan Publik</a></li>
                        <li class="mb-3"><a href="https://tobakab.go.id" target="_blank" class="text-decoration-none text-reset hover-gold">Portal Kabupaten</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h6 class="footer-h">HUBUNGI KAMI</h6>
                    <div class="d-flex mb-3">
                        <i class="fa fa-map-marker-alt mt-1 me-3 text-gold"></i>
                        <p class="small mb-0">Hinalang Bagasan, Balige, <br>Kabupaten Toba, 22312</p>
                    </div>
                    <div class="d-flex mb-3">
                        <i class="fa fa-envelope mt-1 me-3 text-gold"></i>
                        <p class="small mb-0">diskominfo@tobakab.go.id</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 pt-5 border-top border-secondary text-center">
                <p style="font-size: 0.6rem; letter-spacing: 3px; font-weight: 400; color: #475569;">
                    &copy; 2026 DISKOMINFO KABUPATEN TOBA. PROTOTYPE BY DANIEL.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>`
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    </script>
</body>
</html>