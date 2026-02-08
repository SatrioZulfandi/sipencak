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
        height: 42px;
        padding: 0 1.25rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-warning-custom {
        background: #f59e0b;
        color: white;
    }

    .btn-warning-custom:hover {
        background: #d97706;
        color: white;
    }

    .btn-primary-custom {
        background: var(--brand);
        color: white;
    }

    /* Modern Action Buttons */
    .btn-table-action {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        border: 1px solid var(--border-color);
        background: white;
        text-decoration: none;
        padding: 0;
    }

    .btn-table-view {
        color: #10b981;
        border-color: #d1fae5;
        background: #f0fdf4;
    }

    .btn-table-view:hover {
        background: #10b981;
        color: white;
        transform: translateY(-2px);
    }

    .btn-table-check {
        color: #2563eb;
        border-color: #dbeafe;
        background: #eff6ff;
    }

    .btn-table-check:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-2px);
    }

    .btn-table-reject {
        color: #ef4444;
        border-color: #fee2e2;
        background: #fef2f2;
    }

    .btn-table-reject:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
    }

    /* Filter Card */
    .filter-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .form-label-custom {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--text-muted);
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control-modern {
        height: 44px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        font-size: 0.85rem;
        padding: 0 1rem;
        background-color: #fcfcfd;
        width: 100%;
    }

    .search-wrapper {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .search-input {
        padding-left: 2.8rem;
    }

    /* Table Styling */
    .card-table-wrapper {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
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
        color: var(--text-muted);
        text-transform: uppercase;
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

    .badge-status {
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.7rem;
    }

    .bg-primary-soft {
        background: #e0f2fe;
        color: #0369a1;
    }

    .bg-danger-soft {
        background: #fee2e2;
        color: #991b1b;
    }

    .bg-info-soft {
        background: #f0fdf4;
        color: #166534;
    }
</style>

<div class="container-fluid py-4 px-lg-5">

    <div class="page-header">
        <div>
            <h4 class="fw-800 mb-1">Permohonan Pencairan</h4>
            <p class="text-muted small mb-0">Histori pengajuan dan verifikasi status wilayah</p>
        </div>
        <a href="<?= base_url('operator/pencairan/unduh-excel') ?>" class="btn-action btn-warning-custom shadow-sm">
            <i class="fas fa-file-excel"></i> Unduh Excel Mahasiswa
        </a>
    </div>

    <div class="filter-card">
        <form action="" method="get" id="filterForm" class="row g-3">
            <div class="col-md-4">
                <label class="form-label-custom">Cari Data</label>
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="search" class="form-control-modern search-input" placeholder="No. SK atau Nama PT..." value="<?= esc($search ?? '') ?>">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">Perguruan Tinggi</label>
                <select name="pt" class="form-control-modern" onchange="this.form.submit()">
                    <option value="">Semua Perguruan Tinggi</option>
                    <?php foreach ($daftar_pt as $ptItem): ?>
                        <option value="<?= $ptItem['id'] ?>" <?= ($filter_pt == $ptItem['id']) ? 'selected' : '' ?>>
                            <?= esc($ptItem['perguruan_tinggi']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label-custom">Tahun</label>
                <select name="tahun" class="form-control-modern" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <?php for ($i = date('Y'); $i >= 2020; $i--): ?>
                        <option value="<?= $i ?>" <?= ($filter_tahun == $i) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn-action btn-primary-custom w-100 justify-content-center">Filter</button>
            </div>
        </form>
    </div>

    <div class="card-table-wrapper">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="100">Kode PT</th>
                        <th>Perguruan Tinggi</th>
                        <th>Periode</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Kategori</th>
                        <th>Mhs</th>
                        <th>Status</th>
                        <th width="140" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($histori)) : ?>
                        <?php foreach ($histori as $item): ?>
                            <tr>
                                <td class="fw-700"><?= esc($item['kode_pt']) ?></td>
                                <td class="fw-600 text-primary small"><?= esc($item['perguruan_tinggi']) ?></td>
                                <td><?= esc($item['semester']) ?> / <?= date('Y', strtotime($item['tanggal_entry'])) ?></td>
                                <td class="text-muted small"><?= date('d M Y', strtotime($item['tanggal_entry'])) ?></td>
                                <td class="small"><?= esc($item['kategori_penerima']) ?></td>
                                <td class="fw-700"><?= esc($item['jumlah_mahasiswa']) ?></td>
                                <td>
                                    <?php if ($item['status'] === 'Selesai'): ?>
                                        <span class="badge-status bg-primary-soft" data-toggle="modal" data-target="#modalSelesai<?= $item['id'] ?>" style="cursor: pointer;">Selesai</span>
                                    <?php elseif ($item['status'] === 'Ditolak'): ?>
                                        <span class="badge-status bg-danger-soft" data-toggle="modal" data-target="#modalAlasan<?= $item['id'] ?>" style="cursor: pointer;">Ditolak</span>
                                    <?php else: ?>
                                        <span class="badge-status bg-info-soft"><?= esc($item['status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="/pencairan-detail/<?= $item['id'] ?>" class="btn-table-action btn-table-view" title="Detail Pengajuan"><i class="fas fa-eye"></i></a>
                                        <?php if ($item['status'] === 'Diproses' && session()->get('role') === 'operator'): ?>
                                            <button type="button" class="btn-table-action btn-table-check" data-toggle="modal" data-target="#modalSelesaikan<?= $item['id'] ?>" title="Selesaikan Pengajuan"><i class="fas fa-check"></i></button>
                                            <button type="button" class="btn-table-action btn-table-reject" data-toggle="modal" data-target="#modalBatalkan<?= $item['id'] ?>" title="Tolak Pengajuan"><i class="fas fa-times"></i></button>
                                        <?php endif ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">Tidak ada data ditemukan.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <div class="page-info">
                Menampilkan <?= count($histori) ?> data pengajuan
            </div>
            <div class="pagination-elite">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    </div>
</div>

<?php foreach ($histori as $item): ?>
    <div class="modal fade" id="modalAlasan<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-800 mb-0"><i class="fas fa-exclamation-circle text-warning me-2"></i> Alasan Penolakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <div class="bg-light p-3 rounded-3 border small"><?= nl2br(esc($item['alasan_tolak'])) ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSelesai<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
                <div class="modal-header border-0 p-4">
                    <h5 class="fw-800 mb-0 text-success"><i class="fas fa-check-circle me-2"></i> Pengajuan Selesai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <p class="text-muted small">Verifikasi diajukan. Silakan cek portal monitoring:</p>
                    <a href="https://kip-kuliah.kemdiktisaintek.go.id/sim/monitoring-pencairan" target="_blank" class="btn-action btn-primary-custom d-inline-flex"><i class="fas fa-external-link-alt"></i> SIMKIP Portal</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSelesaikan<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
                <form action="<?= base_url('pencairan/selesai/' . $item['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-800 mb-0 text-success"><i class="fas fa-check-circle me-2"></i> Konfirmasi Persetujuan</h5>
                    </div>
                    <div class="modal-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-clipboard-check text-success" style="font-size: 3rem;"></i>
                        </div>
                        <p class="mb-2 text-dark fw-bold">Apakah Anda yakin ingin menyetujui pengajuan ini?</p>
                        <p class="small text-muted mb-0">Status pengajuan akan berubah menjadi <b class="text-success">Selesai</b> dan data akan diteruskan ke tahap pencairan.</p>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                        <button type="button" class="btn-action bg-light text-muted" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-action bg-success text-white">Ya, Setujui Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBatalkan<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-0" style="border-radius: 20px;">
                <form action="<?= base_url('pencairan/ditolak/' . $item['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header border-0 p-4 pb-0">
                        <h5 class="fw-800 mb-0 text-danger"><i class="fas fa-times-circle me-2"></i> Tolak Pengajuan</h5>
                    </div>
                    <div class="modal-body p-4">
                        <p class="mb-3 text-dark fw-bold text-center">Apakah Anda yakin ingin menolak pengajuan ini?</p>
                        <div class="mb-3">
                            <label class="form-label fw-700 small">Alasan Penolakan <span class="text-danger">*</span></label>
                            <textarea name="alasan" class="form-control" rows="3" placeholder="Masukkan alasan penolakan..." required></textarea>
                        </div>
                        <p class="small text-muted mb-0 text-center">Status akan berubah menjadi <b>Ditolak</b>. Mahasiswa dapat diajukan kembali di periode berikutnya.</p>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                        <button type="button" class="btn-action bg-light text-muted" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn-action bg-danger text-white">Ya, Tolak Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection() ?>