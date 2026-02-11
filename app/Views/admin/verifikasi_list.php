<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    /* ... (CSS Root & Animations tetap sama) ... */

    /* --- ACTION BUTTONS REFINEMENT --- */
    .btn-elite-action {
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .action-wrapper {
        width: 36px;
        height: 36px;
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        color: var(--text-muted);
    }

    .btn-elite-action.text-primary:hover .action-wrapper {
        border-color: var(--primary);
        background: #eff6ff;
        color: var(--primary) !important;
        transform: translateY(-3px);
        box-shadow: 0 5px 12px rgba(37, 99, 235, 0.2);
    }

    /* --- PAGER STYLING --- */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 1.5rem;
        background: var(--bg-card);
        border-top: 1px solid var(--border-color);
        font-size: 0.8rem;
    }

    .pagination-elite .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination-elite .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.2s ease;
        background: #fff;
        font-weight: 600;
    }

    .pagination-elite .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --bg-card: #ffffff;
        --bg-table-head: #f8fafc;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    }

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* --- BUTTONS ELITE --- */
    .btn-elite {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.25s ease;
        border: 1px solid transparent;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary-elite {
        background-color: var(--primary);
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
    }

    .btn-primary-elite:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
    }

    .btn-outline-elite {
        background: white;
        border: 1px solid var(--border-color);
        color: var(--text-dark);
    }

    .btn-outline-elite:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .btn-yellow-elite {
        background-color: #f59e0b;
        color: white !important;
    }

    .btn-yellow-elite:hover {
        background-color: #d97706;
        transform: translateY(-2px);
    }

    /* --- TABLE ELITE --- */
    .card-elite {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .table-custom-2026 {
        width: 100%;
        font-size: 0.8rem;
        /* Preferensi Data Table */
        color: var(--text-dark);
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom-2026 thead th {
        background: var(--bg-table-head);
        font-weight: 700;
        text-transform: uppercase;
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid var(--border-color);
    }

    .table-custom-2026 tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-custom-2026 tbody tr:hover {
        background-color: #f1f5f9;
        /* Interactive shadow effect */
        transition: background 0.2s;
    }

    /* --- BADGES --- */
    .badge-status-elite {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-selesai {
        background: #dcfce7;
        color: #166534;
    }

    .badge-diproses {
        background: #fef9c3;
        color: #854d0e;
    }

    .badge-ditolak {
        background: #fee2e2;
        color: #991b1b;
    }

    /* --- MODAL ELITE --- */
    .modal {
        background: rgba(30, 41, 59, 0.5);
        backdrop-filter: blur(4px);
    }

    .modal-content-elite {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .btn-close-custom {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.25rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-close-custom:hover {
        color: #ef4444;
        transform: rotate(90deg);
    }

    /* --- SEARCH BOX ELITE --- */
    .search-container {
        position: relative;
        max-width: 380px;
        width: 100%;
    }

    .search-input-elite {
        width: 100%;
        padding: 0.65rem 3rem 0.65rem 2.8rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: #ffffff;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .search-input-elite:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .clear-search {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #cbd5e1;
        text-decoration: none;
        transition: color 0.2s;
    }

    .clear-search:hover {
        color: var(--danger);
    }

    /* --- NEW ACTION CARDS 2026 --- */
    .card-action-rel {
        display: block;
        padding: 2rem;
        border-radius: 20px;
        text-decoration: none !important;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .card-action-rel:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3);
        text-decoration: none !important;
    }

    .action-primary-new {
        background: linear-gradient(135deg, #2563eb 0%, #172554 100%);
        box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
    }

    .action-warning-new {
        background: linear-gradient(135deg, #f59e0b 0%, #78350f 100%);
        box-shadow: 0 10px 25px -5px rgba(245, 158, 11, 0.4);
    }

    .action-content {
        position: relative;
        z-index: 2;
    }

    .action-title {
        color: white;
        font-weight: 800;
        font-size: 1.35rem;
        margin-bottom: 0.5rem;
        letter-spacing: -0.02em;
    }

    .action-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        font-weight: 500;
    }

    .action-icon-bg {
        position: absolute;
        right: -10px;
        bottom: -20px;
        font-size: 6rem;
        opacity: 0.15;
        transform: rotate(-15deg);
        transition: all 0.4s ease;
        z-index: 1;
        color: white;
    }

    .card-action-rel:hover .action-icon-bg {
        transform: rotate(0deg) scale(1.1);
        opacity: 0.25;
        right: 10px;
        bottom: -10px;
    }

    .action-arrow {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(4px);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-bottom: 1rem;
        transition: 0.3s;
    }

    .card-action-rel:hover .action-arrow {
        background: white;
        color: var(--primary);
    }

    .action-warning-new:hover .action-arrow {
        color: #d97706;
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">
    <div class="d-flex align-items-center mb-4">
        <h6 class="text-uppercase fw-bold text-muted small mb-0" style="letter-spacing: 1px;">
            <i class="fas fa-th-large me-2 text-primary"></i> Menu Akses Cepat
        </h6>
        <div class="flex-grow-1 ms-3 border-bottom" style="border-color: rgba(0,0,0,0.1) !important;"></div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <a href="/permohonan-pencairan" class="card-action-rel action-primary-new">
                <div class="action-content">
                    <div class="action-arrow">
                        <i class="fas fa-play"></i>
                    </div>
                    <div class="action-title">Mulai Proses Pencairan</div>
                    <div class="action-subtitle">
                        <i class="far fa-calendar-check me-1"></i> Periode aktif: <?= $periode['periode'] ?>
                    </div>
                </div>
                <div class="action-icon-bg">
                    <i class="fas fa-rocket"></i>
                </div>
            </a>
        </div>
        
        <?php if (session()->get('role') === 'admin'): ?>
            <div class="col-md-6">
                <a href="/admin/pencairan/draft" class="card-action-rel action-warning-new">
                    <div class="action-content">
                        <div class="action-arrow">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <div class="action-title">Lihat Semua Draft</div>
                        <div class="action-subtitle">
                            <i class="fas fa-layer-group me-1"></i> Sistem Antrean Draft
                        </div>
                    </div>
                    <div class="action-icon-bg">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-7">
            <h3 class="fw-bold mb-1" style="color: var(--text-dark);">Histori Permohonan Pencairan</h3>
            <p class="text-muted small mb-0">Arsip pengajuan dan status verifikasi pencairan dana</p>
        </div>
        <div class="col-md-5 d-flex justify-content-md-end">
            <a href="<?= base_url('admin/pencairan/unduh-excel') ?>" class="btn-elite btn-outline-elite">
                <i class="fas fa-file-excel text-success fa-lg"></i> Unduh Semua Data
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-md-end">
            <form action="" method="get" class="search-container d-flex gap-2" style="max-width: 550px;">
                <select name="status" class="form-select border shadow-sm" style="width: auto; border-radius: 12px; font-size: 0.85rem; border-color: var(--border-color);" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="Diproses" <?= ($statusFilter ?? '') == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                    <option value="Selesai" <?= ($statusFilter ?? '') == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="Ditolak" <?= ($statusFilter ?? '') == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                </select>

                <div class="position-relative flex-grow-1">
                    <input type="text" name="keyword" class="search-input-elite"
                        placeholder="Cari Periode / Kategori..."
                        value="<?= esc($keyword ?? '') ?>">
                    <i class="fas fa-search search-icon"></i>

                    <?php if (!empty($keyword)): ?>
                        <a href="<?= base_url('verifikasi-pembaharuan-status') ?>" class="clear-search" title="Bersihkan">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-elite">
        <div class="table-responsive">
            <table class="table-custom-2026" id="dataTable">
                <thead>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Periode Semester</th>
                        <th>Kategori</th>
                        <th>Jumlah Mhs</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($histori)): ?>
                        <?php
                        // Ambil halaman saat ini
                        $currentPage = $pager->getCurrentPage('default');
                        // Karena Anda ingin 10 per halaman:
                        $perPage = 10;
                        $no = ($currentPage - 1) * $perPage + 1;
                        ?>
                        <?php foreach ($histori as $item): ?>
                            <tr>
                                <td class="fw-semibold"><?= tanggal_indonesia($item['tanggal_entry']) ?></td>
                                <td>
                                    <?php
                                    $semester = $item['semester'] ?? '';
                                    $year = !empty($item['tanggal_entry']) ? date('Y', strtotime($item['tanggal_entry'])) : '';
                                    ?>
                                    <span class="text-dark fw-bold"><?= esc($semester) ?></span>
                                    <?php if ($year && strpos($semester, $year) === false): ?>
                                        <span class="text-muted">/ <?= $year ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge bg-light text-dark border px-2 py-1"><?= $item['kategori_penerima'] ?></span></td>
                                <td class="fw-bold text-primary"><?= $item['jumlah_mahasiswa'] ?></td>
                                <td>
                                    <?php if ($item['status'] === 'Selesai'): ?>
                                        <span class="badge-status-elite badge-selesai" style="cursor:pointer"
                                            data-toggle="modal" data-target="#modalSelesai<?= $item['id'] ?>">
                                            <?= $item['status'] ?> <i class="fas fa-info-circle opacity-50"></i>
                                        </span>
                                    <?php elseif ($item['status'] === 'Ditolak'): ?>
                                        <span class="badge-status-elite badge-ditolak" style="cursor:pointer"
                                            data-toggle="modal" data-target="#modalAlasan<?= $item['id'] ?>">
                                            <?= $item['status'] ?> <i class="fas fa-exclamation-triangle opacity-50"></i>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-status-elite badge-diproses">
                                            <i class="fas fa-circle-notch fa-spin"></i> <?= $item['status'] ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <?php if ($item['status'] === 'Ditolak'): ?>
                                            <a href="/verifikasi-edit/<?= $item['id'] ?>" class="btn btn-sm btn-warning border py-2 px-3 text-dark d-flex align-items-center gap-2 justify-content-center shadow-sm" title="Revisi">
                                                <i class="fas fa-pen"></i> <span class="d-none d-md-inline">Revisi</span>
                                            </a>
                                        <?php endif; ?>
                                        <a href="/verifikasi-detail/<?= $item['id'] ?>" class="btn btn-sm btn-light border py-2 px-3 text-primary d-flex align-items-center gap-2 justify-content-center shadow-sm" title="Detail">
                                            <i class="fas fa-eye"></i> <span class="d-none d-md-inline">Detail</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada riwayat permohonan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            <div class="text-muted fw-medium" style="font-size: 0.8rem;">
                Menampilkan <strong><?= count($histori) ?></strong> dari <strong><?= $jumlah ?? $pager->getTotal() ?></strong> histori
            </div>
            <div class="pagination-elite">
                <?php if ($pager): ?>
                    <?= $pager->links('default') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php foreach ($histori as $item): ?>
    <?php if ($item['status'] === 'Selesai'): ?>
        <div class="modal fade" id="modalSelesai<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-elite">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0 text-success"><i class="fas fa-check-circle me-2"></i> Verifikasi Selesai</h5>
                        <button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <div class="mb-4">
                            <i class="fas fa-paper-plane fa-3x text-success opacity-25"></i>
                        </div>
                        <p class="text-dark fw-bold mb-1">Hasil verifikasi telah berhasil diajukan.</p>
                        <p class="small text-muted mb-4">Silakan pantau status pencairan di Portal resmi.</p>

                        <a href="https://kip-kuliah.kemdiktisaintek.go.id/sim/monitoring-pencairan"
                            target="_blank" class="btn-elite btn-primary-elite w-100">
                            <i class="fas fa-external-link-alt me-2"></i> Buka Portal SIMKIP
                        </a>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn-elite btn-outline-elite w-100" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($item['status'] === 'Ditolak'): ?>
        <div class="modal fade" id="modalAlasan<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-elite">
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-exclamation-circle me-2"></i> Alasan Penolakan</h5>
                        <button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="p-3 border rounded-4 bg-light text-dark shadow-sm">
                            <?= nl2br(esc($item['alasan_tolak'])) ?>
                        </div>
                        <p class="small text-muted mt-3 mb-0 text-center"><i class="fas fa-info-circle me-1"></i> Silakan perbaiki data sesuai alasan di atas.</p>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn-elite btn-outline-elite w-100" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fallback manual close modal jika data-bs-dismiss bermasalah
        document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const modalEl = btn.closest('.modal');
                if (window.jQuery && typeof jQuery.fn.modal !== 'undefined') {
                    $(modalEl).modal('hide');
                } else {
                    modalEl.classList.remove('show');
                    modalEl.style.display = 'none';
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>