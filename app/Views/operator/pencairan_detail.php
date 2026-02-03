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

    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }

    .btn-back {
        height: 44px;
        padding: 0 1.25rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        color: var(--text-main);
        border: 1px solid var(--border-color);
        text-decoration: none;
        transition: 0.2s;
        margin-bottom: 2rem;
    }

    .btn-back:hover {
        background: #f1f5f9;
        color: var(--brand);
        border-color: var(--brand);
    }

    .detail-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        background: #f8fafc;
        padding: 2rem;
        border-radius: 18px;
        border: 1px solid var(--border-color);
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .info-label {
        font-size: 0.7rem;
        font-weight: 800;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.4;
    }

    .status-badge-modern {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.25rem;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.8rem;
    }

    .status-selesai {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #d1fae5;
    }

    .status-ditolak {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
    }

    .status-proses {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .btn-file {
        padding: 0.5rem 1rem;
        border-radius: 10px;
        font-size: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: 0.2s;
        background: white;
        color: var(--brand);
        border: 1px solid var(--border-color);
    }

    .btn-file:hover {
        background: var(--brand);
        color: white;
    }

    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .search-wrapper {
        position: relative;
        width: 100%;
        max-width: 400px;
    }

    .search-input-elite {
        width: 100%;
        height: 48px;
        padding: 0 1rem 0 3.25rem;
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        font-size: 0.9rem;
        transition: 0.2s;
    }

    .search-input-elite:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon-inside {
        position: absolute;
        left: 1.25rem;
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
        border-collapse: collapse;
    }

    .table-custom th {
        background: #f8fafc;
        padding: 1.25rem 1rem;
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--text-muted);
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-color);
        text-align: left;
    }

    .table-custom td {
        padding: 1rem;
        font-size: 0.8rem;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-main);
        font-weight: 600;
    }

    .btn-export-excel {
        height: 48px;
        padding: 0 1.5rem;
        background: #10b981;
        color: white;
        border-radius: 14px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        transition: 0.2s;
    }

    .btn-export-excel:hover {
        background: #059669;
        color: white;
    }

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
</style>

<div class="container-fluid py-5 px-4 px-lg-5">

    <a href="javascript:history.back()" class="btn-back">
        <i class="fas fa-chevron-left"></i> Kembali ke Daftar
    </a>

    <div class="detail-card">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h4 class="fw-800 mb-1">Rincian Laporan Pencairan</h4>
                <p class="text-muted small mb-0">Reference ID: <span class="fw-700">#<?= esc($data['id']) ?></span></p>
            </div>
            <div>
                <?php if ($data['status'] === 'Selesai'): ?>
                    <div class="status-badge-modern status-selesai">
                        <i class="fas fa-check-circle"></i> TERVERIFIKASI
                    </div>
                <?php elseif ($data['status'] === 'Ditolak'): ?>
                    <div class="status-badge-modern status-ditolak">
                        <i class="fas fa-times-circle"></i> DITOLAK
                    </div>
                <?php else: ?>
                    <div class="status-badge-modern status-proses">
                        <i class="fas fa-spinner fa-spin"></i> <?= strtoupper(esc($data['status'] ?? 'PROSES')) ?>
                    </div>
                <?php endif ?>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Institusi</span>
                <span class="info-value text-primary"><?= esc($data['kode_pt']) ?> - <?= esc($data['perguruan_tinggi']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Kategori Bantuan</span>
                <span class="info-value"><?= esc($data['kategori_penerima']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Nomor Dokumen</span>
                <span class="info-value"><?= esc($data['no_sk'] ?? '-') ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Tanggal Pengajuan</span>
                <span class="info-value"><?= tanggal_indonesia($data['tanggal']) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Periode Akademik</span>
                <span class="info-value"><?= esc($data['semester']) ?> / <?= date('Y', strtotime($data['tanggal_entry'])) ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Lampiran Berkas</span>
                <div class="d-flex flex-wrap gap-2 mt-1">
                    <?php foreach (['sptjm' => 'SPTJM', 'sk_penetapan' => 'SK Penetapan', 'sk_pembatalan' => 'Pembatalan', 'berita_acara' => 'Berita Acara'] as $key => $label): ?>
                        <?php if (!empty($data[$key])): ?>
                            <a href="<?= base_url('file/' . $data[$key]) ?>" target="_blank" class="btn-file">
                                <i class="fas fa-file-pdf"></i> <?= $label ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>

    <div class="table-controls">
        <h5 class="fw-800 mb-0">Daftar Mahasiswa Penerima</h5>
        <div class="d-flex gap-3">
            <form action="" method="get" class="search-wrapper">
                <i class="fas fa-search search-icon-inside"></i>
                <input type="text" name="search" class="search-input-elite"
                    placeholder="Cari Nama atau NIM..." value="<?= esc($search ?? '') ?>">
            </form>
            <a href="<?= base_url('operator/pencairan/unduh-mahasiswa/' . $data['id']) ?>" class="btn-export-excel" style="white-space: nowrap; width: max-content;">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>

    <div class="card-table-wrapper shadow-sm">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="60" class="text-center">No</th>
                        <th width="150">NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Program Studi</th>
                        <th class="text-center">Angkatan</th>
                        <th>Status Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mahasiswa)): ?>
                        <?php
                        $no = 1 + (6 * ($pager->getCurrentPage('default') - 1));
                        foreach ($mahasiswa as $mhs):
                        ?>
                            <tr>
                                <td class="text-center text-muted"><?= $no++ ?></td>
                                <td class="text-primary fw-800"><?= esc($mhs['nim']) ?></td>
                                <td><?= esc($mhs['nama']) ?></td>
                                <td>
                                    <div class="fw-700"><?= esc($mhs['prodi'] ?? '-') ?></div>
                                    <div class="text-muted" style="font-size: 0.7rem;"><?= esc($mhs['jenjang'] ?? 'S1') ?></div>
                                </td>
                                <td class="text-center fw-700"><?= esc($mhs['angkatan']) ?></td>
                                <td>
                                    <span class="text-primary"><?= esc($mhs['pembaruan_status'] ?? '-') ?></span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Data mahasiswa tidak ditemukan.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($mahasiswa)): ?>
            <div class="pagination-wrapper">
                <div class="page-info">
                    Menampilkan <span class="text-primary fw-800"><?= count($mahasiswa) ?></span> data halaman ini
                </div>
                <div class="pagination-elite">
                    <?= $pager->links('default', 'default_full') ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>