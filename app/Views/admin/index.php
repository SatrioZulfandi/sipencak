<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    :root {
        --brand: #2563eb;
        --brand-light: #dbeafe;
        --surface: #ffffff;
        --background: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
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

    /* --- MODERN HERO (ADAPTIVE) --- */
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

    /* --- ADAPTIVE STATS GRID --- */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        /* 2 Kolom di mobile */
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 992px) {
        .stats-container {
            grid-template-columns: repeat(3, 1fr);
            /* 3 Kolom di PC */
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

    /* --- CONTENT GRID (PC: 2 COL, MOBILE: 1 COL) --- */
    .main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem; /* Updated spacing */
    }

    @media (min-width: 1200px) {
        .main-grid {
            grid-template-columns: 2fr 1fr;
        }
    }

    .glass-panel {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: 2rem; /* Updated padding */
        border: 1px solid #e2e8f0;
        box-shadow: var(--shadow-sm);
    }

    /* --- MOBILE OPTIMIZED NEWS --- */
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

    .news-tile:active {
        transform: scale(0.98);
    }

    .news-tile:hover {
        border-color: var(--brand);
        background: white;
    }

    .tile-date {
        min-width: 48px;
        height: 48px;
        background: var(--brand-light);
        color: var(--brand);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.9rem;
    }

    /* --- CHART CONTAINER --- */
    .chart-box {
        position: relative;
        height: 240px;
        width: 100%;
    }

    .btn-brand {
        background: var(--brand);
        color: white !important;
        /* Memastikan teks tetap putih */
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }

    .btn-brand:hover {
        background-color: #1d4ed8;
        /* Biru yang lebih pekat, bukan putih */
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
        /* Efek glow biru */
    }

    .btn-brand:active {
        transform: translateY(0);
    }

    .dot-online {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: pulse-green-dot 2s infinite;
    }

    @keyframes pulse-green-dot {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    /* Tambahan animasi hover agar logo terasa hidup */
    .hero-logo-container:hover {
        transform: scale(1.05) rotate(2deg) !important;
        background: rgba(255, 255, 255, 0.12) !important;
        border-color: rgba(255, 255, 255, 0.3) !important;
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

                <a href="<?= base_url('panduan-admin') ?>" class="btn btn-white text-primary fw-bold rounded-pill px-4 py-2 mt-2 mb-3 shadow-sm hover-scale" style="background: white;">
                    <i class="fas fa-book-reader me-2"></i> Baca Panduan Penggunaan
                </a>
                
                <style>
                    .hover-scale { transition: transform 0.2s; }
                    .hover-scale:hover { transform: scale(1.05); }
                </style>

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

    <!-- --- QUICK ACCESS MENU --- -->
    <style>
        .quick-access-card {
            border-radius: 24px;
            padding: 2rem 1.8rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-decoration: none !important;
            color: white !important;
            height: 100%;
            min-height: 220px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.15);
        }

        .quick-access-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.25);
            text-decoration: none !important;
        }

        .quick-icon-large {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .quick-title-large {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .quick-subtitle {
            font-size: 0.85rem;
            font-weight: 500;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .bg-icon-decor {
            position: absolute;
            right: -25px;
            bottom: -35px;
            font-size: 10rem;
            opacity: 0.12;
            transform: rotate(-15deg);
            pointer-events: none;
            transition: transform 0.4s ease;
        }

        .quick-access-card:hover .bg-icon-decor {
            transform: rotate(0deg) scale(1.1);
        }

        /* --- THEMES --- */
        .theme-blue {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
        }
        
        .theme-orange {
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
        }
        
        .theme-green {
            background: linear-gradient(135deg, #047857 0%, #10b981 100%);
        }
        
        .theme-slate {
            background: linear-gradient(135deg, #334155 0%, #64748b 100%);
        }

        /* Header Style */
        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    </style>

    <div class="mb-5 px-1">
        <div class="section-header">
            <i class="fas fa-th-large text-primary"></i> 
            Menu Akses Cepat
        </div>

        <div class="row g-4">
            <!-- 1. Verifikasi Status (Blue) -->
            <div class="col-md-6 col-xl-3">
                <a href="<?= base_url('verifikasi-pembaharuan-status') ?>" class="quick-access-card theme-blue">
                    <div class="quick-icon-large">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <div class="quick-title-large">Verifikasi Data<br>Mahasiswa</div>
                        <div class="quick-subtitle">
                            <i class="fas fa-search"></i> Cek Status & Validasi
                        </div>
                    </div>
                    <i class="fas fa-rocket bg-icon-decor"></i>
                </a>
            </div>

            <!-- 2. Laporan Pencairan (Orange) -->
            <div class="col-md-6 col-xl-3">
                <a href="<?= base_url('admin/laporan') ?>" class="quick-access-card theme-orange">
                    <div class="quick-icon-large">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <div class="quick-title-large">Laporan<br>Pencairan</div>
                        <div class="quick-subtitle">
                            <i class="fas fa-chart-bar"></i> Rekapitulasi Dana
                        </div>
                    </div>
                    <i class="fas fa-file-alt bg-icon-decor"></i>
                </a>
            </div>

            <!-- 3. Manajemen Mahasiswa (Green) -->
            <div class="col-md-6 col-xl-3">
                <a href="<?= base_url('mahasiswa-list') ?>" class="quick-access-card theme-green">
                    <div class="quick-icon-large">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="quick-title-large">Database<br>Mahasiswa</div>
                        <div class="quick-subtitle">
                            <i class="fas fa-database"></i> Master Data Utama
                        </div>
                    </div>
                    <i class="fas fa-user-graduate bg-icon-decor" style="right: -40px;"></i>
                </a>
            </div>

            <!-- 4. Log Aktivitas (Slate) -->
            <div class="col-md-6 col-xl-3">
                <a href="<?= base_url('activity-logs') ?>" class="quick-access-card theme-slate">
                    <div class="quick-icon-large">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <div class="quick-title-large">Riwayat<br>Aktivitas</div>
                        <div class="quick-subtitle">
                            <i class="fas fa-clock"></i> Log Sistem Admin
                        </div>
                    </div>
                    <i class="fas fa-clipboard-list bg-icon-decor"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="stats-container">
        <?php
        $items = [
            ['Mhs.', $jumlah_mahasiswa, 'fa-user-graduate', '#dcfce7', '#10b981'],
            ['Verifikator', $jumlah_userpt, 'fa-user-check', '#ecfeff', '#0891b2'],
            ['Pencairan', $jumlah_pencairan, 'fa-wallet', '#fef3c7', '#d97706'],
        ];
        foreach ($items as $item) : ?>
            <div class="stat-card">
                <div class="stat-icon" style="background: <?= $item[3] ?>; color: <?= $item[4] ?>;">
                    <i class="fas <?= $item[2] ?>"></i>
                </div>
                <div>
                    <div class="text-muted small fw-700 text-uppercase"><?= $item[0] ?></div>
                    <div class="h4 fw-800 mb-0 mt-1"><?= is_numeric($item[1]) ? number_format($item[1]) : $item[1] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="main-grid">
        <div class="glass-panel">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="fw-800 mb-0 d-flex align-items-center gap-2">
                    <i class="fas fa-tasks text-primary"></i> Action Center
                </h6>
                <span class="badge bg-light text-muted rounded-pill border px-3 py-2">Butuh Tindakan</span>
            </div>
            
            <div class="d-flex flex-column" style="gap: 2rem !important;">
                
                <!-- 1. Sedang Diproses (Solid Blue) -->
                <a href="<?= base_url('verifikasi-pembaharuan-status?status=Diproses') ?>" class="action-card theme-blue text-decoration-none text-white">
                    <div class="d-flex align-items-center justify-content-between w-100 position-relative z-1">
                        <div class="d-flex align-items-center gap-5">
                            <div class="action-icon-wrapper glass-icon">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                            <div>
                                <div class="action-number"><?= number_format($jumlah_diproses) ?></div>
                                <div class="action-label text-white-50">Sedang Diproses</div>
                            </div>
                        </div>
                        <div class="btn btn-sm btn-glass rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                    <!-- Decor Icon -->
                    <i class="fas fa-hourglass-half bg-action-decor"></i>
                </a>

                <!-- 2. Perlu Revisi / Ditolak (Solid Orange) -->
                <a href="<?= base_url('verifikasi-pembaharuan-status?status=Ditolak') ?>" class="action-card theme-orange text-decoration-none text-white">
                    <div class="d-flex align-items-center justify-content-between w-100 position-relative z-1">
                        <div class="d-flex align-items-center gap-5">
                            <div class="action-icon-wrapper glass-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div>
                                <div class="action-number"><?= number_format($jumlah_ditolak) ?></div>
                                <div class="action-label text-white-50">Dalam Perbaikan (Revisi)</div>
                            </div>
                        </div>
                        <div class="btn btn-sm btn-glass rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                            Cek <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                    <!-- Decor Icon -->
                    <i class="fas fa-exclamation-triangle bg-action-decor"></i>
                </a>

                 <!-- 3. Monitoring Draft (Solid Slate) -->
                 <a href="<?= base_url('admin/pencairan/draft') ?>" class="action-card theme-slate text-decoration-none text-white">
                    <div class="d-flex align-items-center justify-content-between w-100 position-relative z-1">
                        <div class="d-flex align-items-center gap-5">
                            <div class="action-icon-wrapper glass-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <div class="action-number"><?= number_format($jumlah_draft) ?></div>
                                <div class="action-label text-white-50">Draft PT (Belum Diajukan)</div>
                            </div>
                        </div>
                        <div class="btn btn-sm btn-glass rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                            Lihat <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                    <!-- Decor Icon -->
                    <i class="fas fa-save bg-action-decor"></i>
                </a>
            </div>

            <style>
                .action-card {
                    display: flex;
                    align-items: center;
                    padding: 1.5rem;
                    border-radius: 20px;
                    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                    position: relative;
                    overflow: hidden;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                    border: none;
                    text-decoration: none !important; /* Fix underline */
                }

                .action-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2);
                    text-decoration: none !important;
                }
                
                .action-card * {
                    text-decoration: none !important;
                }
                
                .bg-action-decor {
                    position: absolute;
                    right: -10px;
                    bottom: -20px;
                    font-size: 8rem;
                    opacity: 0.12;
                    transform: rotate(-15deg);
                    pointer-events: none;
                    transition: transform 0.4s ease;
                }

                .action-card:hover .bg-action-decor {
                    transform: rotate(0deg) scale(1.1);
                }

                .action-icon-wrapper {
                    width: 56px;
                    height: 56px;
                    border-radius: 16px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 1.5rem;
                    flex-shrink: 0;
                    margin-right: 1.5rem; /* Add horizontal gap explicitly */
                }

                .glass-icon {
                    background: rgba(255, 255, 255, 0.2);
                    backdrop-filter: blur(4px);
                    color: white;
                }

                .action-number {
                    font-size: 2rem;
                    font-weight: 800;
                    line-height: 1;
                    margin-bottom: 0.25rem;
                }

                .action-label {
                    font-size: 0.9rem;
                    font-weight: 600;
                }

                /* Glass Button */
                .btn-glass {
                    background: rgba(255, 255, 255, 0.2);
                    color: white;
                    backdrop-filter: blur(4px);
                    border: 1px solid rgba(255, 255, 255, 0.3);
                }
                .action-card:hover .btn-glass {
                    background: white;
                    color: #334155;
                }
            </style>
        </div>

        <!-- Right Column (Pengumuman) -->
        <div>
            <div class="glass-panel h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-800 mb-0 d-flex align-items-center gap-2" style="margin-right: 15px !important;">
                        <i class="fas fa-bullhorn text-warning"></i> Pengumuman
                    </h6>
                    <a href="<?= base_url('papan-informasi') ?>" class="text-decoration-none small fw-bold text-primary text-nowrap">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="d-flex flex-column gap-3">
                    <?php if (empty($informasi)): ?>
                        <div class="text-center py-5">
                            <div class="mb-3 text-muted opacity-50">
                                <i class="fas fa-clipboard-list fa-3x"></i>
                            </div>
                            <h6 class="fw-bold text-muted">Belum ada pengumuman</h6>
                        </div>
                    <?php else: ?>
                        <?php foreach ($informasi as $info): ?>
                            <div class="announcement-card position-relative">
                                <div class="d-flex align-items-center">
                                    <!-- Date Box (Gradient Blue) -->
                                    <div class="date-box flex-shrink-0 theme-blue text-white shadow-sm" style="margin-right: 20px !important;">
                                        <div class="date-day"><?= date('d', strtotime($info['tanggal'])) ?></div>
                                        <div class="date-month"><?= date('M', strtotime($info['tanggal'])) ?></div>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="flex-grow-1" style="min-width: 0;">
                                        <h6 class="fw-bold text-dark mb-1 line-clamp-2" style="font-size: 0.95rem; line-height: 1.4;">
                                            <?= esc($info['judul']) ?>
                                        </h6>
                                        <div class="text-muted small line-clamp-1 mb-2">
                                            Unit Layanan KIP-K
                                        </div>
                                        <a href="<?= base_url('informasi-detail/' . $info['id']) ?>" class="stretched-link text-decoration-none small fw-bold text-primary opacity-0 link-hover">
                                            Baca Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <style>
                    .announcement-card {
                        padding: 1rem;
                        background: #f8fafc;
                        border-radius: 16px;
                        transition: all 0.25s ease;
                        border: 1px solid transparent;
                    }

                    .announcement-card:hover {
                        background: white;
                        box-shadow: 0 10px 20px -5px rgba(0,0,0,0.08);
                        transform: translateY(-2px);
                        border-color: #e2e8f0;
                    }

                    .date-box {
                        width: 50px;
                        height: 54px;
                        border-radius: 12px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        line-height: 1;
                        /* background: linear-gradient set via theme-blue class */
                    }

                    .date-day {
                        font-size: 1.1rem;
                        font-weight: 800;
                    }

                    .date-month {
                        font-size: 0.7rem;
                        font-weight: 600;
                        text-transform: uppercase;
                        margin-top: 2px;
                        opacity: 0.9;
                    }

                    .line-clamp-2 {
                        display: -webkit-box;
                        -webkit-line-clamp: 2;
                        line-clamp: 2;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }
                    
                    .line-clamp-1 {
                        display: -webkit-box;
                        -webkit-line-clamp: 1;
                        line-clamp: 1;
                        -webkit-box-orient: vertical;
                        overflow: hidden;
                    }

                    .announcement-card:hover .link-hover {
                        opacity: 1 !important;
                    }
                </style>
            </div>
        </div>
    </div>
</div>

<script>
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";

    // Doughnut Chart
    new Chart(document.getElementById('chartUserPT').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Pending'],
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