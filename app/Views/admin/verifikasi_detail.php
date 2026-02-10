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

    /* --- MODAL ELITE --- */
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

    .btn-close-custom {
        background: none;
        border: none;
        color: var(--slate);
        font-size: 1.25rem;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-close-custom:hover {
        color: #ef4444;
        transform: rotate(90deg);
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
        text-decoration: none;
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
        border: 1px solid var(--border);
        color: var(--dark);
    }

    .btn-outline-elite:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    .btn-outline-elite:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    /* --- SORT HEADER ELITE --- */
    .sort-header {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Space between text and icon */
        text-decoration: none;
        color: var(--slate); 
        font-weight: 800; /* Match existing th weight */
        transition: all 0.2s ease;
        padding: 0.25rem 0;
        cursor: pointer;
        width: 100%;
        text-transform: uppercase;
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
                                <i class="fas fa-download text-primary ms-2"></i>
                            </a>
                        <?php else: ?>
                            <div class="btn-file-elite opacity-50 bg-light">
                                <span><?= $label ?></span>
                                <i class="fas fa-times text-danger ms-2"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="info-card-elite">
        <div class="card-header bg-white border-bottom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 0.1em; color: var(--slate);">Daftar Mahasiswa</h6>
                <?php if ($data['status'] === 'Selesai'): ?>
                    <a href="<?= base_url('admin/pencairan/unduh-mahasiswa/' . $data['id']) ?>" class="btn btn-success btn-sm rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fas fa-file-excel me-2"></i> Unduh Data
                    </a>
                <?php endif ?>
            </div>

            <form action="" method="get" class="w-100">
                <input type="hidden" name="sort" value="<?= esc($sort ?? '') ?>">
                <input type="hidden" name="order" value="<?= esc($order ?? '') ?>">
                <div class="row g-2">
                    <!-- Search Input (Mobile: Top Full, Desktop: Right Auto) -->
                    <div class="col-12 col-md order-1 order-md-4">
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

                    <!-- Filter Entries (Mobile: col-4, Desktop: Auto) -->
                    <div class="col-4 col-md-auto order-2 order-md-1">
                        <label class="text-uppercase fw-bold text-muted small mb-1">Jumlah</label>
                        <select name="entries" class="form-select form-select-sm border shadow-sm bg-white w-100" 
                            style="font-weight: 500; color: #64748b; border-radius: 12px; border-color: #e2e8f0;" 
                            onchange="this.form.submit()">
                            <?php foreach([10, 25, 50, 100] as $val): ?>
                                <option value="<?= $val ?>" <?= (isset($entries) && $entries == $val) ? 'selected' : '' ?>><?= $val ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Filter Prodi (Mobile: col-4, Desktop: Left-Middle) -->
                    <div class="col-4 col-md-3 order-3 order-md-2">
                        <label class="text-uppercase fw-bold text-muted small mb-1">Program Studi</label>
                        <select name="filter_prodi" class="form-select form-select-sm border shadow-sm bg-white w-100" 
                            style="color: #64748b; border-radius: 12px; border-color: #e2e8f0;" 
                            onchange="this.form.submit()">
                            <option value="">Semua Program Studi</option>
                            <?php if (!empty($list_prodi)): ?>
                                <?php foreach($list_prodi as $lp): ?>
                                    <option value="<?= $lp['id'] ?>" <?= ($filter_prodi == $lp['id']) ? 'selected' : '' ?>>
                                        <?= esc($lp['nama_prodi']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <!-- Filter Angkatan (Mobile: col-4, Desktop: Middle) -->
                    <div class="col-4 col-md-2 order-4 order-md-3">
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
                </div>
            </form>
        </div>

        <div class="table-responsive">
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
                        <th width="60" class="text-center">No</th>
                        <th><?= $getSortLink('nim', 'NIM') ?></th>
                        <th><?= $getSortLink('nama', 'Nama Lengkap') ?></th>
                        <th><?= $getSortLink('prodis.kode_prodi', 'Program Studi') ?></th>
                        <th class="text-center"><?= $getSortLink('jenjang', 'Jenjang') ?></th>
                        <th class="text-center"><?= $getSortLink('angkatan', 'Angkatan') ?></th>
                        <th><?= $getSortLink('kategori', 'Kategori') ?></th>
                        <th class="text-center"><?= $getSortLink('pembaruan_status', 'Status') ?></th>
                        <th class="text-center" width="100">Aksi</th>
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
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-bold btn-riwayat" 
                                            data-id="<?= $m['id'] ?>" data-nim="<?= esc($m['nim']) ?>" data-nama="<?= esc($m['nama']) ?>"
                                            style="font-size: 0.7rem;">
                                        <i class="fas fa-history me-1"></i> Riwayat
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
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
    <div class="modal fade" id="modalSelesai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-elite">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0 text-success"><i class="fas fa-check-circle me-2"></i> Konfirmasi Sistem</h5>
                    <button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-4">
                         <i class="fas fa-paper-plane fa-3x text-success opacity-25"></i>
                    </div>
                    <p class="text-muted fw-bold small mb-4">Data telah berhasil diverifikasi dan disinkronkan dengan Portal SIMKIP Pusat.</p>
                    <a href="https://kip-kuliah.kemdiktisaintek.go.id/sim/monitoring-pencairan" target="_blank" class="btn-elite btn-primary-elite w-100">
                        <i class="fas fa-external-link-alt me-2"></i> Buka Monitoring SIMKIP
                    </a>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn-elite btn-outline-elite w-100" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($data['status'] === 'Ditolak' && !empty($data['alasan_tolak'])): ?>
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-elite">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="fw-bold mb-0 text-danger"><i class="fas fa-exclamation-circle me-2"></i> Alasan Penolakan</h5>
                    <button type="button" class="btn-close-custom" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 border rounded-4 bg-light text-dark shadow-sm">
                        <?= nl2br(esc($data['alasan_tolak'])) ?>
                    </div>
                    <p class="small text-muted mt-3 mb-0 text-center"><i class="fas fa-info-circle me-1"></i> Silakan perbaiki data sesuai alasan di atas.</p>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn-elite btn-outline-elite w-100" data-dismiss="modal">Tutup</button>
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
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold btn-sm shadow-sm" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-5 fw-bold btn-sm shadow-sm">Tolak Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Modal Riwayat Pengajuan -->
<div class="modal fade" id="modalRiwayat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
            <div class="modal-header border-0 py-3 px-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h6 class="modal-title fw-bold text-white"><i class="fas fa-history me-2"></i> Riwayat Pengajuan Mahasiswa</h6>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3 p-3 rounded-3" style="background: #f8fafc;">
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted fw-bold">NIM</small>
                            <div class="fw-bold text-primary" id="riwayat-nim">-</div>
                        </div>
                        <div class="col-6">
                            <small class="text-muted fw-bold">Nama</small>
                            <div class="fw-bold" id="riwayat-nama">-</div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="table-riwayat">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th class="fw-bold text-muted" style="font-size: 0.75rem;">SEMESTER</th>
                                <th class="fw-bold text-muted" style="font-size: 0.75rem;">PERIODE</th>
                                <th class="fw-bold text-muted" style="font-size: 0.75rem;">TAHUN</th>
                                <th class="fw-bold text-muted text-center" style="font-size: 0.75rem;">STATUS</th>
                                <th class="fw-bold text-muted" style="font-size: 0.75rem;">TANGGAL</th>
                            </tr>
                        </thead>
                        <tbody id="riwayat-body">
                            <tr><td colspan="5" class="text-center py-4 text-muted">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 justify-content-center">
                <button type="button" class="btn btn-dark rounded-pill px-5 fw-bold btn-sm shadow-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalRiwayat = new bootstrap.Modal(document.getElementById('modalRiwayat'));
    
    document.querySelectorAll('.btn-riwayat').forEach(btn => {
        btn.addEventListener('click', function() {
            const idMahasiswa = this.dataset.id;
            const nim = this.dataset.nim;
            const nama = this.dataset.nama;
            
            // Set info mahasiswa
            document.getElementById('riwayat-nim').textContent = nim;
            document.getElementById('riwayat-nama').textContent = nama;
            
            // Loading state
            document.getElementById('riwayat-body').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted"><i class="fas fa-spinner fa-spin me-2"></i>Memuat data...</td></tr>';
            
            // Show modal
            modalRiwayat.show();
            
            // Fetch data
            fetch(`<?= base_url('admin/mahasiswa/riwayat') ?>/${idMahasiswa}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.riwayat.length > 0) {
                        let html = '';
                        data.riwayat.forEach(r => {
                            let statusClass = 'bg-warning text-dark';
                            let statusLabel = r.status_pengajuan;

                            if (r.status_pengajuan === 'Diajukan') {
                                if (r.status_pencairan === 'Selesai') {
                                    statusClass = 'bg-success text-white';
                                    statusLabel = 'Disetujui';
                                } else if (r.status_pencairan === 'Diproses') {
                                    statusClass = 'bg-primary text-white'; // Atau bg-info
                                    statusLabel = 'Diproses';
                                } else if (r.status_pencairan === 'Ditolak') {
                                    statusClass = 'bg-danger text-white';
                                    statusLabel = 'Ditolak';
                                } else {
                                    // Default jika status pencairan lain (misal null/draft)
                                    statusClass = 'bg-primary text-white';
                                    statusLabel = 'Diajukan';
                                }
                            } else {
                                // Jika status pengajuan bukan 'Diajukan' (misal: Proses Pengajuan, Belum Diajukan)
                                statusClass = 'bg-warning text-dark';
                                statusLabel = r.status_pengajuan;
                            }

                            const tanggal = r.created_at ? new Date(r.created_at).toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'}) : '-';
                            html += `
                                <tr>
                                    <td class="fw-bold">${r.semester || '-'}</td>
                                    <td>${r.periode || '-'}</td>
                                    <td>${r.tahun || '-'}</td>
                                    <td class="text-center"><span class="badge ${statusClass} px-3 py-1" style="font-size: 0.7rem;">${statusLabel}</span></td>
                                    <td class="text-muted" style="font-size: 0.8rem;">${tanggal}</td>
                                </tr>
                            `;
                        });
                        document.getElementById('riwayat-body').innerHTML = html;
                    } else {
                        document.getElementById('riwayat-body').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted"><i class="fas fa-inbox fa-2x mb-2 opacity-25 d-block"></i>Belum ada riwayat pengajuan</td></tr>';
                    }
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('riwayat-body').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-danger">Gagal memuat data</td></tr>';
                });
        });
    });
});
</script>

<?= $this->endSection() ?>