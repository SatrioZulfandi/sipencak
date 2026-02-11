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
    .search-input-elite:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* --- SORT HEADER ELITE --- */
    .sort-header {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Space between text and icon */
        text-decoration: none;
        color: var(--slate); /* Match thead th color */
        font-weight: 700;
        transition: all 0.2s ease;
        padding: 0.25rem 0;
        cursor: pointer;
        width: 100%;
    }
    
    .sort-header:hover {
        color: var(--primary);
        transform: translateX(4px);
    }
    
    .sort-header.active {
        color: var(--primary);
    }
    
    .sort-icon-wrapper {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        transition: all 0.2s;
        background: transparent;
    }
    
    .sort-header:hover .sort-icon-wrapper {
        background: #eff6ff;
    }
    
    .sort-header.active .sort-icon-wrapper {
        background: #dbeafe;
        color: var(--primary);
    }
    
    /* --- STICKY COLUMN --- */
    .sticky-col {
        position: -webkit-sticky;
        position: sticky;
        right: 0;
        z-index: 10;
        background-color: #fff; /* Match row bg */
        box-shadow: -4px 0 8px rgba(0,0,0,0.05); /* Left shadow */
        border-left: 1px solid var(--border-color);
    }

    .table-elite thead th.sticky-col {
        background-color: #f8fafc; /* Match header bg */
        z-index: 20; /* Higher than tbody sticky */
    }

    /* Ensure hover effect works on sticky col */
    .table-elite tbody tr:hover td.sticky-col {
        background-color: #f1f5f9;
        transition: background-color 0.2s ease;
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
                </div>
            </div>

            <!-- Filter Section -->
            <form action="" method="get" class="w-100 mb-4">
                <input type="hidden" name="sort" value="<?= esc($sort ?? '') ?>">
                <input type="hidden" name="order" value="<?= esc($order ?? '') ?>">
                <div class="row g-2 align-items-end">
                    <!-- Search Input -->
                    <div class="col-12 col-md-3">
                        <label class="text-uppercase fw-bold text-muted small mb-1">Cari Data</label>
                        <div class="search-container position-relative w-100">
                            <input type="text" name="keyword" class="form-control form-control-sm border shadow-sm ps-5 bg-white w-100"
                                placeholder="Cari NIM / Nama..."
                                style="padding-left: 2.5rem !important; color: #64748b; border-radius: 12px; border-color: #e2e8f0;"
                                value="<?= esc($keyword ?? '') ?>">
                            <i class="fas fa-search position-absolute text-muted" style="left: 1rem; top: 50%; transform: translateY(-50%); font-size: 0.8rem; z-index: 5;"></i>

                            <?php if (!empty($keyword)): ?>
                                <a href="<?= current_url() ?>" class="text-decoration-none position-absolute text-muted" style="right: 1rem; top: 50%; transform: translateY(-50%); z-index: 5;" title="Bersihkan">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Filter Entries -->
                    <div class="col-6 col-md-auto">
                        <label class="text-uppercase fw-bold text-muted small mb-1">Jumlah</label>
                        <select name="entries" class="form-select form-select-sm border shadow-sm bg-white w-100" 
                            style="font-weight: 500; color: #64748b; border-radius: 12px; border-color: #e2e8f0;" 
                            onchange="this.form.submit()">
                            <?php foreach([10, 25, 50, 100] as $val): ?>
                                <option value="<?= $val ?>" <?= (isset($entries) && $entries == $val) ? 'selected' : '' ?>><?= $val ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Filter Prodi -->
                    <div class="col-6 col-md-3">
                        <label class="text-uppercase fw-bold text-muted small mb-1">Program Studi</label>
                        <select name="filter_prodi" class="form-select form-select-sm border shadow-sm bg-white w-100" 
                            style="color: #64748b; border-radius: 12px; border-color: #e2e8f0;" 
                            onchange="this.form.submit()">
                            <option value="">Semua Prodi</option>
                            <?php if (!empty($list_prodi)): ?>
                                <?php foreach($list_prodi as $lp): ?>
                                    <option value="<?= $lp['id'] ?>" <?= ($filter_prodi == $lp['id']) ? 'selected' : '' ?>>
                                        <?= esc($lp['nama_prodi']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Filter Angkatan -->
                    <div class="col-6 col-md-2">
                        <label class="text-uppercase fw-bold text-muted small mb-1">Angkatan</label>
                        <select name="filter_angkatan" class="form-select form-select-sm border shadow-sm bg-white w-100" 
                            style="color: #64748b; border-radius: 12px; border-color: #e2e8f0;" 
                            onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <?php if (!empty($list_angkatan)): ?>
                                <?php foreach($list_angkatan as $la): ?>
                                    <option value="<?= $la['angkatan'] ?>" <?= ($filter_angkatan == $la['angkatan']) ? 'selected' : '' ?>>
                                        <?= esc($la['angkatan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Filter Kategori -->
                    <div class="col-12 col-md">
                            <label class="text-uppercase fw-bold text-muted small mb-1">Kategori</label>
                            <select name="filter_kategori" class="form-select form-select-sm border shadow-sm bg-white w-100" 
                            style="color: #64748b; border-radius: 12px; border-color: #e2e8f0;" 
                            onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <?php if (!empty($list_kategori)): ?>
                                <?php foreach($list_kategori as $cat): ?>
                                    <option value="<?= $cat['kategori'] ?>" <?= ($filter_kategori == $cat['kategori']) ? 'selected' : '' ?>>
                                        <?= esc($cat['kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </form>

            <div class="table-responsive-elite">
                <table class="table-elite">
                    <thead>
                        <?php
                        $request = service('request');
                        $currentSort = $sort ?? '';
                        $currentOrder = $order ?? '';
                        
                        $getSortLink = function($column, $label) use ($currentSort, $currentOrder) {
                            $newOrder = 'asc';
                            $icon = 'fa-sort';
                            $activeClass = '';
                            $iconClass = 'text-muted opacity-25'; 
                            
                            if ($currentSort == $column) {
                                $activeClass = 'active';
                                if ($currentOrder == 'asc') {
                                    $newOrder = 'desc';
                                    $icon = 'fa-sort-up';
                                    $iconClass = 'text-primary';
                                } elseif ($currentOrder == 'desc') {
                                    $newOrder = '';
                                    $icon = 'fa-sort-down';
                                    $iconClass = 'text-primary';
                                }
                            }
                            
                            $params = $_GET; 
                            
                            if ($newOrder) {
                                $params['sort'] = $column;
                                $params['order'] = $newOrder;
                            } else {
                                unset($params['sort']);
                                unset($params['order']);
                            }
                            
                            $queryString = http_build_query($params);
                            
                            return '<a href="?' . $queryString . '" class="sort-header ' . $activeClass . '" title="Urutkan berdasarkan ' . $label . '">' 
                                    . '<span>' . $label . '</span>' 
                                    . '<span class="sort-icon-wrapper"><i class="fas ' . $icon . ' ' . $iconClass . '"></i></span></a>';
                        };
                        ?>
                        <tr>
                            <th><?= $getSortLink('nim', 'NIM') ?></th>
                            <th><?= $getSortLink('nama', 'Nama Mahasiswa') ?></th>
                            <th><?= $getSortLink('prodis.kode_prodi', 'Program Studi') ?></th>
                            <th class="text-center"><?= $getSortLink('jenjang', 'Jenjang') ?></th>
                            <th class="text-center"><?= $getSortLink('angkatan', 'Angkatan') ?></th>
                            <th><?= $getSortLink('kategori', 'Kategori') ?></th>
                            <th class="text-center sticky-col"><?= $getSortLink('pembaruan_status', 'Status') ?></th>
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
                                    <td class="text-center sticky-col">
                                        <?php
                                        $badgeClass = 'badge bg-primary-subtle text-primary'; // Default
                                        if ($mhs['pembaruan_status'] == 'Tetap') {
                                            $badgeClass = 'badge bg-success-subtle text-success'; 
                                        } elseif ($mhs['pembaruan_status'] == 'Henti') {
                                            $badgeClass = 'badge bg-danger-subtle text-danger';
                                        }
                                        ?>
                                        <span class="<?= $badgeClass ?> border-0" style="font-size: 0.75rem;"><?= esc($mhs['pembaruan_status']) ?></span>
                                    </td>
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

                    <button type="button" 
                        class="btn-elite btn-elite-primary shadow-sm"
                        id="btnKirimVerifikasi">
                        Kirim Hasil Verifikasi <i class="fas fa-paper-plane ms-2"></i>
                    </button>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Finalisasi -->
<div class="modal fade" id="modalKonfirmasiFinal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-body p-0">
                <!-- Header -->
                <div class="text-center pt-5 pb-3" style="background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);">
                    <div class="d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px; background: #fff; border-radius: 50%; box-shadow: 0 8px 20px rgba(34, 197, 94, 0.2);">
                        <i class="fas fa-check-circle fa-2x" style="color: #16a34a;"></i>
                    </div>
                    <h5 class="fw-bold mb-1" style="color: #1e293b;">Finalisasi Verifikasi?</h5>
                    <p class="text-muted mb-0 px-4" style="font-size: 0.9rem;">
                        Data akan dikunci dan siap untuk proses pencairan.
                    </p>
                </div>
                
                <!-- Info Box -->
                <div class="px-4 py-3">
                    <div class="p-3 rounded-3" style="background: #fff7ed; border-left: 4px solid #f97316;">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fas fa-exclamation-triangle mt-1" style="color: #c2410c;"></i>
                            <div>
                                <strong style="color: #9a3412; font-size: 0.85rem;">Perhatian!</strong>
                                <p class="mb-0 text-muted" style="font-size: 0.8rem;">
                                    Tindakan ini <strong>tidak dapat dibatalkan</strong>. Pastikan seluruh data mahasiswa telah valid sesuai ketentuan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="p-4 d-flex gap-2">
                    <button type="button" class="btn flex-grow-1 fw-bold py-2 btn-close-modal" 
                            style="background: #f1f5f9; color: #64748b; border-radius: 12px; cursor: pointer;">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <a href="<?= base_url('verifikasi-final/' . $id_pencairan) ?>" 
                       class="btn flex-grow-1 fw-bold py-2 text-center text-decoration-none" 
                       style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%); color: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3); cursor: pointer;">
                        <i class="fas fa-paper-plane me-1"></i> Ya, Kirim
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalKonfirmasi = new bootstrap.Modal(document.getElementById('modalKonfirmasiFinal'));
        
        document.getElementById('btnKirimVerifikasi').addEventListener('click', function() {
            modalKonfirmasi.show();
        });

        document.querySelectorAll('.btn-close-modal').forEach(btn => {
            btn.addEventListener('click', () => modalKonfirmasi.hide());
        });
    });
</script>

<?= $this->endSection() ?>