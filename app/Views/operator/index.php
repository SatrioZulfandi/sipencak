<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --brand: #2563eb;
        --brand-hover: #1d4ed8;
        --surface: #ffffff;
        --background: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --radius-lg: 24px;
        --radius-md: 16px;
        --shadow-sm: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background);
        color: var(--text-main);
        letter-spacing: -0.01em;
    }

    .hero-box {
        position: relative;
        background: radial-gradient(circle at top right, #3b82f6, #1e3a8a);
        border-radius: var(--radius-lg);
        padding: clamp(1.5rem, 5vw, 3rem);
        color: white;
        margin-bottom: 2rem;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .hero-mesh {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 1000 1000' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
        opacity: 0.3;
        pointer-events: none;
    }

    .hero-title {
        font-size: clamp(1.5rem, 4vw, 2.75rem);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 992px) {
        .stats-container {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
    }

    .stat-card {
        background: var(--surface);
        padding: clamp(1rem, 3vw, 1.5rem);
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none;
        color: inherit;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--brand);
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    @media (min-width: 1200px) {
        .main-grid {
            grid-template-columns: 2fr 1fr;
        }
    }

    .glass-panel {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
    }

    .chart-box {
        position: relative;
        height: 220px;
        width: 100%;
    }

    .news-scroll {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .news-tile {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem;
        border-radius: 14px;
        background: #f8fafc;
        text-decoration: none;
        color: inherit;
        border: 1px solid transparent;
        transition: 0.2s;
    }

    .news-tile:hover {
        border-color: var(--brand);
        background: white;
    }

    .tile-date {
        min-width: 48px;
        height: 48px;
        background: #dbeafe;
        color: var(--brand);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.9rem;
    }

    .btn-brand {
        background: var(--brand);
        color: white !important;
        border: none;
        padding: 12px 24px;
        border-radius: 14px;
        font-weight: 700;
        width: 100%;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .btn-brand:hover {
        background: var(--brand-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.3);
    }

    .dot-online {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
</style>

<div class="container-fluid py-3 py-lg-4 px-3 px-lg-5">

    <div class="hero-box">
        <div class="hero-mesh"></div>
        <div style="position: absolute; top: 50%; right: 5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; transform: translateY(-50%); z-index: 1;" class="d-none d-lg-block"></div>

        <div class="row align-items-center hero-content" style="position: relative; z-index: 2;">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center px-3 py-1 rounded-pill mb-3"
                    style="background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.15); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);">
                    <span class="dot-online"></span>
                    <span class="small fw-bold text-white uppercase" style="letter-spacing: 1.5px; font-size: 0.65rem; opacity: 0.9;">
                        Sistem Aktif
                    </span>
                </div>

                <h1 class="hero-title">Monitoring <br>Pencairan KIP-K</h1>
                <p class="text-white-50 mb-4 d-none d-md-block" style="max-width: 500px; line-height: 1.6;">
                    Panel kendali data mahasiswa penerima bantuan pendidikan di bawah naungan <strong>LLDIKTI Wilayah III Jakarta</strong>.
                </p>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <span class="badge p-2 px-3 fw-600 rounded-pill"
                        style="font-size: 0.75rem; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; margin-right: 4px;">
                        <i class="fas fa-shield-check me-1 text-info"></i> Secured
                    </span>

                    <span class="badge p-2 px-3 fw-600 rounded-pill"
                        style="font-size: 0.75rem; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; margin-right: 4px;">
                        <i class="fas fa-sync me-1 text-warning"></i> Real-time
                    </span>

                    <span class="badge p-2 px-3 fw-600 rounded-pill"
                        style="font-size: 0.75rem; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff;">
                        <i class="fas fa-cloud-upload me-1 text-success"></i> Auto-Sync
                    </span>
                </div>
            </div>

            <div class="col-lg-5 text-center text-lg-end d-none d-lg-block">
                <div class="logo-orbit-container" style="display: inline-block; position: relative; padding: 40px;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; border: 2px solid rgba(255,255,255,0.05); border-radius: 40px; transform: rotate(-5deg);"></div>

                    <div class="hero-logo-container"
                        style="background: rgba(255, 255, 255, 0.07); 
                            backdrop-filter: blur(20px); 
                            padding: 45px; 
                            border-radius: 40px; 
                            border: 1px solid rgba(255, 255, 255, 0.15); 
                            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.25);
                            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                            cursor: pointer;">

                        <img src="<?= base_url('assets/img/logo-lldikti3.jpg') ?>"
                            alt="Logo LLDIKTI III"
                            style="width: 160px; 
            height: auto; 
            border-radius: 12px; 
            opacity: 0.9; 
            transition: opacity 0.3s ease;"
                            onmouseover="this.style.opacity='1'"
                            onmouseout="this.style.opacity='0.8'">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon" style="background: #dbeafe; color: #2563eb;"><i class="fas fa-university"></i></div>
            <div>
                <div class="text-muted small fw-700 text-uppercase">Total PT</div>
                <div class="h4 fw-800 mb-0 mt-1"><?= number_format($jumlah_pt) ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #dcfce7; color: #10b981;"><i class="fas fa-users"></i></div>
            <div>
                <div class="text-muted small fw-700 text-uppercase">Mahasiswa</div>
                <div class="h4 fw-800 mb-0 mt-1"><?= number_format($jumlah_mahasiswa) ?></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #ecfeff; color: #0891b2;"><i class="fas fa-user-cog"></i></div>
            <div>
                <div class="text-muted small fw-700 text-uppercase">User PT</div>
                <div class="h4 fw-800 mb-0 mt-1"><?= number_format($jumlah_userpt) ?></div>
            </div>
        </div>
        <a href="<?= base_url('pencairan-list') ?>" class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: #d97706;"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="text-muted small fw-700 text-uppercase">Pencairan</div>
                <div class="h4 fw-800 mb-0 mt-1"><?= number_format($jumlah_pencairan) ?></div>
            </div>
        </a>
    </div>

    <div class="main-grid">
        <div class="glass-panel">
            <h6 class="fw-800 mb-4"><i class="fas fa-chart-pie me-2 text-primary"></i> Progress Laporan</h6>
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="chart-box">
                        <canvas id="chartUserPT"></canvas>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <?php $persen = round(($jumlah_userpt / 264) * 100); ?>
                            <div class="h4 fw-800 mb-0"><?= $persen ?>%</div>
                            <div class="text-muted" style="font-size: 0.6rem; font-weight: 700;">MELAPOR</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light p-4 rounded-4 mt-3 mt-md-0">
                        <div class="small fw-800 text-muted mb-3 text-uppercase">Navigasi Laporan</div>
                        <div class="mb-4">
                            <a href="<?= base_url('laporan') ?>" class="btn btn-brand py-3">
                                <i class="fas fa-file-invoice me-2"></i> Buka Daftar Laporan
                            </a>
                        </div>
                        <hr class="my-3 opacity-10">
                        <div class="d-flex justify-content-between small fw-800 mb-2">
                            <span>PT Terverifikasi</span>
                            <span class="text-primary"><?= $jumlah_userpt ?> / 264</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 20px; background: #e2e8f0;">
                            <div class="progress-bar bg-primary" style="width: <?= $persen ?>%; border-radius: 20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-panel">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-800 mb-0"><i class="fas fa-bullhorn me-2 text-warning"></i> Informasi</h6>
                <a href="<?= base_url('informasi-list') ?>" class="small text-decoration-none fw-bold">Lihat Semua</a>
            </div>
            <div class="news-scroll">
                <?php if (!empty($informasi)) : foreach (array_slice($informasi, 0, 4) as $info) : ?>
                        <a href="<?= base_url('informasi-show/' . $info['id']) ?>" class="news-tile">
                            <div class="tile-date">
                                <span><?= date('d', strtotime($info['tanggal'])) ?></span>
                                <span style="font-size: 0.55rem;"><?= date('M', strtotime($info['tanggal'])) ?></span>
                            </div>
                            <div class="text-truncate">
                                <div class="fw-700 text-truncate" style="font-size: 0.85rem;"><?= esc($info['judul']) ?></div>
                                <div class="small text-muted" style="font-size: 0.7rem;">Publikasi Terkini</div>
                            </div>
                        </a>
                    <?php endforeach;
                else : ?>
                    <p class="text-center text-muted small py-4">Belum ada informasi.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    new Chart(document.getElementById('chartUserPT').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['User PT', 'Lainnya'],
            datasets: [{
                data: [<?= $jumlah_userpt ?>, <?= 264 - $jumlah_userpt ?>],
                backgroundColor: ['#2563eb', '#f1f5f9'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '82%',
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>