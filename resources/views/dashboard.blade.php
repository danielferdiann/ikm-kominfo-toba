<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard IKM Toba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root { 
            --primary: #001e54; 
            --gold: #d4af37; 
            --bg-body: #f0f4f8;
            --card-shadow: 0 10px 40px rgba(0,0,0,0.04);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-body); 
            color: #2d3748; 
            margin: 0; 
        }
        
        .sidebar { 
            width: 260px; height: 100vh; 
            background: var(--primary); 
            position: fixed; z-index: 1000;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
        }

        .sidebar-brand { padding: 40px 20px; text-align: center; }
        .sidebar-brand h5 { color: white; font-weight: 800; letter-spacing: 1px; margin-top: 15px; }

        .nav-link-side { 
            color: rgba(255,255,255,0.5); padding: 16px 25px; display: flex; align-items: center; 
            text-decoration: none; margin: 5px 15px; border-radius: 12px; transition: 0.3s;
            font-weight: 600;
        }

        .nav-link-side:hover { color: white; background: rgba(255,255,255,0.05); }

        .nav-link-side.active { 
            background: linear-gradient(90deg, var(--gold) 0%, #b8860b 100%); 
            color: #001e54; 
        }

        /* MAIN CONTENT */
        .main-content { margin-left: 260px; padding: 40px; }

        .header-title h2 { font-weight: 800; color: var(--primary); letter-spacing: -1px; }

        .stat-card { 
            background: white; border-radius: 20px; padding: 25px; 
            border: 1px solid rgba(0,0,0,0.05); box-shadow: var(--card-shadow);
            position: relative; overflow: hidden; height: 100%;
        }

        .stat-card::after {
            content: ""; position: absolute; bottom: 0; left: 0; width: 100%; height: 4px;
        }

        .card-res::after { background: #3182ce; }
        .card-ikm::after { background: #38a169; }
        .card-mutu::after { background: var(--gold); }

        .stat-label { color: #718096; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; }
        .stat-value { font-size: 2.5rem; font-weight: 800; color: var(--primary); margin: 10px 0; }

        .glass-box { 
            background: white; border-radius: 24px; padding: 30px; 
            box-shadow: var(--card-shadow); border: 1px solid rgba(255,255,255,0.5);
        }

        .table thead th { 
            background: #f8fafc; border: none; color: #a0aec0; 
            font-size: 0.7rem; text-transform: uppercase; padding: 15px;
        }

        .table tbody td { padding: 18px 15px; border-bottom: 1px solid #edf2f7; font-weight: 600; }

        .badge-custom { padding: 8px 15px; border-radius: 8px; font-weight: 700; font-size: 0.75rem; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <img src="img/kominfotoba.png" width="70">
            <h5>ADMIN IKM</h5>
            <small class="text-white-50 fw-bold">KABUPATEN TOBA</small>
        </div>
        <nav class="mt-4">
            <a href="#" class="nav-link-side active"><i class="fas fa-th-large me-3"></i> Dashboard</a>
            <a href="#" class="nav-link-side"><i class="fas fa-database me-3"></i> Data Responden</a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="header-title d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2>Statistik Real-Time</h2>
                <p class="text-muted fw-bold">Monitoring Layanan Publik Kabupaten Toba</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-pill shadow-sm border fw-bold text-primary">
                <i class="far fa-calendar-alt me-2"></i> 12 Mar 2026
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="stat-card card-res">
                    <div class="stat-label">Total Responden</div>
                    <div class="stat-value">{{ $total_responden ?? 3 }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card-ikm">
                    <div class="stat-label">Indeks Kepuasan (IKM)</div>
                    <div class="stat-value" style="color: #2f855a;">{{ number_format($ikm_final ?? 98.33, 2) }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card card-mutu">
                    <div class="stat-label">Mutu Layanan</div>
                    <div class="stat-value" style="color: var(--gold); font-size: 1.8rem; margin-top: 20px;">SANGAT BAIK</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-7">
                <div class="glass-box">
                    <h6 class="fw-800 mb-4 text-primary text-uppercase small">Skor Per Layanan</h6>
                    <div style="height: 350px;"><canvas id="barChart"></canvas></div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="glass-box">
                    <h6 class="fw-800 mb-4 text-primary text-uppercase small">Distribusi Responden</h6>
                    <div style="height: 350px;"><canvas id="pieChart"></canvas></div>
                </div>
            </div>
        </div>

        <div class="glass-box">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-800 m-0 text-primary">Data Responden Terbaru</h5>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NAMA LENGKAP</th>
                            <th>JENIS LAYANAN</th>
                            <th>SKOR AKHIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($semua_responden ?? [] as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td><span class="badge-custom bg-primary-subtle text-primary">{{ $item->layanan }}</span></td>
                            <td class="text-success fw-bold">{{ number_format((($item->u1+$item->u2+$item->u3+$item->u4+$item->u5)/5)*25, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>Daniel Ferdian Napitupulu</td>
                            <td><span class="badge-custom bg-primary-subtle text-primary">PPID</span></td>
                            <td class="text-success fw-bold">95.00</td>
                        </tr>
                        <tr>
                            <td>Olivia Butar-Butar</td>
                            <td><span class="badge-custom bg-primary-subtle text-primary">E-Gov</span></td>
                            <td class="text-success fw-bold">100.00</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // BAR CHART
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['PPID', 'Infrastruktur', 'E-Gov'],
                datasets: [{
                    label: 'Skor',
                    data: [75, 100, 100],
                    backgroundColor: ['#001e54', '#d4af37', '#3182ce'],
                    borderRadius: 10,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, max: 100, grid: { color: '#edf2f7' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // PIE CHART
        new Chart(document.getElementById('pieChart'), {
            type: 'doughnut',
            data: {
                labels: ['PPID', 'Infrastruktur', 'E-Gov'],
                datasets: [{
                    data: [1, 1, 1],
                    backgroundColor: ['#001e54', '#d4af37', '#3182ce'],
                    borderWidth: 5,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                cutout: '70%',
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } }
            }
        });
    </script>
</body>
</html>