<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --success: #10b981;
        --danger: #ef4444;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --bg-card: #ffffff;
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

    /* --- ELITE ARCHITECTURE --- */
    .card-elite {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* --- DATA TABLE ELITE --- */
    .table-responsive-elite {
        padding: 0;
        margin: 0;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    /* Styled Scrollbar */
    .table-responsive-elite::-webkit-scrollbar {
        height: 8px;
    }
    
    .table-responsive-elite::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .table-responsive-elite::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 4px;
    }
    
    .table-responsive-elite::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
    }

    .table-elite {
        width: 100%;
        font-size: 0.8rem;
        /* Compact Typography */
        color: var(--text-dark);
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-elite thead th {
        background: #f8fafc;
        padding: 1rem 1.25rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid var(--border-color);
        position: sticky;
        top: 0;
    }

    .table-elite tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-elite tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* --- PAGER STYLING --- */
    .elite-pagination .pagination {
        margin-bottom: 0;
        gap: 6px;
    }

    .elite-pagination .page-link {
        border: 1px solid var(--border-color);
        border-radius: 10px !important;
        padding: 0.5rem 0.8rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        transition: all 0.2s;
    }

    .elite-pagination .page-item.active .page-link {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    }

    /* --- CUSTOM INPUTS --- */
    .checkbox-custom {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--primary);
    }

    .select-elite {
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 0.4rem 0.5rem;
        background: #ffffff;
        cursor: pointer;
        transition: all 0.2s;
    }

    .select-elite:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .badge-status-mhs {
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.7rem;
        background: #f1f5f9;
        color: var(--text-muted);
    }

    /* --- BUTTONS --- */
    .btn-elite {
        padding: 0.6rem 1.25rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
    }

    .btn-elite-primary {
        background: var(--primary);
        color: white;
    }

    .btn-elite-primary:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
    }

    .btn-elite-success {
        background: var(--success);
        color: white;
    }

    .btn-elite-success:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .btn-elite-danger {
        background: #fef2f2;
        color: var(--danger);
        border: 1px solid #fee2e2;
    }

    .btn-elite-danger:hover {
        background: #fee2e2;
    }

    .btn-elite-outline {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
    }

    .btn-elite-outline:hover {
        background: #f8fafc;
        color: var(--text-dark);
    }

    /* --- SEARCH BOX REFINEMENT --- */
    .search-container {
        position: relative;
        max-width: 350px;
        width: 100%;
    }

    .search-input-elite {
        width: 100%;
        padding: 0.6rem 2.5rem 0.6rem 2.8rem;
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
    }
</style>

<div class="container-fluid px-4 py-4 fade-in-up">
    <div class="row mb-4 align-items-end">
        <div class="col-md-7">
            <h2 class="fw-bold mb-1" style="letter-spacing: -0.03em; color: var(--text-dark);">Ajukan Mahasiswa</h2>
            <p class="text-muted mb-0">Seleksi data mahasiswa untuk proses pengajuan pencairan dana periode aktif.</p>
        </div>
        <div class="col-md-5 d-flex justify-content-md-end gap-2 mt-3 mt-md-0">
            <button type="button" class="btn-elite btn-elite-danger shadow-sm" id="btn-cancel-top">
                <i class="fas fa-times"></i> Batal
            </button>
            <button type="button" class="btn-elite btn-elite-primary shadow-sm" id="btn-save-top">
                <i class="fas fa-save"></i> Simpan Draft
            </button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-md-end">
            <form action="" method="get" class="search-container">
                <input type="text" name="keyword" class="search-input-elite"
                    placeholder="Cari NIM atau Nama Mahasiswa..."
                    value="<?= esc($keyword ?? '') ?>">
                <i class="fas fa-search search-icon"></i>

                <?php if (!empty($keyword)): ?>
                    <a href="<?= base_url('verifikasi-mahasiswa/' . $id_pencairan) ?>" class="clear-search" title="Reset">
                        <i class="fas fa-times-circle text-danger"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const idPencairan = <?= $id_pencairan ?>;
                const checkAll = document.getElementById('checkAll');

                // Fungsi Kirim Data ke Server (AJAX)
                const syncStatus = (ids, isChecked) => {
                    fetch("<?= base_url('ajukan-mahasiswa-sync') ?>", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                selected_ids: ids,
                                id_pencairan: idPencairan,
                                checked: isChecked
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.success) {
                                alert("Gagal sinkronisasi data.");
                                location.reload(); // Refresh jika gagal agar UI sinkron kembali
                            }
                        })
                        .catch(err => console.error("Error:", err));
                };

                // Event untuk Checkbox Satuan
                document.querySelectorAll('.check-item').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        syncStatus([this.value], this.checked);
                    });
                });

                // Event untuk Check All (Semua di halaman ini)
                checkAll.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.check-item');
                    const ids = Array.from(checkboxes).map(cb => cb.value);

                    checkboxes.forEach(cb => cb.checked = this.checked);
                    syncStatus(ids, this.checked);
                });
            });
        </script>
    </div>

    <div class="card-elite shadow-sm">
        <div class="table-responsive-elite">
            <table class="table-elite" id="dataTable">
                <thead>
                    <tr>
                        <th width="40"><input type="checkbox" id="checkAll" class="checkbox-custom"></th>
                        <th>NIM</th>
                        <th>Status</th>
                        <th>Nama Lengkap</th>
                        <th>Kode Prodi</th>
                        <th>Nama Prodi</th>
                        <th>Jenjang</th>
                        <th>Angkatan</th>
                        <th>Kategori</th>
                        <th width="120">Pembaruan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mahasiswa)): ?>
                        <?php foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td>
                                    <input type="checkbox"
                                        class="check-item checkbox-custom"
                                        <?= ($mhs['status_pengajuan'] == 'Proses Pengajuan' || $mhs['id_pencairan'] == $id_pencairan) ? 'checked' : '' ?>
                                        value="<?= $mhs['id'] ?>"
                                        data-nim="<?= $mhs['nim'] ?>">
                                </td>
                                <td class="fw-bold text-primary"><?= esc($mhs['nim']) ?></td>
                                <td><span class="badge-status-mhs"><?= esc($mhs['status_pengajuan']) ?></span></td>
                                <td class="fw-bold"><?= esc($mhs['nama']) ?></td>
                                <td><?= esc($mhs['kode_prodi']) ?></td>
                                <td><?= esc($mhs['nama_prodi']) ?></td>
                                <td><?= esc($mhs['jenjang']) ?></td>
                                <td class="text-center"><?= esc($mhs['angkatan']) ?></td>
                                <td><small class="fw-medium"><?= esc($mhs['kategori']) ?></small></td>
                                <td>
                                    <select class="select-elite pembaruan-status w-100" data-id="<?= $mhs['id'] ?>">
                                        <option value="Tetap" <?= $mhs['pembaruan_status'] == 'Tetap' ? 'selected' : '' ?>>Tetap</option>
                                        <option value="Henti" <?= $mhs['pembaruan_status'] == 'Henti' ? 'selected' : '' ?>>Henti</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center py-4 text-muted">Data tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="p-3 bg-white border-top d-flex justify-content-between align-items-center">
            <div class="text-muted fw-bold" style="font-size: 0.75rem;">
                Halaman <strong><?= $pager->getCurrentPage() ?></strong> dari <strong><?= $pager->getPageCount() ?></strong>
            </div>
            <div class="elite-pagination">
                <?php if ($pager): ?>
                    <?= $pager->links('default', 'papan_info_pager') ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="p-4 bg-light border-top d-flex justify-content-between align-items-center">
            <a href="<?= base_url('verifikasi-pembaharuan-status') ?>" class="btn-elite btn-elite-outline">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button type="button" class="btn-elite btn-elite-success shadow" id="btn-ajukan">
                <i class="fas fa-paper-plane"></i> Selesai & Ajukan Sekarang
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkAll = document.getElementById('checkAll');
        const idPencairan = <?= $id_pencairan ?>;

        // Fungsi dinamis untuk mengambil checkbox yang ada di halaman pager saat ini
        const getCheckItems = () => document.querySelectorAll('.check-item');

        checkAll.addEventListener('change', function() {
            getCheckItems().forEach(cb => cb.checked = this.checked);
        });

        const handleAction = (isSubmit = false, isCancel = false) => {
            const items = getCheckItems();
            const selected = Array.from(items).filter(cb => cb.checked).map(cb => cb.value);
            const all = Array.from(items).map(cb => cb.value);

            if (isSubmit && selected.length === 0) {
                alert("Pilih mahasiswa terlebih dahulu.");
                return;
            }

            if (isCancel && !confirm("Batalkan semua pengajuan di halaman ini?")) return;
            if (isSubmit && !confirm("Ajukan mahasiswa yang dipilih untuk diproses?")) return;

            fetch("<?= base_url('ajukan-mahasiswa') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        selected: isCancel ? [] : selected,
                        all: all,
                        id_pencairan: idPencairan
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect || "<?= base_url('verifikasi-pembaharuan-status') ?>";
                    } else {
                        alert(data.message || "Gagal memproses data.");
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi kesalahan sistem.");
                });
        };

        document.getElementById('btn-save-top').addEventListener('click', () => handleAction(false, false));
        document.getElementById('btn-cancel-top').addEventListener('click', () => handleAction(false, true));
        document.getElementById('btn-ajukan').addEventListener('click', () => handleAction(true, false));

        document.querySelectorAll('.pembaruan-status').forEach(select => {
            select.addEventListener('change', function() {
                fetch("<?= base_url('mahasiswa/updateStatus') ?>", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: JSON.stringify({
                            id: this.dataset.id,
                            pembaruan_status: this.value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) alert("Gagal memperbarui status.");
                    })
                    .catch(error => console.error(error));
            });
        });
    });
</script>

<?= $this->endSection() ?>