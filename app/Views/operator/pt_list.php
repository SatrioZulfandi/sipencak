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

    .search-container {
        position: relative;
        max-width: 400px;
        width: 100%;
    }

    .search-input {
        width: 100%;
        height: 48px;
        padding: 0 1rem 0 3rem;
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        font-size: 0.875rem;
        transition: all 0.2s;
        color: var(--text-main);
    }

    .search-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .btn-action {
        height: 48px;
        padding: 0 1.5rem;
        border-radius: 14px;
        font-weight: 700;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-warning-custom {
        background: #f59e0b;
        color: white;
    }

    .btn-primary-custom {
        background: var(--brand);
        color: white;
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
    }

    /* Modal */
    .modal-content {
        border-radius: 24px;
        border: none;
    }

    .drag-drop-area {
        border: 2px dashed var(--border-color);
        border-radius: 18px;
        padding: 3rem 1rem;
        text-align: center;
        background: #f8fafc;
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    <div class="page-header">
        <div>
            <h4 class="fw-800 mb-1">Data Perguruan Tinggi</h4>
            <p class="text-muted small mb-0">Wilayah III - Manajemen Data Terpusat</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn-action btn-warning-custom" data-bs-toggle="modal" data-bs-target="#uploadModal">
                <i class="fas fa-file-excel"></i> Import Excel
            </button>
            <a href="pt-create" class="btn-action btn-primary-custom">
                <i class="fas fa-plus"></i> Tambah PT
            </a>
        </div>
    </div>

    <div class="mb-4 d-flex justify-content-end">
        <form action="" method="get" class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="search" class="search-input" placeholder="Cari Kode atau Nama PT..." value="<?= esc($search ?? '') ?>">
        </form>
    </div>

    <div class="card-table-wrapper">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="180">Kode PT</th>
                        <th>Nama Perguruan Tinggi</th>
                        <th width="120">Status AIPT</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td class="fw-800 text-primary"><?= esc($row['kode_pt']) ?></td>
                                <td class="fw-600"><?= esc($row['perguruan_tinggi']) ?></td>
                                <td><span class="badge rounded-pill bg-light text-dark border px-3 fw-700"><?= esc($row['aipt']) ?></span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="pt-edit/<?= $row['id'] ?>" class="btn-edit-modern"><i class="fas fa-edit"></i></a>
                                        <a href="pt-delete/<?= $row['id'] ?>" class="btn-trash-modern" onclick="return confirm('Hapus data ini?')"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <div class="page-info">
                Menampilkan <?= count($data) ?> data perguruan tinggi
            </div>
            <div class="pagination-elite">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('pt-upload') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="fw-800 mb-0">Import Database</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="drag-drop-area mb-3">
                        <input type="file" name="excel_file" id="excelInput" class="drag-input" style="position:absolute; opacity:0; width:100%; height:100%; cursor:pointer;" accept=".xlsx" required>
                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                        <p class="fw-800 mb-1" id="fileLabel">Pilih File Excel</p>
                        <p class="text-muted small mb-0">Klik area ini atau tarik file .xlsx Anda</p>
                    </div>
                    <div class="p-3 bg-light rounded-4 border">
                        <div class="d-flex align-items-center gap-3 small">
                            <i class="fas fa-info-circle text-primary"></i>
                            <div>
                                <p class="mb-0 fw-700">Format: kode_pt, perguruan_tinggi, aipt</p>
                                <a href="<?= base_url('assets/template/perguruantinggi.xlsx') ?>" class="text-primary fw-800 text-decoration-none">Unduh Template.xlsx</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="fw-700 text-muted btn border-0" data-bs-dismiss="modal">Batalkan</button>
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
        input.addEventListener('change', function() {
            if (this.files.length > 0) {
                label.innerHTML = `<span class="text-success">Siap: ${this.files[0].name}</span>`;
            }
        });
    });
</script>

<?= $this->endSection() ?>