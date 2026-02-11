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
        --success: #10b981;
        --danger: #ef4444;
        --warning: #f59e0b;
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
        background: none;
        border: none;
        cursor: pointer;
    }

    .clear-search:hover {
        color: var(--danger);
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
        color: var(--text-muted);
        letter-spacing: 0.05em;
    }

    .table-custom-2026 tbody td {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-custom-2026 tbody tr:hover {
        background-color: #f8fafc;
        transition: background 0.2s;
    }

    /* --- BUTTONS --- */
    .btn-elite {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.6rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 10px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
        cursor: pointer;
        text-decoration: none;
    }
    
    .btn-elite-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
        border-radius: 8px;
    }

    /* --- ELEGANT BUTTONS --- */
    .btn-elite {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-primary-soft {
        background-color: #eff6ff;
        color: var(--primary);
        border: 1px solid rgba(37, 99, 235, 0.1);
    }

    .btn-primary-soft:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }

    .btn-danger-soft {
        background-color: #fef2f2;
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.1);
    }

    .btn-danger-soft:hover {
        background-color: var(--danger);
        color: white;
        border-color: var(--danger);
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);
    }

    .btn-success-main {
        background-color: #10b981;
        color: white;
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.1);
    }

    .btn-success-main:hover {
        background-color: #059669;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.25);
    }
    
    .btn-action-icon {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: var(--text-muted);
        background: white;
        border: 1px solid var(--border-color);
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-action-icon:hover {
        transform: translateY(-2px);
    }
    
    .btn-edit:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    
    .btn-delete:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    .btn-danger-soft {
        background: #fee2e2;
        color: #ef4444;
        border-color: transparent;
    }
    
    .btn-danger-soft:hover {
        background: #fecaca;
        color: #dc2626;
    }

    /* --- PAGINATION --- */
    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.25rem 1.5rem;
        background: white;
        border-top: 1px solid var(--border-color);
    }

    .pagination-elite .pagination {
        display: flex;
        gap: 6px;
        margin: 0;
    }

    .pagination-elite .page-item .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-dark);
        font-weight: 600;
        font-size: 0.8rem;
    }

    .pagination-elite .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white !important;
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
    
    .badge-finalisasi { background: #fefce8; color: #a16207; }
    .badge-ajukan-mahasiswa { background: #dcfce7; color: #15803d; }
    .badge-ditolak { background: #fee2e2; color: #991b1b; }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">

    <!-- Header Section -->
    <div class="d-flex align-items-center justify-content-between mb-5">
        <div>
            <h3 class="fw-bold mb-1" style="color: var(--text-dark);">Draft Permohonan</h3>
            <p class="text-muted small mb-0">Kelola dan lanjutkan pengajuan sebelum dikirim ke pusat</p>
        </div>
        <a href="<?= base_url('verifikasi-pembaharuan-status') ?>" class="btn btn-elite btn-white border shadow-sm">
            <i class="fas fa-arrow-left text-muted"></i> Kembali
        </a>
    </div>



    <!-- Main Table Card -->
    <div class="card card-elite">
        <!-- Card Header with Actions -->
        <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between gap-3">
            <h6 class="mb-0 fw-bold text-dark flex-shrink-0"><i class="fas fa-list-ul me-2 text-primary"></i> Daftar Antrean</h6>
            
            <div class="d-flex align-items-center gap-2 ms-auto">
                <?php if (isset($emptyDraftCount) && $emptyDraftCount > 0): ?>
                    <button type="button" class="btn btn-sm btn-danger-soft fw-bold rounded-pill px-3 py-2 text-nowrap mb-0" 
                            data-toggle="modal" data-target="#deleteEmptyModal" style="font-size: 0.75rem;">
                        <i class="fas fa-trash-alt me-1"></i> Hapus <?= $emptyDraftCount ?> Draft Kosong
                    </button>
                <?php endif; ?>

                <form action="" method="get" class="search-container mb-0 d-inline-block" style="max-width: 250px;">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="keyword" class="form-control border-start-0 bg-light" 
                               placeholder="Cari data..." value="<?= esc($keyword ?? '') ?>" style="box-shadow: none;">
                        <?php if (!empty($keyword)): ?>
                            <a href="<?= base_url('admin/pencairan/draft') ?>" class="input-group-text bg-light border-start-0 text-danger text-decoration-none" title="Reset">
                                <i class="fas fa-times"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-custom-2026">
                <thead>
                    <tr>
                        <th width="15%">Tanggal Entri</th>
                        <th width="20%">Periode</th>
                        <th width="20%">Kategori</th>
                        <th width="15%">Jumlah Mhs</th>
                        <th width="15%">Status</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($draft)): ?>
                        <?php foreach ($draft as $item): ?>
                            <tr>
                                <td class="fw-semibold">
                                    <div class="d-flex flex-column">
                                        <span><?= date('d M Y', strtotime($item['tanggal_entry'])) ?></span>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    $semester = $item['semester'] ?? '-';
                                    $year = !empty($item['tanggal_entry']) ? date('Y', strtotime($item['tanggal_entry'])) : '';
                                    ?>
                                    <span class="d-block fw-bold text-dark"><?= esc($semester) ?></span>
                                    <?php if ($year && strpos($semester, $year) === false): ?>
                                        <small class="text-muted">Tahun <?= $year ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border fw-normal px-2 py-1">
                                        <?= esc($item['kategori_penerima']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold fs-6 text-primary"><?= number_format($item['jumlah_mahasiswa'] ?? 0) ?></span>
                                    <small class="text-muted ms-1">Mhs</small>
                                </td>
                                <td>
                                    <?php if ($item['status'] === 'Finalisasi'): ?>
                                        <span class="badge-status-elite badge-finalisasi">
                                            <i class="fas fa-flag-checkered"></i> FINALISASI
                                        </span>
                                    <?php elseif ($item['status'] === 'Ajukan Mahasiswa'): ?>
                                        <span class="badge-status-elite badge-ajukan-mahasiswa">
                                            <i class="fas fa-user-plus"></i> INPUT DATA
                                        </span>
                                    <?php elseif ($item['status'] === 'Ditolak'): ?>
                                        <span class="badge-status-elite badge-ditolak" style="cursor:pointer"
                                              data-toggle="modal" data-target="#modalAlasan<?= $item['id'] ?>">
                                            <i class="fas fa-exclamation-circle"></i> DITOLAK
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary text-white"><?= $item['status'] ?></span>
                                    <?php endif; ?>
                                </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="<?= ($item['status'] === 'Ajukan Mahasiswa') ? "/verifikasi-mahasiswa/{$item['id']}" : "/finalisasi-verifikasi/{$item['id']}" ?>" 
                                               class="btn btn-elite btn-success-main btn-elite-sm" title="Lanjutkan Proses">
                                                LANJUT <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                            
                                            <a href="/verifikasi-edit/<?= $item['id'] ?>" class="btn btn-elite btn-primary-soft btn-elite-sm" title="Edit Data">
                                                <i class="fas fa-pencil-alt me-1"></i> Edit
                                            </a>
                                            
                                            <a href="javascript:void(0)" class="btn btn-elite btn-danger-soft btn-elite-sm" 
                                               data-toggle="modal" data-target="#deleteModal" data-href="/verifikasi-delete/<?= $item['id'] ?>" title="Hapus Draft">
                                                <i class="fas fa-trash-alt me-1"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center opacity-50">
                                        <i class="fas fa-folder-open fa-3x mb-3 text-muted"></i>
                                        <h6 class="text-muted fw-bold">Belum ada draft permohonan</h6>
                                        <p class="small text-muted mb-0">Mulai buat pengajuan baru di halaman sebelumnya.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                <div class="text-muted fw-medium small">
                    Menampilkan <span class="fw-bold text-dark"><?= count($draft) ?></span> dari <span class="fw-bold text-dark"><?= $pager->getTotal() ?></span> data
                </div>
                <div class="pagination-elite">
                    <?= $pager->links('default', 'default_full') ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Modals for Ditolak Status -->
    <?php foreach ($draft as $item): ?>
        <?php if ($item['status'] === 'Ditolak' && !empty($item['alasan_tolak'])): ?>
            <div class="modal fade" id="modalAlasan<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-content-elite border-0 shadow-lg rounded-4">
                        <div class="modal-header border-0 p-4 pb-0">
                            <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-exclamation-circle me-2"></i> Alasan Penolakan</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="p-3 border rounded-3 bg-danger-subtle text-danger-emphasis">
                                <?= nl2br(esc($item['alasan_tolak'])) ?>
                            </div>
                            <p class="small text-muted mt-3 mb-0 text-center">Silakan perbaiki data sesuai alasan di atas lalu ajukan kembali.</p>
                        </div>
                        <div class="modal-footer border-0 p-4 pt-0">
                            <button type="button" class="btn btn-light border w-100 fw-bold rounded-pill" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Modal Delete Individual -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-elite border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-trash-alt me-2"></i> Hapus Draft</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 text-danger opacity-50">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Konfirmasi Hapus</h6>
                    <p class="text-muted mb-0">Apakah Anda yakin ingin menghapus draft permohonan ini secara permanen?</p>
                    <p class="small text-danger mt-2 mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 justify-content-center w-100">
                    <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-light border flex-fill fw-bold rounded-pill" data-dismiss="modal">Batal</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger flex-fill fw-bold rounded-pill">Hapus Permanen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Empty Drafts -->
    <div class="modal fade" id="deleteEmptyModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-elite border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-fire me-2"></i> Hapus Draft Kosong</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3 text-danger opacity-50">
                        <i class="fas fa-trash-alt fa-3x"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Bersihkan Draft Kosong?</h6>
                    <p class="text-muted mb-0">Anda akan menghapus <strong class="text-danger"><?= isset($emptyDraftCount) ? $emptyDraftCount : 0 ?> draft kosong</strong> yang tidak memiliki data mahasiswa.</p>
                </div>
                <div class="modal-footer border-0 p-4 pt-0 justify-content-center w-100">
                     <div class="d-flex gap-2 w-100">
                        <button type="button" class="btn btn-light border flex-fill fw-bold rounded-pill" data-dismiss="modal">Batal</button>
                        <form action="<?= base_url('admin/pencairan/delete-empty-drafts') ?>" method="POST" class="flex-fill">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger w-100 fw-bold rounded-pill">Hapus Semua</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Delete Individual Modal
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('href');
            var modal = $(this);
            modal.find('#confirmDeleteBtn').attr('href', url);
        });
    });
</script>

<?= $this->endSection() ?>