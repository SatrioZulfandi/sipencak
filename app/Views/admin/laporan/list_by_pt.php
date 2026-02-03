<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --bg-card: #ffffff;
        --bg-body: #f8fafc;
        --shadow-elite: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
    }

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* --- FILTER CARD --- */
    .filter-card-elite {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        transition: all 0.3s ease;
    }

    .filter-card-elite:hover {
        box-shadow: var(--shadow-elite);
        transform: translateY(-2px);
    }

    .form-select-elite {
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dark);
        background-color: #f8fafc;
        cursor: pointer;
        border: none;
        /* Borderless internal select sesuai preferensi */
        outline: 1px solid var(--border-color);
    }

    /* --- DATA CARD ELITE --- */
    .report-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .report-card:hover {
        border-color: var(--primary);
        box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.1), 0 10px 10px -5px rgba(37, 99, 235, 0.04);
        transform: translateY(-5px);
    }

    .report-badge-status {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 10px;
        letter-spacing: 0.025em;
    }

    /* --- BUTTON ELITE --- */
    .btn-elite-primary {
        background: var(--primary);
        color: #fff !important;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 0.8rem;
        border: none;
        transition: all 0.25s;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-elite-primary:hover {
        background: var(--primary-hover);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    /* --- PAGINATION FIX DISPLAY --- */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3rem;
        padding: 1.25rem 1.5rem;
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-elite);
    }

    .pagination-elite .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination-elite .page-link {
        min-width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.8rem;
        transition: all 0.2s;
    }

    .pagination-elite .active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff !important;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
    }

    .pagination-elite .page-item:hover:not(.active) .page-link {
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .pagination-wrapper {
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">
    <div class="row align-items-center mb-5 g-4">
        <div class="col-md-7">
            <div class="d-flex align-items-center gap-3 mb-2">
                <a href="<?= site_url('admin/laporan') ?>" class="text-muted text-decoration-none small fw-bold">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
            </div>
            <h2 class="fw-bold mb-1" style="color: var(--text-dark); letter-spacing: -0.03em;">Laporan Pencairan</h2>
            <p class="text-muted small mb-0">Manajemen histori dan arsip pencairan dana bantuan akademik 2026</p>
        </div>

        <div class="col-md-5">
            <div class="filter-card-elite p-3 d-flex align-items-center justify-content-md-end gap-3">
                <span class="small fw-bold text-muted"><i class="fas fa-filter me-1"></i> Tahun:</span>
                <form method="get" id="filterForm" class="mb-0">
                    <select name="tahun" id="tahun" class="form-select-elite" onchange="this.form.submit()">
                        <?php
                        $tahun_sekarang = date('Y');
                        for ($i = $tahun_sekarang; $i >= $tahun_sekarang - 5; $i--) :
                        ?>
                            <option value="<?= $i ?>" <?= ($tahun_terpilih == $i) ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <?php if (!empty($pencairans)) : ?>
            <?php foreach ($pencairans as $item): ?>
                <?php
                $semester = ucfirst($item['periode']);
                $tahun = date('Y', strtotime($item['tanggal_entry']));
                ?>
                <div class="col-xl-4 col-md-6">
                    <div class="report-card p-4">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <h5 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.01em;"><?= esc($semester) ?></h5>
                                <span class="text-muted" style="font-size: 0.75rem;">Arsip Entry: <?= date('d M Y', strtotime($item['tanggal_entry'])) ?></span>
                            </div>
                            <span class="report-badge-status <?= $item['status'] == 'Selesai' ? 'bg-success text-white' : 'bg-primary text-white' ?>">
                                <?= esc($item['status']) ?>
                            </span>
                        </div>

                        <div class="p-3 rounded-4 mb-4" style="background: #f8fafc; border: 1px solid #f1f5f9;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small">Kategori</span>
                                <span class="fw-bold small text-dark"><?= esc($item['kategori_penerima']) ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small">Total Mahasiswa</span>
                                <span class="fw-bold text-primary"><?= number_format($item['jumlah_mahasiswa'], 0, ',', '.') ?> Mhs</span>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <a href="<?= site_url('admin/laporan-detail/' . $item['id']) ?>" class="btn-elite-primary w-100">
                                <i class="fas fa-external-link-alt"></i> Detail Laporan Lengkap
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center py-5">
                <div class="mb-3 opacity-25">
                    <i class="fas fa-inbox fa-5x text-muted"></i>
                </div>
                <h5 class="text-muted fw-bold">Data Tidak Ditemukan</h5>
                <p class="text-muted small">Belum ada laporan pencairan untuk tahun <?= $tahun_terpilih ?></p>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($pencairans)) : ?>
        <div class="pagination-wrapper">
            <div class="text-muted fw-bold" style="font-size: 0.8rem;">
                <?php
                $currentPage = $pager->getCurrentPage('default');
                $perPage     = 10;
                $totalData   = $pager->getTotal('default');

                $from = ($currentPage - 1) * $perPage + 1;
                $to   = min($from + count($pencairans) - 1, $totalData);
                ?>
                Menampilkan <span class="text-primary"><?= $from ?> - <?= $to ?></span> dari <span class="text-dark"><?= $totalData ?></span> laporan
            </div>
            <div class="pagination-elite">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>