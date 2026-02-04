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
    }

    .btn-elite-action {
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .action-wrapper {
        width: 34px;
        height: 34px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: all 0.2s ease;
    }

    .btn-elite-action:hover .action-wrapper {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Hover colors */
    .btn-elite-action.text-primary:hover .action-wrapper {
        border-color: var(--primary);
        background: #eff6ff;
    }

    .btn-elite-action.text-warning:hover .action-wrapper {
        border-color: #f59e0b;
        background: #fffbeb;
    }

    .btn-elite-action.text-danger:hover .action-wrapper {
        border-color: #ef4444;
        background: #fef2f2;
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
        transform: translateY(-1px);
    }

    /* --- TABLE ELITE --- */
    .card-elite {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        margin-top: 2rem;
        overflow: hidden;
    }

    .table-custom-2026 {
        width: 100%;
        font-size: 0.8rem;
        /* Sesuai preferensi compact typography */
        color: var(--text-dark);
        /* Ubah ke collapse agar border dan kalkulasi lebar lebih stabil */
        border-collapse: collapse;
        margin-bottom: 0;
        table-layout: auto;
    }

    .table-custom-2026 thead th {
        background: var(--bg-table-head);
        font-weight: 700;
        text-transform: uppercase;
        padding: 1rem 1.5rem;
        border-bottom: 2px solid var(--border-color);
        /* Menghindari teks header terpotong atau turun baris */
        white-space: nowrap;
        letter-spacing: 0.025em;
    }

    .table-custom-2026 tbody td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        /* Menjaga stabilitas saat hover */
        transition: background 0.2s ease;
    }

    .table-custom-2026 tbody tr {
        position: relative;
        background: transparent;
    }

    /* Perbaikan Efek Hover */
    .table-custom-2026 tbody tr:hover {
        background-color: #f8fafc;
        /* Lebih halus dari #f1f5f9 */
        /* Hapus transform scale karena memicu bug scrollbox dan blur pada teks */
        /* Gunakan box-shadow internal sebagai gantinya untuk efek 'Elite' */
        box-shadow: inset 4px 0 0 var(--primary);
    }

    /* Penanganan Khusus Scrollbox pada Kontainer */
    .table-responsive {
        border-radius: 0 0 20px 20px;
        overflow-x: auto;
        /* Custom Scrollbar tipis agar tidak merusak UI */
        scrollbar-width: thin;
        scrollbar-color: var(--border-color) transparent;
    }

    /* Styling scrollbar untuk Chrome/Edge/Safari */
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 10px;
    }

    /* --- MODAL FIXES --- */
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

    .modal-header .btn-close-custom {
        background: none;
        border: none;
        color: var(--text-muted);
        font-size: 1.5rem;
        line-height: 1;
        padding: 0.5rem;
        transition: all 0.2s;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
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

    .drag-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 20;
    }

    /* --- PAGINATION WRAPPER (INSIDE CARD) --- */
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
        transition: all 0.2s;
        background: #fff;
        font-weight: 600;
    }

    .pagination-elite .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white !important;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    }

    .pagination-elite .page-item:hover:not(.active) .page-link {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-2px);
        color: var(--primary);
    }

    .badge-nim {
        background: #eff6ff;
        color: var(--primary);
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 8px;
    }

    /* --- SEARCH BOX ELITE --- */
    .search-container {
        position: relative;
        max-width: 400px;
        width: 100%;
    }

    .search-input-elite {
        width: 100%;
        padding: 0.65rem 3rem 0.65rem 3rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background: #ffffff;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        color: var(--text-dark);
    }

    .search-input-elite:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .clear-search {
        position: absolute;
        right: 1.1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #cbd5e1;
        text-decoration: none;
        transition: color 0.2s;
    }

    .clear-search:hover {
        color: var(--danger);
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">
    <div class="row align-items-center mb-5 g-4">
        <div class="col-md-7">
            <h2 class="fw-bold mb-2" style="color: var(--text-dark); letter-spacing: -0.02em;">Manajemen Mahasiswa</h2>
            <p class="text-muted mb-0">Kelola data mahasiswa dan kategori penerima bantuan akademik 2026</p>
        </div>
        <div class="col-md-5 d-flex justify-content-md-end gap-3">
            <button type="button" class="btn-elite btn-outline-elite" onclick="openUploadModal()">
                <i class="fas fa-file-excel text-success fa-lg"></i> Import Excel
            </button>
            <a href="<?= base_url('mahasiswa-create') ?>" class="btn-elite btn-primary-elite">
                <i class="fas fa-plus fa-lg"></i> Tambah Mahasiswa
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('error_filename')): ?>
        <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0" role="alert" style="border-radius: 12px; border-left: 5px solid #ffc107 !important;">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 fs-3 text-warning"></i>
                    <div>
                        <h6 class="alert-heading fw-bold mb-1">Perhatian: Beberapa Data Gagal Diimpor</h6>
                        <p class="mb-0 small text-muted">Silakan unduh file Excel laporan di bawah ini untuk melihat detail kesalahan dan memperbaikinya.</p>
                    </div>
                </div>
                <div>
                     <a href="<?= base_url('mahasiswa-download-error/' . session()->getFlashdata('error_filename')) ?>" 
                        class="btn-elite btn-warning text-white btn-sm text-decoration-none">
                        <i class="fas fa-file-download me-2"></i> Download Data Gagal
                    </a>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>



    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert" style="border-radius: 12px; border-left: 5px solid #dc3545 !important;">
            <div class="d-flex align-items-center">
                <i class="fas fa-times-circle me-2 fs-5"></i>
                <div><?= session()->getFlashdata('error') ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0" role="alert" style="border-radius: 12px; border-left: 5px solid #ffc107 !important;">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2 fs-5"></i>
                <div><?= session()->getFlashdata('warning') ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-12">
            <form action="" method="get" class="d-flex flex-wrap gap-2 justify-content-md-end">
                <!-- Filter Prodi -->
                <select name="filter_prodi" class="form-select border-0 shadow-sm" style="width: 200px; border-radius: 12px; font-size: 0.85rem;" onchange="this.form.submit()">
                    <option value="">Semua Prodi</option>
                    <?php if (!empty($list_prodi)): ?>
                        <?php foreach($list_prodi as $lp): ?>
                            <option value="<?= $lp['id'] ?>" <?= ($filter_prodi == $lp['id']) ? 'selected' : '' ?>>
                                <?= esc($lp['nama_prodi']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <!-- Filter Angkatan -->
                <select name="filter_angkatan" class="form-select border-0 shadow-sm" style="width: 150px; border-radius: 12px; font-size: 0.85rem;" onchange="this.form.submit()">
                    <option value="">Semua Angkatan</option>
                    <?php if (!empty($list_angkatan)): ?>
                        <?php foreach($list_angkatan as $la): ?>
                            <option value="<?= $la['angkatan'] ?>" <?= ($filter_angkatan == $la['angkatan']) ? 'selected' : '' ?>>
                                <?= esc($la['angkatan']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <!-- Search Input -->
                <div class="search-container" style="max-width: 300px;">
                    <input type="text" name="keyword" class="search-input-elite"
                        placeholder="Cari NIM / Nama..."
                        value="<?= esc($keyword ?? '') ?>">
                    <i class="fas fa-search search-icon"></i>

                    <?php if (!empty($keyword)): ?>
                        <a href="<?= base_url('mahasiswa-list') ?>" class="clear-search" title="Bersihkan Pencarian">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-elite">
        <div class="table-responsive">
            <table class="table-custom-2026">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Prodi</th>
                        <th>Jenjang</th>
                        <th>Angkatan</th>
                        <th>Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php
                        // Logika penomoran dinamis sesuai konfigurasi Pager Anda (perPage = 6)
                        $currentPage = $pager->getCurrentPage('default');
                        $perPage = 10;
                        $no = ($currentPage - 1) * $perPage + 1;
                        ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td class="text-center text-muted fw-bold"><?= $no++ ?>.</td>
                                <td><span class="badge-nim"><?= esc($row['nim']) ?></span></td>
                                <td class="fw-bold" style="color: var(--text-dark);"><?= esc($row['nama']) ?></td>
                                <td><?= esc($row['nama_prodi']) ?></td>
                                <td><?= esc($row['jenjang']) ?></td>
                                <td><?= esc($row['angkatan']) ?></td>
                                <td><span class="text-muted small"><?= esc($row['kategori']) ?></span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="<?= base_url('mahasiswa-show/' . $row['id']) ?>"
                                            class="btn-elite-action text-primary"
                                            title="Lihat Detail">
                                            <div class="action-wrapper">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </a>

                                        <a href="<?= base_url('mahasiswa-edit/' . $row['id']) ?>"
                                            class="btn-elite-action text-warning"
                                            title="Edit Data">
                                            <div class="action-wrapper">
                                                <i class="fas fa-edit"></i>
                                            </div>
                                        </a>

                                        <button type="button" 
                                            class="btn-elite-action text-danger border-0 bg-transparent"
                                            onclick="confirmDelete('<?= base_url('mahasiswa-delete/' . $row['id']) ?>', '<?= esc($row['nama']) ?>')"
                                            title="Hapus">
                                            <div class="action-wrapper">
                                                <i class="fas fa-trash"></i>
                                            </div>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/fogg-no-comments.png" alt="No data" style="height: 120px;" class="mb-3 opacity-50">
                                <p class="text-muted">Data mahasiswa belum tersedia.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">
            <div class="text-muted fw-medium">
                Menampilkan <strong><?= count($data) ?></strong> dari <strong><?= $pager->getTotal('default') ?></strong> mahasiswa
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
        <form action="<?= base_url('mahasiswa-import') ?>" method="post" enctype="multipart/form-data" class="modal-content modal-content-elite">

            <div class="modal-header border-0 p-4 pb-0 d-flex justify-content-between align-items-center">
                <h4 class="fw-bold mb-0" id="uploadModalLabel">Import Mahasiswa</h4>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <a href="<?= base_url('mahasiswa-download-template') ?>" class="text-decoration-none small fw-bold text-primary">
                        <i class="fas fa-cloud-download-alt me-1"></i> Unduh Template Mahasiswa (.xlsx)
                    </a>
                </div>

                <div class="drag-drop-area mb-4">
                    <input type="file" name="excel" id="excelInput" class="drag-input" accept=".xlsx,.xls" required>
                    <div class="mb-3">
                        <i class="fas fa-file-import fa-3x text-primary opacity-50"></i>
                    </div>
                    <h6 class="fw-bold text-dark">Klik atau Tarik File Excel</h6>
                    <p class="small text-muted mb-0">Hanya format .xlsx atau .xls</p>

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
                        Kolom wajib: <br>
                        <code class="text-primary fw-bold">id_prodi, nim, nama, jenjang, angkatan</code>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 p-4 pt-0 gap-2">
                <button type="button" class="btn-elite btn-outline-elite flex-grow-1" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn-elite btn-primary-elite flex-grow-1">Mulai Import</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content modal-content-elite text-center p-4">
            <div class="mb-3">
                <div class="mx-auto d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-circle" style="width: 60px; height: 60px;">
                    <i class="fas fa-trash-alt text-danger fa-lg"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-2">Hapus Mahasiswa?</h5>
            <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus data <strong id="deleteName"></strong>? Data yang dihapus tidak dapat dikembalikan.</p>
            
            <div class="d-flex gap-2 justify-content-center">
                <button type="button" class="btn-elite btn-outline-elite w-50" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="btnConfirmDelete" class="btn-elite btn-primary-elite w-50 bg-danger border-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(url, name) {
        document.getElementById('deleteName').textContent = name;
        document.getElementById('btnConfirmDelete').setAttribute('href', url);
        
        const modalId = '#deleteModal';
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const myModal = new bootstrap.Modal(document.querySelector(modalId));
            myModal.show();
        } else if (window.jQuery && typeof jQuery.fn.modal !== 'undefined') {
            $(modalId).modal('show');
        }
    }
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

        // Close Handler Fallback
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