<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --success: #10b981;
        --danger: #ef4444;
        --dark: #1e293b;
        --slate: #64748b;
        --border: #e2e8f0;
        --bg-light: #f8fafc;
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

    .info-card-elite {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 24px;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1rem;
        padding: 2rem;
    }

    .info-item {
        padding: 1.25rem;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid transparent;
        transition: 0.3s ease;
    }

    .info-item:hover {
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.05);
    }

    .info-label {
        font-size: 0.65rem;
        font-weight: 800;
        color: var(--slate);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--dark);
    }

    /* --- SEARCH BOX ELITE --- */
    .search-wrapper-elite {
        position: relative;
        max-width: 320px;
        width: 100%;
    }

    .search-input-elite {
        width: 100%;
        padding: 0.6rem 1rem 0.6rem 2.8rem;
        border-radius: 12px;
        border: 1px solid var(--border);
        background: #f8fafc;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: var(--dark);
    }

    .search-input-elite:focus {
        outline: none;
        background: #ffffff;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon-elite {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate);
        font-size: 0.85rem;
        pointer-events: none;
    }

    .search-clear-elite {
        position: absolute;
        right: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate);
        text-decoration: none;
        transition: 0.2s;
    }

    .search-clear-elite:hover {
        color: var(--danger);
    }

    /* Badge & Interactive Info */
    .badge-elite {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
    }

    .badge-elite-success {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-elite-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fee2e2;
    }

    .btn-file-elite {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 12px;
        color: var(--dark);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.8rem;
        transition: 0.2s;
    }

    .btn-file-elite:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #eff6ff;
    }

    .table-elite {
        width: 100%;
        font-size: 0.8rem;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-elite thead th {
        background: #f8fafc;
        padding: 1rem;
        font-weight: 800;
        color: var(--slate);
        text-transform: uppercase;
        border-bottom: 2px solid var(--border);
    }

    .table-elite tbody td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: var(--dark);
        vertical-align: middle;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        background: #ffffff;
        border-top: 1px solid var(--border);
    }

    .elite-pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        font-size: 0.75rem;
        font-weight: 700;
        border: 1px solid var(--border);
        color: var(--slate);
    }

    .elite-pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }
</style>

<div class="container-fluid px-4 py-4 fade-in-up">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <a href="javascript:history.back()" class="btn btn-outline-dark btn-sm rounded-pill px-3 fw-bold shadow-sm mr-3">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <h4 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.02em;">Detail Permohonan</h4>
        </div>

        <?php if ($data['status'] === 'Diproses' && session()->get('role') === 'operator'): ?>
            <div class="d-flex">
                <a href="<?= base_url('verifikasi-edit/' . $data['id']) ?>" class="btn btn-warning btn-sm rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center mr-2">
                    <i class="fas fa-pen mr-2"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-sm rounded-pill px-4 fw-bold shadow-sm d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalTolakAdmin">
                    <i class="fas fa-times-circle mr-2"></i> Tolak
                </button>
            </div>
        <?php endif; ?>
    </div>

    <div class="info-card-elite">
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Kategori Penerima</div>
                <div class="info-value text-truncate"><?= esc($data['kategori_penerima']) ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">No. SK / Surat</div>
                <div class="info-value text-primary"><i class="fas fa-file-signature me-1"></i> <?= esc($data['no_sk']) ?: '-' ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Tanggal Surat</div>
                <div class="info-value"><?= tanggal_indonesia($data['tanggal']) ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Periode</div>
                <div class="info-value"><?= esc($data['semester']) ?> / <?= !empty($data['tanggal_entry']) ? date('Y', strtotime($data['tanggal_entry'])) : '-' ?></div>
            </div>
            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="mt-1">
                    <?php if ($data['status'] === 'Selesai'): ?>
                        <div class="badge-elite badge-elite-success" data-toggle="modal" data-target="#modalSelesai" style="cursor: pointer;">
                            <i class="fas fa-check-circle"></i> Selesai <i class="fas fa-info-circle opacity-50"></i>
                        </div>
                    <?php elseif ($data['status'] === 'Ditolak'): ?>
                        <div class="badge-elite badge-elite-danger" data-toggle="modal" data-target="#modalTolak" style="cursor: pointer;">
                            <i class="fas fa-times-circle"></i> Ditolak <i class="fas fa-info-circle opacity-50"></i>
                        </div>
                    <?php else: ?>
                        <span class="badge bg-light text-dark border fw-bold px-3 py-2 rounded-3"><?= esc($data['status']) ?></span>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="px-4 pb-4">
            <div class="row g-3">
                <?php foreach (['sptjm' => 'SPTJM', 'sk_penetapan' => 'SK Penetapan', 'sk_pembatalan' => 'SK Pembatalan', 'berita_acara' => 'Berita Acara'] as $key => $label): ?>
                    <div class="col-md-3 col-6">
                        <?php if (!empty($data[$key])): ?>
                            <a href="<?= base_url('file/' . $data[$key]) ?>" target="_blank" class="btn-file-elite">
                                <span class="text-truncate"><?= $label ?></span>
                                <i class="fas fa-external-link-alt small opacity-50 ms-2"></i>
                            </a>
                        <?php else: ?>
                            <div class="btn-file-elite opacity-50 bg-light">
                                <span><?= $label ?></span>
                                <i class="fas fa-times small ms-2"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="info-card-elite">
        <div class="card-header bg-white border-bottom p-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <h6 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 0.1em; color: var(--slate);">Daftar Mahasiswa</h6>
                </div>
                <div class="col-md-8 d-flex justify-content-md-end gap-3 flex-wrap">
                    <form action="" method="get" class="search-wrapper-elite">
                        <i class="fas fa-search search-icon-elite"></i>
                        <input type="text" name="keyword" class="search-input-elite"
                            placeholder="Cari Nama atau NIM..."
                            value="<?= esc($keyword ?? '') ?>">
                        <?php if (!empty($keyword)): ?>
                            <a href="<?= current_url() ?>" class="search-clear-elite">
                                <i class="fas fa-times-circle"></i>
                            </a>
                        <?php endif; ?>
                    </form>

                    <?php if ($data['status'] === 'Selesai'): ?>
                        <a href="<?= base_url('admin/pencairan/unduh-mahasiswa/' . $data['id']) ?>" class="btn btn-success btn-sm rounded-pill px-4 fw-bold shadow-sm">
                            <i class="fas fa-file-excel me-2"></i> Unduh Data
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table-elite">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Program Studi</th>
                        <th class="text-center">Jenjang</th>
                        <th class="text-center">Angkatan</th>
                        <th>Kategori</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mahasiswa)): ?>
                        <?php
                        $no = 1 + (6 * ($pager->getCurrentPage() - 1));
                        foreach ($mahasiswa as $m): ?>
                            <tr>
                                <td class="text-center text-muted fw-bold"><?= $no++ ?></td>
                                <td class="fw-bold text-primary"><?= esc($m['nim']) ?></td>
                                <td class="fw-bold text-dark"><?= esc($m['nama']) ?></td>
                                <td>
                                    <div class="fw-bold small"><?= esc($m['nama_prodi']) ?></div>
                                    <div class="text-muted" style="font-size: 10px;"><?= esc($m['kode_prodi']) ?></div>
                                </td>
                                <td class="text-center fw-medium"><?= esc($m['jenjang']) ?></td>
                                <td class="text-center"><?= esc($m['angkatan']) ?></td>
                                <td><span class="badge bg-light text-dark border-0 py-1 px-2" style="font-size: 9px; font-weight: 800;"><?= esc($m['kategori']) ?></span></td>
                                <td class="text-center">
                                    <span class="badge bg-primary-subtle text-primary border-0 fw-bold" style="font-size: 10px; background: #eff6ff;">
                                        <?= esc($m['pembaruan_status']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-user-slash fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0 fw-bold">Mahasiswa tidak ditemukan.</p>
                                <?php if (!empty($keyword)): ?>
                                    <a href="<?= current_url() ?>" class="small text-primary text-decoration-none">Reset Pencarian</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <div class="text-muted fw-bold" style="font-size: 0.75rem;">
                Menampilkan <strong><?= count($mahasiswa) ?></strong> dari <strong><?= $jumlah ?></strong> mahasiswa
            </div>
            <div class="elite-pagination">
                <?= $pager->links('default', 'papan_info_pager') ?>
            </div>
        </div>
    </div>
</div>

<?php if ($data['status'] === 'Selesai'): ?>
    <div class="modal fade" id="modalSelesai" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header bg-success text-white border-0 py-3 px-4">
                    <h6 class="modal-title fw-bold"><i class="fas fa-check-circle me-2"></i> Konfirmasi Sistem</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <i class="fas fa-cloud-upload-alt fa-3x text-success mb-4 opacity-50"></i>
                    <p class="text-muted fw-bold small mb-4">Data telah berhasil diverifikasi dan disinkronkan dengan Portal SIMKIP Pusat.</p>
                    <a href="https://kip-kuliah.kemdiktisaintek.go.id/sim/monitoring-pencairan" target="_blank" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                        Buka Monitoring SIMKIP <i class="fas fa-external-link-alt ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($data['status'] === 'Ditolak' && !empty($data['alasan_tolak'])): ?>
    <div class="modal fade" id="modalTolak" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                <div class="modal-header bg-danger text-white border-0 py-3 px-4">
                    <h6 class="modal-title fw-bold"><i class="fas fa-exclamation-circle me-2"></i> Alasan Penolakan</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <div class="bg-light p-4 rounded-4 border-start border-4 border-danger">
                        <p class="mb-0 text-dark fw-bold small" style="line-height: 1.8;">
                            <?= nl2br(esc($data['alasan_tolak'])) ?>
                        </p>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 justify-content-center">
                    <button type="button" class="btn btn-dark rounded-pill px-5 fw-bold btn-sm shadow-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($data['status'] === 'Diproses' && session()->get('role') === 'operator'): ?>
    <div class="modal fade" id="modalTolakAdmin" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                <form action="<?= base_url('verifikasi-ditolak/' . $data['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header bg-danger text-white border-0 py-3 px-4">
                        <h6 class="modal-title fw-bold"><i class="fas fa-times-circle me-2"></i> Tolak Pengajuan</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Alasan Penolakan</label>
                            <textarea name="alasan" class="form-control" rows="4" required placeholder="Jelaskan alasan penolakan..."></textarea>
                        </div>
                        <div class="alert alert-warning small mb-0">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Tindakan ini akan mengubah status menjadi <b>Ditolak</b> dan melepaskan semua mahasiswa agar bisa diajukan kembali.
                        </div>
                    </div>
                    <div class="modal-footer border-0 pb-4 justify-content-center">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-5 fw-bold btn-sm shadow-sm">Tolak Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>