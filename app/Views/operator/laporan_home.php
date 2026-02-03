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

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .btn-green-modern {
        height: 44px;
        padding: 0 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #10b981;
        color: white;
        border: none;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-green-modern:hover {
        background: #059669;
        color: white;
        transform: translateY(-1px);
    }

    /* Search Container */
    .search-wrapper {
        position: relative;
        max-width: 400px;
        width: 100%;
        margin-bottom: 1.5rem;
    }

    .search-input-elite {
        width: 100%;
        height: 46px;
        padding: 0 1rem 0 3rem;
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        font-size: 0.85rem;
        transition: 0.2s;
    }

    .search-input-elite:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon-inside {
        position: absolute;
        left: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    /* Table Styling */
    .card-table-wrapper {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom th {
        background: #f8fafc;
        padding: 1.25rem 1rem;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border-color);
    }

    .table-custom td {
        padding: 1rem;
        font-size: 0.8rem;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }

    .badge-pill-modern {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.7rem;
    }

    /* ELITE PAGINATION */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: var(--surface);
        border-top: 1px solid var(--border-color);
    }

    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 8px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: white;
        color: var(--text-main);
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: 0.2s;
    }

    .page-item.active .page-link {
        background: var(--brand);
        border-color: var(--brand);
        color: white;
    }

    .page-item:hover:not(.active) .page-link {
        background: #eff6ff;
        color: var(--brand);
        border-color: var(--brand);
    }

    .page-info {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    .btn-view-modern {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ecfdf5;
        color: #059669;
        border: 1px solid #d1fae5;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-view-modern:hover {
        background-color: #10b981;
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    <div class="page-header">
        <div>
            <h4 class="fw-800 mb-1"><?= esc($title) ?></h4>
            <p class="text-muted small mb-0">Manajemen laporan pencairan berdasarkan perguruan tinggi</p>
        </div>
        <a href="<?= base_url('Operator/pencairan/unduh-laporan') ?>" class="btn-green-modern">
            <i class="fas fa-file-excel"></i> Unduh Laporan
        </a>
    </div>

    <div class="d-flex justify-content-end">
        <form action="" method="get" class="search-wrapper">
            <i class="fas fa-search search-icon-inside"></i>
            <input type="text" name="search" class="search-input-elite" placeholder="Cari Kode atau Nama PT..." value="<?= esc($search ?? '') ?>">
        </form>
    </div>

    <div class="card-table-wrapper">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="150">Kode PT</th>
                        <th>Nama Perguruan Tinggi</th>
                        <th width="150">Status</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pts)): ?>
                        <?php foreach ($pts as $pt): ?>
                            <tr>
                                <td class="fw-800 text-primary"><?= esc($pt['kode_pt']) ?></td>
                                <td class="fw-600"><?= esc($pt['perguruan_tinggi']) ?></td>
                                <td>
                                    <?php if (isset($pt['status']) && $pt['status'] == 'aktif'): ?>
                                        <span class="badge-pill-modern bg-success text-white">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge-pill-modern bg-secondary text-white">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= site_url('laporan-list/' . $pt['id']) ?>" class="btn-view-modern" title="Lihat Laporan">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Data perguruan tinggi tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($pts)): ?>
            <div class="pagination-wrapper">
                <div class="page-info">
                    Menampilkan <span class="text-primary fw-800"><?= count($pts) ?></span> entitas
                </div>
                <div class="pagination-elite">
                    <?= $pager->links('default', 'default_full') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>