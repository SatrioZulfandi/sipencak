<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --success: #10b981;
        --warning: #f59e0b;
        --dark: #1e293b;
        --slate: #64748b;
        --border: #e2e8f0;
        --bg-light: #f8fafc;
        --shadow-sm: 0 4px 20px rgba(0, 0, 0, 0.03);
        --shadow-hover: 0 12px 24px -10px rgba(37, 99, 235, 0.15);
    }

    .fade-in-up {
        animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1);
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

    .card-elite {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card-elite:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-hover);
    }

    .summary-box {
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        padding: 2.5rem;
        border-bottom: 1px solid var(--border);
    }

    .count-display {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--success);
        line-height: 1;
        letter-spacing: -2px;
    }

    .table-responsive-elite {
        border-radius: 12px;
        border: 1px solid var(--border);
        margin-bottom: 1.5rem;
    }

    .table-elite {
        width: 100%;
        font-size: 0.8rem;
        color: var(--dark);
        border-collapse: collapse;
    }

    .table-elite thead th {
        background: var(--bg-light);
        padding: 1rem 1.25rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        border-bottom: 1px solid var(--border);
        color: var(--slate);
    }

    .table-elite tbody td {
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-elite tbody tr:hover {
        background-color: #f8fafc;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-top: 1px solid #f1f5f9;
    }

    .elite-pagination .page-link {
        border: 1px solid var(--border);
        margin: 0 3px;
        border-radius: 8px !important;
        font-weight: 600;
        font-size: 0.75rem;
        color: var(--slate);
        padding: 0.5rem 0.8rem;
    }

    .elite-pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .btn-elite {
        padding: 0.7rem 1.4rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-elite-primary {
        background: var(--primary);
        color: white;
        border: none;
    }

    .btn-elite-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        color: white;
    }

    .btn-elite-outline {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--slate);
    }

    .btn-elite-outline:hover {
        background: var(--bg-light);
        color: var(--dark);
    }

    .btn-elite-success {
        background: #dcfce7;
        color: #15803d;
        border: none;
    }

    .status-badge {
        background: #eff6ff;
        color: var(--primary);
        padding: 3px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.7rem;
    }

    .alert-elite-warning {
        background: #fffbeb;
        border: 1px solid #fef3c7;
        border-radius: 16px;
        padding: 1.25rem;
        color: #92400e;
    }

    /* Search Box Styles */
    .search-wrapper {
        position: relative;
        max-width: 300px;
    }

    .search-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate);
        pointer-events: none;
    }

    .search-input-elite {
        width: 100%;
        padding: 0.6rem 1rem 0.6rem 2.5rem;
        border-radius: 10px;
        border: 1px solid var(--border);
        background: var(--bg-light);
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .search-input-elite:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
</style>

<div class="container-fluid px-4 py-5 fade-in-up">
    <div class="card-elite">
        <div class="summary-box">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.7rem; font-weight: 800;">TAHAP FINALISASI</span>
                    <h2 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.03em;">Verifikasi Berhasil Disusun</h2>
                    <p class="text-muted mb-0 small">
                        <i class="fas fa-university me-1"></i> <?= esc($pt['kode_pt']) ?> &mdash; <?= esc($pt['perguruan_tinggi']) ?>
                    </p>
                </div>
                <div class="col-md-5 text-md-end mt-4 mt-md-0">
                    <p class="text-muted small fw-bold mb-1 text-uppercase">Total Mahasiswa Terdaftar</p>
                    <div class="count-display"><?= number_format($jumlah, 0, ',', '.') ?></div>
                </div>
            </div>
        </div>

        <div class="p-4 p-md-5">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-list-check me-2 text-primary"></i>Daftar Mahasiswa Diajukan
                </h6>

                <div class="d-flex flex-column align-items-md-end gap-2">
                    <a href="<?= base_url('export-mahasiswa/' . $id_pencairan) ?>" class="btn-elite btn-elite-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                    <form action="" method="get" class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" name="keyword" value="<?= esc($keyword ?? '') ?>"
                            class="search-input-elite" placeholder="Cari Nama atau NIM...">
                    </form>
                </div>
            </div>

            <div class="table-responsive-elite">
                <table class="table-elite">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Program Studi</th>
                            <th class="text-center">Jenjang</th>
                            <th class="text-center">Angkatan</th>
                            <th>Kategori</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mahasiswa)): ?>
                            <?php foreach ($mahasiswa as $mhs): ?>
                                <tr>
                                    <td class="fw-bold text-primary"><?= esc($mhs['nim']) ?></td>
                                    <td class="fw-bold text-dark"><?= esc($mhs['nama']) ?></td>
                                    <td>
                                        <div class="fw-medium"><?= esc($mhs['nama_prodi']) ?></div>
                                        <div class="text-muted" style="font-size: 0.7rem;"><?= esc($mhs['kode_prodi']) ?></div>
                                    </td>
                                    <td class="text-center"><?= esc($mhs['jenjang']) ?></td>
                                    <td class="text-center"><?= esc($mhs['angkatan']) ?></td>
                                    <td><span class="text-uppercase" style="font-size: 0.7rem; font-weight: 600;"><?= esc($mhs['kategori']) ?></span></td>
                                    <td class="text-center"><span class="status-badge"><?= esc($mhs['pembaruan_status']) ?></span></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted italic">Data mahasiswa tidak ditemukan.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper mb-5">
                <div class="text-muted" style="font-size: 0.8rem;">
                    Menampilkan <strong><?= count($mahasiswa) ?></strong> dari <strong><?= $jumlah ?></strong> mahasiswa
                </div>
                <div class="elite-pagination">
                    <?= $pager->links('default', 'papan_info_pager') ?>
                </div>
            </div>

            <div class="alert-elite-warning mb-5">
                <div class="d-flex gap-3 align-items-start">
                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 0.9rem;"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Konfirmasi Finalisasi Data</h6>
                        <p class="mb-0 small" style="line-height: 1.5;">
                            Periksa kembali data di atas. Klik <strong>Kirim Hasil Verifikasi</strong> untuk menyetujui sejumlah <strong><?= $jumlah ?></strong> mahasiswa. Setelah dikirim, data akan dikunci secara otomatis oleh sistem.
                        </p>
                    </div>
                </div>
            </div>

            <footer class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-4 border-top">
                <a href="<?= base_url('verifikasi-mahasiswa/' . $id_pencairan) ?>" class="btn-elite btn-elite-outline">
                    <i class="fas fa-arrow-left"></i> Tahap Sebelumnya
                </a>

                <div class="d-flex gap-2 w-100 w-md-auto justify-content-md-end">
                    <a href="<?= base_url('admin/pencairan/draft') ?>" class="btn-elite btn-elite-outline border-warning text-warning">
                        <i class="fas fa-file-invoice"></i> Simpan ke Draft
                    </a>

                    <a href="<?= base_url('verifikasi-final/' . $id_pencairan) ?>"
                        class="btn-elite btn-elite-primary shadow-sm"
                        onclick="return confirm('Apakah Anda yakin data sudah valid? Tindakan ini tidak dapat dibatalkan.')">
                        Kirim Hasil Verifikasi <i class="fas fa-paper-plane ms-2"></i>
                    </a>
                </div>
            </footer>
        </div>
    </div>
</div>

<?= $this->endSection() ?>