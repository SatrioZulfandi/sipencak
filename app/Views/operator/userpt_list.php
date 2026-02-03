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

    .btn-action {
        height: 46px;
        padding: 0 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        transition: 0.2s;
    }

    .btn-warning-custom {
        background: #f59e0b;
        color: white;
        cursor: pointer;
    }

    .btn-primary-custom {
        background: var(--brand);
        color: white;
        text-decoration: none;
    }

    .search-wrapper {
        position: relative;
        max-width: 400px;
        width: 100%;
    }

    .search-input-modern {
        width: 100%;
        height: 46px;
        padding: 0 1rem 0 3rem;
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        font-size: 0.875rem;
        transition: 0.2s;
    }

    .search-input-modern:focus {
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

    /* ELITE PAGINATION STYLING */
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
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: white;
        color: var(--text-main);
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }

    .page-item.active .page-link {
        background: var(--brand);
        border-color: var(--brand);
        color: white;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .page-item:hover:not(.active) .page-link {
        border-color: var(--brand);
        color: var(--brand);
        background: #eff6ff;
        transform: translateY(-2px);
    }

    .page-info {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-edit-modern {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-edit-modern:hover {
        background-color: #f59e0b;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-trash-modern {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-trash-modern:hover {
        background-color: #ef4444;
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 24px;
        border: none;
    }

    .btn-close-custom {
        background: #f1f5f9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        color: var(--text-muted);
        cursor: pointer;
    }

    .drag-drop-area {
        border: 2px dashed var(--border-color);
        border-radius: 18px;
        padding: 2.5rem 1rem;
        text-align: center;
        background: #f8fafc;
        position: relative;
    }

    .drag-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 5;
    }

    .template-box {
        background: #f0f7ff;
        border: 1px solid #dbeafe;
        border-radius: 14px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
</style>

<div class="container-fluid py-4 px-lg-5">

    <div class="page-header">
        <div>
            <h4 class="fw-800 mb-1">Manajemen User</h4>
            <p class="text-muted small mb-0">Kelola data akses dan akun perguruan tinggi</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn-action btn-warning-custom" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-file-excel"></i> Upload Excel
            </button>
            <a href="userpt-create" class="btn-action btn-primary-custom">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>

    <div class="mb-4 d-flex justify-content-end">
        <form action="" method="get" class="search-wrapper">
            <i class="fas fa-search search-icon-inside"></i>
            <input type="text" name="search" class="search-input-modern" placeholder="Cari username, nama, atau PT..." value="<?= esc($search ?? '') ?>">
        </form>
    </div>

    <div class="card-table-wrapper">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Username</th>
                        <th>Perguruan Tinggi</th>
                        <th>Penanggung Jawab</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)) : ?>
                        <?php
                        $currentPage = $pager->getCurrentPage('default');
                        $perPage = 6;
                        $no = ($currentPage - 1) * $perPage + 1;
                        foreach ($data as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-800"><?= esc($row['username']) ?></td>
                                <td class="small fw-600 text-primary"><?= esc($row['perguruan_tinggi']) ?></td>
                                <td class="small"><?= esc($row['penanggung_jawab']) ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="userpt-edit/<?= $row['id'] ?>" class="btn-edit-modern" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="userpt-delete/<?= $row['id'] ?>" class="btn-trash-modern" title="Hapus User" onclick="return confirm('Hapus user ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <div class="page-info">
                Menampilkan <?= count($data) ?> data user
            </div>
            <div class="pagination-elite">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <form action="<?= base_url('userpt-import') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header border-0 px-4 pt-4 d-flex justify-content-between">
                    <h5 class="fw-800 mb-0">Import User PT</h5>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body px-4">
                    <div class="template-box mb-4">
                        <div class="bg-primary text-white rounded-3 p-2"><i class="fas fa-file-download fa-lg"></i></div>
                        <div class="flex-grow-1">
                            <p class="mb-0 fw-700 small">Gunakan Format Template</p>
                            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Download file contoh sebelum upload</p>
                        </div>
                        <a href="<?= base_url('assets/template/user.xlsx') ?>" class="btn btn-sm btn-primary fw-700 rounded-3">Unduh</a>
                    </div>
                    <div class="drag-drop-area">
                        <input type="file" name="excel" id="excelInput" class="drag-input" accept=".xlsx,.xls" required>
                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                        <p class="fw-800 mb-1" id="fileLabel">Klik atau Tarik File Excel</p>
                        <p class="text-muted small">Mendukung format .xlsx dan .xls</p>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 justify-content-between">
                    <button type="button" class="fw-700 text-muted btn" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn-action btn-primary-custom px-5">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('excelInput');
        const label = document.getElementById('fileLabel');
        if (input) {
            input.addEventListener('change', function() {
                if (this.files.length > 0) {
                    label.innerHTML = `<span class="text-success fw-800">Siap: ${this.files[0].name}</span>`;
                }
            });
        }
    });
</script>

<?= $this->endSection() ?>