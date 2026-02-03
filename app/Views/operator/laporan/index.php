<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --brand: #2563eb;
        --brand-hover: #1d4ed8;
        --surface: #ffffff;
        --background: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --radius-lg: 20px;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background);
        color: var(--text-main);
    }

    /* Layout Symmetries */
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .btn-back-elite {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0 1.25rem;
        height: 46px;
        border-radius: 12px;
        background: var(--surface);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        transition: 0.2s;
    }

    .btn-back-elite:hover {
        background: #f1f5f9;
        border-color: var(--brand);
        color: var(--brand);
    }

    /* Filter Bar Symmetry */
    .filter-wrapper {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1.5rem;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .search-container {
        position: relative;
        width: 100%;
    }

    .search-input-elite {
        width: 100%;
        height: 48px;
        padding: 0 1rem 0 3.25rem;
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: 0.2s;
    }

    .search-input-elite:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon-inside {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 1rem;
    }

    .action-group {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-muted);
        margin-left: 0.25rem;
    }

    .filter-select-elite {
        height: 48px;
        border-radius: 14px;
        border: 1px solid var(--border-color);
        padding: 0 1.25rem;
        font-size: 0.9rem;
        font-weight: 700;
        background-color: var(--surface);
        min-width: 140px;
        cursor: pointer;
    }

    .btn-search-submit {
        height: 48px;
        padding: 0 1.5rem;
        border-radius: 14px;
        background: var(--brand);
        color: white;
        border: none;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: 0.2s;
    }

    .btn-search-submit:hover {
        background: var(--brand-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    /* Card Grid Symmetry */
    .card-report-elite {
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .card-report-elite:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        border-color: var(--brand);
    }

    .card-report-header {
        padding: 1.75rem 1.75rem 1rem;
        border-bottom: 1px solid #f8fafc;
    }

    .pt-title {
        font-weight: 800;
        font-size: 1.05rem;
        color: var(--text-main);
        line-height: 1.5;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 3rem;
    }

    .card-report-body {
        padding: 1.25rem 1.75rem 1.75rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .report-info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
    }

    .info-label {
        color: var(--text-muted);
        font-weight: 500;
    }

    .info-value {
        color: var(--text-main);
        font-weight: 700;
    }

    .status-badge-elite {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        width: fit-content;
    }

    .badge-success-soft {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #d1fae5;
    }

    .badge-secondary-soft {
        background: #f8fafc;
        color: #64748b;
        border: 1px solid var(--border-color);
    }

    .btn-view-detail {
        margin-top: auto;
        height: 46px;
        background: #f0f7ff;
        color: var(--brand);
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-view-detail:hover {
        background: var(--brand);
        color: white;
    }

    /* Footer Pagination Symmetry */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 2rem 0;
        margin-top: 2rem;
        border-top: 1px solid var(--border-color);
    }

    .pagination {
        display: flex;
        gap: 6px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: var(--surface);
        color: var(--text-main);
        font-size: 0.9rem;
        font-weight: 700;
        text-decoration: none;
        transition: 0.2s;
    }

    .page-item.active .page-link {
        background: var(--brand);
        border-color: var(--brand);
        color: white;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    }

    .page-item:hover:not(.active) .page-link {
        border-color: var(--brand);
        color: var(--brand);
        background: #f0f7ff;
    }

    .page-info {
        font-size: 0.9rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    /* Empty State Symmetry */
    .empty-state {
        grid-column: 1 / -1;
        padding: 5rem 2rem;
        background: var(--surface);
        border-radius: 24px;
        border: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    @media (max-width: 768px) {
        .filter-wrapper {
            grid-template-columns: 1fr;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .action-group {
            width: 100%;
        }

        .filter-item {
            flex: 1;
        }

        .btn-search-submit {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="container-fluid py-5 px-4 px-lg-5">

    <div class="page-header">
        <div>
            <a href="<?= site_url('laporan') ?>" class="btn-back-elite mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <h4 class="fw-800 mb-1">Monitoring Laporan Pencairan</h4>
            <p class="text-muted small mb-0">Wilayah III • Rekapitulasi Data Tahun Akademik <?= esc($tahun_terpilih) ?></p>
        </div>
        <div class="d-none d-md-block">
            <div class="status-badge-elite badge-secondary-soft">
                <i class="fas fa-info-circle"></i>
                Total <?= count($pencairans) ?> Records
            </div>
        </div>
    </div>

    <form method="get" id="filterForm" class="filter-wrapper">
        <div class="search-container">
            <i class="fas fa-search search-icon-inside"></i>
            <input type="text" name="search" class="search-input-elite"
                placeholder="Cari nama perguruan tinggi atau kode PT..."
                value="<?= esc($search ?? '') ?>">
        </div>

        <div class="action-group">
            <div class="filter-item">
                <label class="filter-label">Periode Tahun</label>
                <select name="tahun" id="tahun" class="filter-select-elite" onchange="this.form.submit()">
                    <?php
                    $tahun_sekarang = date('Y');
                    for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 10; $i--) :
                    ?>
                        <option value="<?= $i ?>" <?= ($tahun_terpilih == $i) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn-search-submit">
                <i class="fas fa-filter"></i>
                Terapkan
            </button>
        </div>
    </form>

    <div class="row g-4">
        <?php if (!empty($pencairans)) : ?>
            <?php foreach ($pencairans as $p) : ?>
                <div class="col-xl-4 col-md-6">
                    <div class="card-report-elite">
                        <div class="card-report-header">
                            <h5 class="pt-title"><?= esc($p['perguruan_tinggi']) ?></h5>
                        </div>
                        <div class="card-report-body">
                            <div class="info-grid">
                                <div class="report-info-item">
                                    <span class="info-label">Kode PT</span>
                                    <span class="info-value"><?= esc($p['kode_pt']) ?></span>
                                </div>
                                <div class="report-info-item">
                                    <span class="info-label">Semester</span>
                                    <span class="info-value"><?= esc($p['semester']) ?></span>
                                </div>
                                <div class="report-info-item">
                                    <span class="info-label">Kapasitas</span>
                                    <span class="info-value"><?= esc($p['jumlah_mahasiswa']) ?> Mahasiswa</span>
                                </div>
                                <div class="report-info-item">
                                    <span class="info-label">Kategori</span>
                                    <span class="info-value"><?= esc($p['kategori_penerima']) ?></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <?php
                                $isSelesai = ($p['status'] === 'Selesai');
                                $status_text = $isSelesai ? 'Selesai Verifikasi' : 'Proses Verifikasi';
                                $badge_class = $isSelesai ? 'badge-success-soft' : 'badge-secondary-soft';
                                ?>
                                <span class="status-badge-elite <?= $badge_class ?>">
                                    <i class="fas <?= $isSelesai ? 'fa-check-circle' : 'fa-clock' ?>"></i>
                                    <?= $status_text ?>
                                </span>
                            </div>

                            <a href="<?= site_url('laporan-detail/' . $p['id']) ?>" class="btn-view-detail">
                                <span>Lihat Rincian Laporan</span>
                                <i class="fas fa-chevron-right small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="empty-state">
                <div class="mb-4" style="width: 80px; height: 80px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-folder-open fa-2x text-muted opacity-50"></i>
                </div>
                <h5 class="fw-800">Data Tidak Ditemukan</h5>
                <p class="text-muted mb-0">Maaf, kami tidak menemukan laporan pencairan untuk kriteria tersebut.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($pencairans)) : ?>
        <div class="pagination-wrapper">
            <div class="page-info">
                Menampilkan <span class="text-primary fw-800"><?= count($pencairans) ?></span> data hasil filter
            </div>
            <div class="pagination-elite">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>