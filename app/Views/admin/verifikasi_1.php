<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary: #2563eb;
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
        max-width: 900px;
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

    /* --- SECTION STYLING --- */
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

    /* --- RADIO ELITE --- */
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
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--slate);
        transition: all 0.3s ease;
        text-align: center;
    }

    .radio-card input:checked+.radio-label-content {
        border-color: var(--primary);
        background: var(--primary-soft);
        color: var(--primary);
    }

    /* --- INPUT PREMIUM --- */
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

    /* --- FILE UPLOAD BOX --- */
    .file-upload-elite {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 8px 12px;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: 0.3s;
    }

    .file-upload-elite:hover {
        border-color: var(--primary);
    }

    /* --- ACTION BAR --- */
    .action-bar {
        padding: 2rem 3rem;
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-save-elite {
        background: var(--success);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);
        transition: 0.3s;
    }

    .btn-save-elite:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 20px -5px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .btn-back-elite {
        color: var(--slate);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
    }
</style>

<div class="container py-5 fade-in-up">
    <div class="elite-container">

        <form action="/permohonan-store" method="POST" enctype="multipart/form-data" class="main-form-card">
            <?= csrf_field() ?>

            <?php
            $bulan = date('n');
            $tahun = date('Y');
            if ($bulan >= 8) {
                $periodeOtomatis = 'Semester Ganjil / ' . $tahun;
                $activeSemester = 'Semester Ganjil';
            } else {
                $periodeOtomatis = 'Semester Genap / ' . $tahun;
                $activeSemester = 'Semester Genap';
            }
            $selectedPeriode = old('periode') ?? $activeSemester;
            ?>

            <div class="form-hero d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.02em;">Permohonan Pencairan</h4>
                    <p class="text-muted small mb-0">Lengkapi dokumen syarat pencairan dana beasiswa.</p>
                </div>
                <span class="badge rounded-pill px-3 py-2" style="background: #dcfce7; color: #15803d; font-weight: 800; font-size: 0.75rem;">
                    <i class="fas fa-calendar-check me-1"></i> <?= $periodeOtomatis ?>
                </span>
            </div>

            <div class="p-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="field-label">Kategori Mahasiswa <span class="text-danger">*</span></label>
                        <div class="radio-group-modern">
                            <label class="radio-card">
                                <input type="radio" name="kategori_penerima" id="kategori1" value="Skema Pembiayaan Penuh" required>
                                <span class="radio-label-content">Pembiayaan Penuh</span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="kategori_penerima" id="kategori2" value="Skema Biaya Pendidikan">
                                <span class="radio-label-content">Biaya Pendidikan</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label">Periode Semester <span class="text-danger">*</span></label>
                        <div class="radio-group-modern">
                            <label class="radio-card">
                                <input type="radio" name="semester" id="sem1" value="Ganjil" required>
                                <span class="radio-label-content">Semester Ganjil</span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="semester" id="sem2" value="Genap">
                                <span class="radio-label-content">Semester Genap</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="section-divider">Berkas SPTJM</div>
                <div class="mb-4">
                    <label class="field-label">Unggah Scan SPTJM (PDF, Max 2MB)</label>
                    <div class="file-upload-elite">
                        <i class="fas fa-file-pdf text-danger fs-5"></i>
                        <input type="file" class="form-control border-0 bg-transparent p-0 shadow-none" name="sptjm" accept=".pdf" required onchange="cekUkuran(this)">
                    </div>
                </div>

                <div class="section-divider">Informasi & Berkas SK</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label class="field-label">No. SK / Surat Permohonan</label>
                        <input type="text" class="input-premium" name="no_surat_permohonan" placeholder="Contoh: 123/SK/2026" required>
                    </div>
                    <div class="col-md-4">
                        <label class="field-label">Tanggal Surat</label>
                        <input type="date" class="input-premium" name="tanggal" required>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="field-label">Scan SK Penetapan</label>
                        <div class="file-upload-elite">
                            <i class="fas fa-file-contract text-primary fs-5"></i>
                            <input type="file" class="form-control border-0 bg-transparent p-0 shadow-none" name="sk_penetapan" accept=".pdf" required onchange="cekUkuran(this)">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="field-label">Scan SK Pembatalan</label>
                        <div class="file-upload-elite">
                            <i class="fas fa-file-signature text-warning fs-5"></i>
                            <input type="file" class="form-control border-0 bg-transparent p-0 shadow-none" name="sk_pembatalan" accept=".pdf" required onchange="cekUkuran(this)">
                        </div>
                    </div>
                </div>

                <div class="section-divider">Berita Acara Evaluasi</div>
                <div class="mb-2">
                    <label class="field-label">Unggah Berita Acara Evaluasi</label>
                    <div class="file-upload-elite">
                        <i class="fas fa-clipboard-check text-success fs-5"></i>
                        <input type="file" class="form-control border-0 bg-transparent p-0 shadow-none" name="berita_acara" accept=".pdf" required onchange="cekUkuran(this)">
                    </div>
                </div>

                <input type="hidden" name="id_pt" value="<?= session()->get('pt') ?>">

                <div class="d-none">
                    <input type="radio" name="periode_hidden" value="Semester Ganjil" <?= ($selectedPeriode == 'Semester Ganjil') ? 'checked' : '' ?>>
                    <input type="radio" name="periode_hidden" value="Genap" <?= ($selectedPeriode == 'Genap') ? 'checked' : '' ?>>
                </div>
            </div>

            <div class="action-bar">
                <a href="/verifikasi-pembaharuan-status" class="btn-back-elite">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
                <button type="submit" class="btn-save-elite">
                    <i class="fas fa-save me-2"></i> Simpan Permohonan
                </button>
            </div>
        </form>
    </div>
</div>

<div id="custom-alert" style="display: none; position: fixed; top: 50%; left: 50%; 
    transform: translate(-50%, -50%); background-color: #f8d7da; color: #721c24; 
    padding: 20px 30px; border: 1px solid #f5c6cb; border-radius: 12px; z-index: 9999;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2); font-size: 16px; font-weight: 700;">
    <i class="fas fa-exclamation-circle me-2"></i> Ukuran file tidak boleh lebih dari 2 MB.
</div>

<script>
    function cekUkuran(input) {
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (input.files[0] && input.files[0].size > maxSize) {
            input.value = ""; // kosongkan file
            showAlert(); // tampilkan pesan
        }
    }

    function showAlert() {
        const alertBox = document.getElementById('custom-alert');
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000); // hilang dalam 3 detik
    }
</script>

<?= $this->endSection() ?>