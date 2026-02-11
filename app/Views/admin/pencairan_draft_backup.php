<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    /* --- ELITE SYSTEM 2026 VARIABLES --- */
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --primary-soft: #eff6ff;
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
        --dark: #1e293b;
        --slate: #64748b;
        --border: #e2e8f0;
        --white: #ffffff;
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

    /* --- TABLE ELITE STYLING --- */
    .table-custom {
        width: 100%;
        font-size: 0.8rem;
        /* Compact Typography */
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-custom thead th {
        background: #f8fafc;
        color: var(--slate);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 1.25rem 1rem;
        border-bottom: 2px solid var(--border);
    }

    .table-custom tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border);
        color: var(--dark);
    }

    .table-custom tbody tr:hover {
        background-color: #fcfdfe;
        transition: 0.2s ease;
    }

    /* --- BADGE ELITE --- */
    .badge-status {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 800;
        font-size: 0.7rem;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-ajukan-mahasiswa {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-finalisasi {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-ditolak {
        background: #fee2e2;
        color: #b91c1c;
    }

    .badge-draft {
        background: #f1f5f9;
        color: #475569;
    }

    /* --- ACTION BUTTONS --- */
    .btn-action {
        min-width: 32px;
        height: 32px;
        padding: 0 10px;
        display: inline-flex;
        gap: 6px;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: 0.2s;
        border: 1px solid var(--border);
        background: white;
        font-weight: 600;
        font-size: 0.75rem;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        color: var(--primary);
    }

    .btn-edit:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .btn-delete {
        color: var(--danger);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    .btn-continue {
        padding: 6px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);
    }

    /* --- CARD & PAGINATION --- */
    .card-modern-elite {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .pagination-wrapper {
        background: #fff;
        padding: 1.25rem 1.5rem;
        border-top: 1px solid var(--border);
    }

    .pagination-elite .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .pagination-elite .page-link {
        min-width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        border: 1px solid var(--border);
        color: var(--dark);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .pagination-elite .active .page-link {
        background: var(--primary);
        border-color: var(--primary);
        color: white !important;
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">

    <div class="mb-4 d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.02em;">Draft Permohonan</h3>
            <p class="text-muted small mb-0">Kelola antrean permohonan yang belum diajukan ke pusat</p>
        </div>
        <a href="<?= base_url('verifikasi-pembaharuan-status') ?>" class="btn btn-outline-dark btn-sm fw-bold rounded-pill px-3">
            <i class="fas fa-arrow-left me-2"></i> KEMBALI
        </a>
    </div>

    <div class="card-modern-elite">
<div class="p-4 border-bottom bg-light d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0 text-primary uppercase"><i class="fas fa-layer-group me-2"></i> Antrean Draft Aktif</h6>
            <div class="d-flex align-items-center gap-2">
                <?php if (isset($emptyDraftCount) && $emptyDraftCount > 0): ?>
                <form action="<?= base_url('admin/pencairan/delete-empty-drafts') ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus semua draft kosong (<?= $emptyDraftCount ?> draft)?')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">
                        <i class="fas fa-trash-alt me-1"></i> Hapus <?= $emptyDraftCount ?> Draft Kosong
                    </button>
                </form>
                <?php endif; ?>
                <span class="badge bg-white text-primary border px-3 py-2 rounded-pill shadow-sm small fw-bold">
                    Total Keseluruhan: <?= $pager->getTotal() ?> Data
                </span>
            </div>
        </div>
        
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show m-3 rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table-custom" id="dataTable">
                    <thead>
                        <tr>
                            <th>Tanggal Entri</th>
                            <th>Periode Semester</th>
                            <th>Kategori</th>
                            <th>Jumlah Mhs</th>
                            <th>Status Draft</th>
                            <th class="text-center">Opsi Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($draft)): ?>
                            <?php foreach ($draft as $item): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= tanggal_indonesia($item['tanggal_entry']) ?></td>
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
                                    <td>
                                        <div class="small fw-bold text-slate"><?= esc($item['kategori_penerima']) ?></div>
                                    </td>
                                    <td class="fw-bold fs-6">
                                        <?= number_format($item['jumlah_mahasiswa'] ?? 0) ?> <small class="text-muted" style="font-weight: 400;">Mhs</small>
                                    </td>
                                    <td>
                                        <?php $statusClass = strtolower(str_replace(' ', '-', $item['status'])); ?>
                                        <div class="badge-status badge-<?= $statusClass ?>">
                                            <i class="fas <?= $item['status'] === 'Ditolak' ? 'fa-times-circle' : 'fa-clock' ?> small"></i>
                                            <?= esc($item['status']) ?>
                                            <?php if ($item['status'] === 'Ditolak' && !empty($item['alasan_tolak'])): ?>
                                                <button class="btn-icon-info" data-bs-toggle="modal" data-bs-target="#modalAlasan<?= $item['id'] ?>">
                                                    <i class="fas fa-info-circle ms-1"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <a href="<?= ($item['status'] === 'Ajukan Mahasiswa') ? "/verifikasi-mahasiswa/{$item['id']}" : "/finalisasi-verifikasi/{$item['id']}" ?>" class="btn btn-success btn-continue">
                                                LANJUTKAN <i class="fas fa-arrow-right"></i>
                                            </a>
                                            <a href="/verifikasi-edit/<?= $item['id'] ?>" class="btn-action btn-edit" title="Edit">
                                                <i class="fas fa-pencil-alt"></i> <span class="d-none d-md-inline">Edit</span>
                                            </a>
                                            <a href="/verifikasi-delete/<?= $item['id'] ?>" class="btn-action btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus draft ini?')">
                                                <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline">Hapus</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-inbox fa-3x text-light mb-3"></i>
                                        <p class="text-muted fw-bold">Antrean draft kosong.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if (!empty($draft)) : ?>
            <div class="pagination-wrapper d-flex justify-content-between align-items-center">
                <div class="text-muted fw-bold" style="font-size: 0.8rem;">
                    <?php
                    $currentPage = $pager->getCurrentPage('default');
                    $perPage = 10;
                    $totalData = $pager->getTotal('default');
                    $from = ($currentPage - 1) * $perPage + 1;
                    $to = min($from + count($draft) - 1, $totalData);
                    ?>
                    Menampilkan <span class="text-primary"><?= $from ?> - <?= $to ?></span> dari <span class="text-dark"><?= $totalData ?></span> antrean
                </div>
                <div class="pagination-elite">
                    <?= $pager->links('default', 'default_full') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php foreach ($draft as $item): ?>
    <?php if ($item['status'] === 'Ditolak' && !empty($item['alasan_tolak'])): ?>
        <div class="modal fade" id="modalAlasan<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-0 p-4 pb-0 d-flex justify-content-between">
                        <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-exclamation-circle me-2"></i> Feedback Penolakan</h5>
                        <button type="button" class="btn bg-light border-0 rounded-circle" data-bs-dismiss="modal" style="width:32px; height:32px;"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="p-3 border-start border-warning border-4 rounded-3 bg-light text-dark shadow-sm fw-bold small">
                            <?= nl2br(esc($item['alasan_tolak'])) ?>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-dark w-100 rounded-pill fw-bold" data-bs-dismiss="modal">TUTUP</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        // DataTables hanya digunakan untuk Searching & Sorting, Pagination pakai Pager CI4
        $('#dataTable').DataTable({
            "paging": false,
            "info": false,
            "language": {
                "search": "Cari Draft:",
                "emptyTable": "Tidak ada antrean draft saat ini"
            }
        });
    });
</script>
<?= $this->endSection() ?>
