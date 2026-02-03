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
        --radius-lg: 24px;
        --radius-md: 16px;
        --shadow-elite: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        --shadow-hover: 0 20px 25px -5px rgba(37, 99, 235, 0.1), 0 10px 10px -5px rgba(37, 99, 235, 0.04);
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

    /* --- SEARCH BOX ELITE --- */
    .search-wrapper {
        position: relative;
        max-width: 480px;
        margin-bottom: 3rem;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3.5rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    /* --- GRID REFORM --- */
    .pt-grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .card-elite-pt {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        position: relative;
        display: flex;
        flex-direction: column;
        padding: 1.75rem;
        text-decoration: none !important;
        height: 100%;
    }

    .card-elite-pt:hover {
        transform: translateY(-10px);
        border-color: var(--primary);
        box-shadow: var(--shadow-hover);
    }

    /* --- BADGES & ICONS --- */
    .pt-badge-status {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        padding: 4px 12px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    .status-aktif {
        background: #dcfce7;
        color: #15803d;
    }

    .status-nonaktif {
        background: #fee2e2;
        color: #b91c1c;
    }

    .pt-icon-wrapper {
        width: 54px;
        height: 54px;
        background: #f1f5f9;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--primary);
        font-size: 1.4rem;
        transition: all 0.3s;
    }

    .card-elite-pt:hover .pt-icon-wrapper {
        background: var(--primary);
        color: white;
    }

    .pt-name {
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 3rem;
    }

    .pt-meta {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1.75rem;
        font-weight: 600;
    }

    /* --- ACTION BUTTON --- */
    .btn-view-laporan {
        margin-top: auto;
        background: #f8fafc;
        border: 1px solid var(--border-color);
        color: var(--text-dark);
        padding: 0.75rem;
        border-radius: 14px;
        font-size: 0.8rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s;
    }

    .card-elite-pt:hover .btn-view-laporan {
        background: var(--primary);
        border-color: var(--primary);
        color: white !important;
    }

    /* --- PAGINATION ELITE --- */
    .pagination-container {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    .pagination-container ul {
        display: flex;
        list-style: none;
        gap: 8px;
        padding: 0;
    }

    .pagination-container li a,
    .pagination-container li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 700;
        background: var(--bg-card);
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .pagination-container li.active a,
    .pagination-container li.active span {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    }

    .header-pill {
        background: white;
        padding: 0.6rem 1.5rem;
        border-radius: 100px;
        border: 1px solid var(--border-color);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        box-shadow: var(--shadow-elite);
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">
    <div class="row mb-5 align-items-end">
        <div class="col-lg-7">
            <h2 class="fw-bold mb-2" style="color: var(--text-dark); letter-spacing: -0.04em; font-size: 2.2rem;">Laporan Perguruan Tinggi</h2>
            <p class="text-muted mb-0">Manajemen dokumentasi dan arsip pelaporan dana akademik periode 2026</p>
        </div>
        <div class="col-lg-5 d-flex justify-content-lg-end mt-4 mt-lg-0">
            <div class="header-pill">
                <i class="fas fa-university text-primary"></i>
                <span>Database Institusi: <span class="text-primary fw-bold"><?= $pager->getTotal() ?> PT</span></span>
            </div>
        </div>
    </div>

    <form action="<?= current_url() ?>" method="get" class="search-wrapper">
        <i class="fas fa-search search-icon"></i>
        <input type="text" name="keyword" class="search-input" placeholder="Cari nama atau kode PT..." value="<?= esc($keyword ?? '') ?>">
    </form>

    <div class="pt-grid-container">
        <?php if (!empty($pts)) : ?>
            <?php foreach ($pts as $pt): ?>
                <a href="<?= site_url('admin/laporan-list/' . $pt['id']) ?>" class="card-elite-pt shadow-sm">
                    <div class="pt-badge-status <?= ($pt['status'] === 'aktif') ? 'status-aktif' : 'status-nonaktif' ?>">
                        <?= esc($pt['status']) ?>
                    </div>

                    <div class="pt-icon-wrapper">
                        <i class="fas fa-school"></i>
                    </div>

                    <div class="pt-name">
                        <?= esc($pt['perguruan_tinggi']) ?>
                    </div>

                    <div class="pt-meta">
                        <i class="fas fa-fingerprint text-primary"></i>
                        <span>KODE: <?= esc($pt['kode_pt']) ?></span>
                    </div>

                    <div class="btn-view-laporan">
                        <span>Buka Berkas Laporan</span>
                        <i class="fas fa-chevron-right small opacity-50"></i>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="grid-full-width text-center py-5 w-100" style="grid-column: 1 / -1;">
                <div class="card border-0 shadow-sm rounded-4 py-5">
                    <img src="https://illustrations.popsy.co/gray/fogg-searching.png" style="height: 180px; margin: auto;" class="mb-3">
                    <h5 class="text-muted fw-bold">Data tidak ditemukan</h5>
                    <p class="small text-muted">Coba kata kunci lain atau reset pencarian</p>
                    <div class="mt-3">
                        <a href="<?= base_url('admin/laporan') ?>" class="btn btn-primary rounded-pill px-4">Reset</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($pts)): ?>
        <div class="pagination-container">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>