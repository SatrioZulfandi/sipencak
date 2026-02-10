<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    /* * ELITE DASHBOARD 2026 CORE STYLES
 * Theme: Modern Blue Precision
 */

    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --bg-card: #ffffff;
        --bg-table-head: #f8fafc;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-elite: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    }

    /* --- ANIMATIONS --- */
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

    /* --- BUTTONS ELITE REFINEMENT --- */
    .btn-elite {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
        cursor: pointer;
        user-select: none;
        text-decoration: none;
    }

    .btn-primary-elite {
        background-color: var(--primary);
        color: #ffffff !important;
        border: 1px solid var(--primary);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-primary-elite:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    .btn-primary-elite:active {
        transform: translateY(0);
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.2);
    }

    .btn-outline-elite {
        background: #ffffff;
        border: 1px solid var(--border-color);
        color: var(--text-dark);
        box-shadow: var(--shadow-sm);
    }

    .btn-outline-elite:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    }

    /* --- TABLE ACTIONS --- */
    .btn-elite-action {
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .action-wrapper {
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        display: flex;
        gap: 6px;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 600;
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

    /* --- EDIT BUTTON (KUNING) --- */
    .btn-elite-action.text-warning .action-wrapper {
        /* Warna default ikon warning jika diperlukan */
        color: #f59e0b;
    }

    .btn-elite-action.text-warning:hover .action-wrapper {
        background-color: #fffbeb;
        /* Light yellow bg */
        border-color: #f59e0b;
        /* Yellow border */
        color: #d97706 !important;
        /* Darker yellow text/icon */
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(245, 158, 11, 0.25);
    }

    /* --- TRASH/DELETE BUTTON (MERAH) --- */
    .btn-elite-action.text-danger .action-wrapper {
        /* Warna default ikon danger jika diperlukan */
        color: #ef4444;
    }

    .btn-elite-action.text-danger:hover .action-wrapper {
        background-color: #fef2f2;
        /* Light red bg */
        border-color: #ef4444;
        /* Red border */
        color: #dc2626 !important;
        /* Darker red text/icon */
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(239, 68, 68, 0.25);
    }

    /* --- TABLE & CARD ELITE --- */
    .card-elite {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        margin-top: 2rem;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .card-elite:hover {
        box-shadow: var(--shadow-elite);
    }

    .table-custom-2026 {
        width: 100%;
        font-size: 0.8rem;
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
        letter-spacing: 0.025em;
    }

    .table-custom-2026 tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-custom-2026 tbody tr {
        transition: background-color 0.2s ease;
    }

    .table-custom-2026 tbody tr:hover {
        background-color: #f8fafc;
    }

    /* --- BADGES --- */
    .badge-code,
    .badge-nim {
        background: #eff6ff;
        color: var(--primary);
        font-weight: 700;
        padding: 8px 14px;
        border-radius: 10px;
        font-family: 'Monaco', 'Consolas', monospace;
    }

    /* --- REFINED PAGINATION --- */
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

    .pagination-elite .page-item:hover:not(.active) .page-link {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-2px);
        color: var(--primary);
    }

    /* --- MODAL ELITE --- */
    .modal {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(8px);
    }

    .modal-content-elite {
        border: none;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .modal-header .btn-close-custom {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.25rem;
        transition: all 0.2s;
        cursor: pointer;
        border-radius: 8px;
    }

    .modal-header .btn-close-custom:hover {
        background-color: #fee2e2;
        color: #ef4444;
        transform: rotate(90deg);
    }

    .drag-drop-area {
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        padding: 3.5rem 2rem;
        text-align: center;
        position: relative;
        background: #f8fafc;
        transition: all 0.3s ease;
    }

    .drag-drop-area:hover {
        border-color: var(--primary);
        background: #eff6ff;
    }

    .search-container {
        position: relative;
        max-width: 350px;
        /* Sedikit lebih kecil agar elegan di pojok */
        width: 100%;
    }

    .search-input-elite {
        width: 100%;
        padding: 0.6rem 2.5rem 0.6rem 2.8rem;
        /* Padding ekstra untuk ikon kiri & kanan */
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

    /* Tombol X untuk reset pencarian */
    .clear-search {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #cbd5e1;
        transition: color 0.2s;
        text-decoration: none;
    }

    .clear-search:hover {
        color: var(--danger);
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">
    <div class="row align-items-center mb-5 g-4">
        <div class="col-md-7">
            <h2 class="fw-bold mb-2" style="color: var(--text-dark); letter-spacing: -0.02em;">Manajemen Program Studi</h2>
            <p class="text-muted mb-0">Sistem administrasi data akademik berbasis Elite Dashboard</p>
        </div>
        <div class="col-md-5 d-flex justify-content-md-end gap-3">
            <button type="button" class="btn-elite btn-outline-elite" onclick="openUploadModal()">
                <i class="fas fa-file-excel text-success fa-lg"></i> Import Excel
            </button>
            <a href="<?= base_url('prodi-create') ?>" class="btn-elite btn-primary-elite">
                <i class="fas fa-plus fa-lg"></i> Tambah Prodi
            </a>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 d-flex justify-content-md-end">
            <form action="" method="get" class="search-container">
                <input type="text" name="keyword" class="search-input-elite"
                    placeholder="Cari Kode atau Nama Prodi..."
                    value="<?= esc($keyword ?? '') ?>">
                <i class="fas fa-search search-icon"></i>

                <?php if (!empty($keyword)): ?>
                    <a href="<?= base_url('prodi-list') ?>" class="clear-search" title="Bersihkan Pencarian">
                        <i class="fas fa-times-circle"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card card-elite">
        <div class="table-responsive">
            <table class="table-custom-2026">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">No</th>
                        <th style="width: 20%;">Kode Prodi</th>
                        <th style="width: 52%;">Nama Program Studi</th>
                        <th class="text-center" style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php
                        $currentPage = $pager->getCurrentPage('default');
                        $perPage = 10;
                        $no = ($currentPage - 1) * $perPage + 1;
                        ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td class="text-center text-muted fw-bold"><?= $no++ ?>.</td>
                                <td><span class="badge-code"><?= esc($row['kode_prodi']) ?></span></td>
                                <td class="fw-bold" style="color: var(--text-dark);"><?= esc($row['nama_prodi']) ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="prodi-edit/<?= $row['id'] ?>" class="btn-elite-action text-warning" title="Edit">
                                            <div class="action-wrapper">
                                                <i class="fas fa-edit"></i>
                                                <span class="d-none d-md-inline">Edit</span>
                                            </div>
                                        </a>
                                        <a href="prodi-delete/<?= $row['id'] ?>" class="btn-elite-action text-danger" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                            <div class="action-wrapper">
                                                <i class="fas fa-trash"></i>
                                                <span class="d-none d-md-inline">Hapus</span>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Data program studi tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper border-top">
            <div class="text-muted fw-medium">
                Menampilkan <span><?= count($data) ?></span> dari <span><?= $pager->getTotal('default') ?></span> data prodi
            </div>
            <div class="pagination-elite">
                <?php if ($pager): ?>
                    <?= $pager->links('default', 'default_full') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="<?= base_url('prodi-import') ?>" method="post" enctype="multipart/form-data" class="modal-content modal-content-elite">

            <div class="modal-header border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0" id="uploadModalLabel">Import Excel</h4>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <a href="<?= base_url('prodi-download-template') ?>" class="text-decoration-none small fw-bold text-primary">
                        <i class="fas fa-cloud-download-alt me-1"></i> Unduh Template Excel (.xlsx)
                    </a>
                </div>

                <div class="drag-drop-area mb-4">
                    <input type="file" name="excel" id="excelInput" class="drag-input" accept=".xlsx,.xls" required>
                    <div class="mb-3">
                        <i class="fas fa-file-import fa-3x text-primary opacity-50"></i>
                    </div>
                    <h6 class="fw-bold text-dark">Klik atau Tarik File Anda</h6>
                    <p class="small text-muted mb-0">Hanya mendukung format Excel (.xlsx, .xls)</p>

                    <div id="fileInfo" class="mt-4 d-none">
                        <div class="p-3 border rounded-3 bg-white d-inline-flex align-items-center gap-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <span class="small fw-bold text-dark" id="nameLabel"></span>
                        </div>
                    </div>
                </div>

                <div class="alert bg-light border-0 d-flex gap-3 p-3">
                    <i class="fas fa-info-circle text-primary fs-5"></i>
                    <div class="small">
                        Kode PT Anda: <span class="badge bg-primary"><?= $kode_pt ?></span><br>
                        Kolom wajib di Excel: <br>
                        <code class="text-primary fw-bold">kode_pt, kode_prodi, nama_prodi</code>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 p-4 pt-0 gap-2">
                <button type="button" class="btn-elite btn-outline-elite flex-grow-1" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-elite btn-primary-elite flex-grow-1">Proses Import</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openUploadModal() {
        const modalId = '#uploadModal';
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const myModal = new bootstrap.Modal(document.querySelector(modalId));
            myModal.show();
        } else if (window.jQuery && typeof jQuery.fn.modal !== 'undefined') {
            $(modalId).modal('show');
        } else {
            const modalEl = document.querySelector(modalId);
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
            document.body.classList.add('modal-open');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('excelInput');
        const fileInfo = document.getElementById('fileInfo');
        const nameLabel = document.getElementById('nameLabel');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                nameLabel.textContent = this.files[0].name;
                fileInfo.classList.remove('d-none');
            }
        });

        // Manual Close Handler (Fallback)
        document.querySelectorAll('[data-bs-dismiss="modal"], [data-dismiss="modal"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const modal = document.getElementById('uploadModal');
                if (window.jQuery && typeof jQuery.fn.modal !== 'undefined') {
                    $(modal).modal('hide');
                } else {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-open');
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) backdrop.remove();
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>