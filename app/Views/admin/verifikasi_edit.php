<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    /* Styling tetap konsisten dengan Elite Neo-Minimalism 2026 */
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --primary-soft: #eff6ff;
        --success: #10b981;
        --dark: #1e293b;
        --slate: #64748b;
        --border: #e2e8f0;
        --white: #ffffff;
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

    .elite-container {
        max-width: 950px;
        margin: auto;
    }

    .main-form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 28px;
        box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .form-hero {
        padding: 2.5rem 3rem;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-bottom: 1px solid var(--border);
    }

    .section-divider {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.12em;
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 2.5rem 0 1.5rem;
    }

    .section-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--border);
    }

    .field-label {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 8px;
        display: block;
        text-transform: uppercase;
    }

    .input-premium {
        width: 100%;
        background: #f1f5f9;
        border: 2px solid transparent;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--dark);
        transition: all 0.3s;
    }

    .input-premium:focus {
        background: var(--white);
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .file-display-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }

    .current-file-badge {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: white;
        padding: 10px 15px;
        border-radius: 12px;
        border: 1px dashed var(--border);
        margin-bottom: 1rem;
    }

    .radio-group-modern {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .radio-card {
        cursor: pointer;
        position: relative;
    }

    .radio-card input {
        position: absolute;
        opacity: 0;
    }

    .radio-label-content {
        padding: 0.85rem;
        border: 2px solid var(--border);
        border-radius: 14px;
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--slate);
        transition: 0.3s;
        text-align: center;
    }

    .radio-card input:checked+.radio-label-content {
        border-color: var(--primary);
        background: var(--primary-soft);
        color: var(--primary);
    }

    .action-bar {
        padding: 2rem 3rem;
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<div class="container py-5 fade-in-up">
    <div class="elite-container">

        <form action="/verifikasi-update/<?= $data['id'] ?>" method="POST" enctype="multipart/form-data" class="main-form-card">
            <?= csrf_field() ?>

            <div class="form-hero d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.02em;">Edit Permohonan Pencairan</h4>
                    <p class="text-muted small mb-0">ID Record: #<?= $data['id'] ?> | Status: <span class="badge bg-info text-white"><?= esc($data['status']) ?></span></p>
                </div>
                <span class="badge rounded-pill px-3 py-2" style="background: #dcfce7; color: #15803d; font-weight: 800; font-size: 0.75rem;">
                    <i class="fas fa-calendar-check me-1"></i> <?= esc($data['periode'] ?? $periode['periode']) ?>
                </span>
            </div>

            <div class="p-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="field-label">Kategori Mahasiswa <span class="text-danger">*</span></label>
                        <div class="radio-group-modern">
                            <label class="radio-card">
                                <input type="radio" name="kategori_penerima" value="Skema Pembiayaan Penuh" <?= old('kategori_penerima', $data['kategori_penerima']) == 'Skema Pembiayaan Penuh' ? 'checked' : '' ?> required>
                                <span class="radio-label-content">Pembiayaan Penuh</span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="kategori_penerima" value="Skema Biaya Pendidikan" <?= old('kategori_penerima', $data['kategori_penerima']) == 'Skema Biaya Pendidikan' ? 'checked' : '' ?>>
                                <span class="radio-label-content">Biaya Pendidikan</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="field-label">Periode Semester <span class="text-danger">*</span></label>
                        <div class="radio-group-modern">
                            <label class="radio-card">
                                <input type="radio" name="semester" value="Ganjil" <?= old('semester', $data['semester']) == 'Ganjil' ? 'checked' : '' ?> required>
                                <span class="radio-label-content">Semester Ganjil</span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="semester" value="Genap" <?= old('semester', $data['semester']) == 'Genap' ? 'checked' : '' ?>>
                                <span class="radio-label-content">Semester Genap</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <label class="field-label">No. SK / Surat Permohonan</label>
                        <input type="text" class="input-premium" name="no_surat_permohonan"
                            value="<?= old('no_surat_permohonan', esc($data['no_sk'] ?? '')) ?>"
                            placeholder="Contoh: 123/SK/2026" required>
                    </div>

                    <div class="col-md-4">
                        <label class="field-label">Tanggal Surat</label>
                        <input type="date" class="input-premium" name="tanggal"
                            value="<?= old('tanggal', isset($data['tanggal']) ? date('Y-m-d', strtotime($data['tanggal'])) : '') ?>" required>
                    </div>
                </div>

                <div class="section-divider">Berkas SPTJM</div>
                <div class="file-display-box">
                    <?php if (!empty($data['sptjm'])): ?>
                        <div class="current-file-badge">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-file-pdf text-danger fs-5"></i>
                                <span class="fw-bold small text-dark"><?= esc($data['sptjm']) ?></span>
                            </div>
                            <a href="<?= base_url('file/' . $data['sptjm']) ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 10px;">LIHAT FILE SAAT INI</a>
                        </div>
                    <?php endif; ?>
                    <label class="field-label">Update SPTJM (PDF, Kosongkan jika tetap)</label>
                    <input type="file" class="form-control input-premium" name="sptjm" accept=".pdf" onchange="cekUkuran(this)">
                </div>

                <div class="section-divider">Informasi & Berkas SK</div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="file-display-box">
                            <?php if (!empty($data['sk_penetapan'])): ?>
                                <div class="current-file-badge">
                                    <i class="fas fa-file-contract text-primary"></i>
                                    <span class="fw-bold small text-truncate ms-2 me-auto"><?= esc($data['sk_penetapan']) ?></span>
                                    <a href="<?= base_url('file/' . $data['sk_penetapan']) ?>" target="_blank" class="text-primary"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            <?php endif; ?>
                            <label class="field-label">Update SK Penetapan</label>
                            <input type="file" class="form-control input-premium" name="sk_penetapan" accept=".pdf" onchange="cekUkuran(this)">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="file-display-box">
                            <?php if (!empty($data['sk_pembatalan'])): ?>
                                <div class="current-file-badge">
                                    <i class="fas fa-file-signature text-warning"></i>
                                    <span class="fw-bold small text-truncate ms-2 me-auto"><?= esc($data['sk_pembatalan']) ?></span>
                                    <a href="<?= base_url('file/' . $data['sk_pembatalan']) ?>" target="_blank" class="text-warning"><i class="fas fa-external-link-alt"></i></a>
                                </div>
                            <?php endif; ?>
                            <label class="field-label">Update SK Pembatalan</label>
                            <input type="file" class="form-control input-premium" name="sk_pembatalan" accept=".pdf" onchange="cekUkuran(this)">
                        </div>
                    </div>
                </div>

                <div class="section-divider">Berita Acara Evaluasi</div>
                <div class="file-display-box">
                    <?php if (!empty($data['berita_acara'])): ?>
                        <div class="current-file-badge">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-clipboard-check text-success fs-5"></i>
                                <span class="fw-bold small text-dark"><?= esc($data['berita_acara']) ?></span>
                            </div>
                            <a href="<?= base_url('file/' . $data['berita_acara']) ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" style="font-size: 10px;">LIHAT FILE SAAT INI</a>
                        </div>
                    <?php endif; ?>
                    <label class="field-label">Update Berita Acara</label>
                    <input type="file" class="form-control input-premium" name="berita_acara" accept=".pdf" onchange="cekUkuran(this)">
                </div>

                <input type="hidden" name="id_pt" value="<?= old('id_pt', $data['id_pt'] ?? session()->get('pt')) ?>">
                <input type="hidden" name="periode" value="<?= old('periode', $data['periode'] ?? $periode['periode']) ?>">
            </div>

            <div class="action-bar">
                <a href="/verifikasi-pembaharuan-status" class="btn btn-link text-slate fw-bold text-decoration-none small">
                    <i class="fas fa-arrow-left me-2"></i> Batal & Kembali
                </a>
                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow">
                    <i class="fas fa-save me-2"></i> Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>

<div id="custom-alert" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #fee2e2; color: #b91c1c; padding: 20px; border-radius: 12px; z-index: 9999; box-shadow: 0 10px 40px rgba(0,0,0,0.1); font-weight: 700;">
    <i class="fas fa-exclamation-circle me-2"></i> Ukuran file tidak boleh lebih dari 2 MB.
</div>

<script>
    function cekUkuran(input) {
        const maxSize = 2 * 1024 * 1024;
        if (input.files[0] && input.files[0].size > maxSize) {
            input.value = "";
            const alertBox = document.getElementById('custom-alert');
            alertBox.style.display = 'block';
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }
    }
</script>

<?= $this->endSection() ?>