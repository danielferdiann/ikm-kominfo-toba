<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Resmi IKM - Diskominfo Toba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #002366; --gold: #C5A059; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f2f5; padding: 40px 0; }
        .card-survei { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); overflow: hidden; }
        .survei-header { background: var(--primary); color: white; padding: 30px; }
        .q-card { background: white; padding: 25px; border-radius: 15px; margin-bottom: 20px; border-left: 6px solid var(--gold); }
        .btn-check:checked + .btn-outline-primary { background-color: var(--primary); border-color: var(--primary); color: white; }
        .btn-outline-primary { border-color: #dee2e6; color: #64748b; font-weight: 600; transition: 0.2s; }
        .btn-outline-primary:hover { border-color: var(--primary); color: var(--primary); background: transparent; }
        .progress { height: 12px; border-radius: 10px; background: #e9ecef; }
        .progress-bar { background: var(--gold); }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="/survei" method="POST" id="formSurvei">
                    @csrf
                    <div class="card card-survei mb-4">
                        <div class="survei-header text-center">
                            <h4 class="fw-bold m-0">SURVEI KEPUASAN MASYARAKAT</h4>
                            <p class="small mb-0 opacity-75">Diskominfo Kabupaten Toba</p>
                        </div>
                        
                        <div class="p-4 bg-light border-bottom">
                            <div class="d-flex justify-content-between small fw-bold mb-2">
                                <span>Progress Pengisian</span>
                                <span id="progress-text">0%</span>
                            </div>
                            <div class="progress">
                                <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold small">NAMA RESPONDEN</label>
                                    <input type="text" name="nama" class="form-control form-control-lg" placeholder="Masukkan nama" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold small">UNIT LAYANAN</label>
                                    <select name="layanan" id="selectLayanan" class="form-select form-select-lg" required>
                                        <option value="" selected disabled>Pilih Layanan...</option>
                                        <option value="PPID">PPID (Informasi & Dokumentasi)</option>
                                        <option value="Infrastruktur">Infrastruktur & Jaringan</option>
                                        <option value="E-Gov">E-Government (Aplikasi)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="containerPertanyaan">
                        <div class="text-center p-5 bg-white rounded-3 shadow-sm" id="placeholderPesan">
                            <p class="text-muted">Pilih <b>Unit Layanan</b> untuk memuat kuesioner.</p>
                        </div>
                    </div>

                    <div class="text-center mt-4 mb-5">
                        <button type="submit" id="btnKirim" class="btn btn-lg px-5 text-white shadow py-3" style="background: var(--primary); border-radius: 50px; font-weight: 700; display: none;">
                            KIRIM HASIL SURVEI <i class="fas fa-paper-plane ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // DATA PERTANYAAN SPESIFIK (5 Soal Per Layanan)
        const dataPertanyaan = {
            'PPID': [
                "Bagaimana pemahaman Saudara tentang prosedur permohonan informasi?",
                "Bagaimana kecepatan tanggapan petugas terhadap permintaan data?",
                "Bagaimana kelengkapan informasi publik yang tersedia?",
                "Apakah petugas memberikan penjelasan yang jelas terkait sengketa informasi?",
                "Bagaimana kemudahan akses dokumen publik di website?"
            ],
            'Infrastruktur': [
                "Bagaimana kestabilan koneksi internet/Wi-Fi publik di lokasi?",
                "Bagaimana respon tim teknis saat menangani gangguan jaringan?",
                "Bagaimana kualitas fisik perangkat/server yang dikelola?",
                "Apakah prosedur pengajuan bantuan teknis sudah mudah?",
                "Seberapa puas Anda dengan jangkauan sinyal internet?"
            ],
            'E-Gov': [
                "Bagaimana kemudahan navigasi aplikasi portal daerah?",
                "Seberapa lengkap fitur yang tersedia dalam aplikasi digital?",
                "Bagaimana keamanan data saat menggunakan aplikasi pemerintah?",
                "Apakah sistem aplikasi sudah terintegrasi antar dinas?",
                "Bagaimana kecepatan akses aplikasi saat digunakan?"
            ]
        };

        const options = ["Tidak Baik", "Kurang Baik", "Baik", "Sangat Baik"];
        const selectLayanan = document.getElementById('selectLayanan');
        const container = document.getElementById('containerPertanyaan');
        const btnKirim = document.getElementById('btnKirim');
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');

        selectLayanan.addEventListener('change', function() {
            const layanan = this.value;
            const pertanyaan = dataPertanyaan[layanan];
            
            document.getElementById('placeholderPesan').style.display = 'none';
            btnKirim.style.display = 'inline-block';
            container.innerHTML = '';
            updateProgressBar(0);

            pertanyaan.forEach((q, index) => {
                const uNum = index + 1; // u1 sampai u5
                let htmlOptions = '';
                
                options.forEach((opt, optIndex) => {
                    const val = optIndex + 1;
                    htmlOptions += `
                        <div class="col-6 col-md-3">
                            <input type="radio" class="btn-check input-survei" name="u${uNum}" id="u${uNum}_${optIndex}" value="${val}" required onchange="updateProgressBar(5)">
                            <label class="btn btn-outline-primary w-100 py-2 mb-2" for="u${uNum}_${optIndex}">${opt}</label>
                        </div>`;
                });

                container.innerHTML += `
                    <div class="q-card shadow-sm">
                        <p class="fw-bold mb-3">${uNum}. ${q}</p>
                        <div class="row g-2">${htmlOptions}</div>
                    </div>`;
            });
        });

        function updateProgressBar(total) {
            const diisi = document.querySelectorAll('.input-survei:checked').length;
            const persen = total > 0 ? Math.round((diisi / total) * 100) : 0;
            progressBar.style.width = persen + '%';
            progressText.innerText = persen + '%';
        }
    </script>
</body>
</html>