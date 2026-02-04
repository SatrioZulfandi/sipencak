<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<style>
    :root {
        --primary: #2563eb;
        --primary-soft: #eff6ff;
        --primary-glow: rgba(37, 99, 235, 0.15);
        --dark: #0f172a;
        --slate: #64748b;
        --border: #e2e8f0;
        --white: #ffffff;
        --glass: rgba(255, 255, 255, 0.7);
    }

    .page-animate {
        animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* --- MODERN ARCHITECTURE --- */
    .elite-container {
        max-width: 900px;
        margin: auto;
    }

    .main-form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 32px;
        box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        position: relative;
    }

    .form-hero {
        padding: 3rem 3rem 2rem;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
        border-bottom: 1px solid var(--border);
    }

    .icon-box {
        width: 64px;
        height: 64px;
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
        margin-bottom: 1.5rem;
    }

    /* --- NEW INPUT DESIGN (NEO-INPUT) --- */
    .field-group {
        position: relative;
        margin-bottom: 0.5rem;
    }

    .field-label {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--slate);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 10px;
        display: block;
        transition: all 0.3s;
    }

    .input-premium {
        width: 100%;
        background: #f1f5f9;
        border: 2px solid transparent;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .input-premium:focus {
        background: var(--white);
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-glow);
        outline: none;
    }

    .field-group:focus-within .field-label {
        color: var(--primary);
        transform: translateX(4px);
    }

    /* --- CUSTOM SELECT --- */
    select.input-premium {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1.25rem center;
        background-size: 1.2rem;
    }

    /* --- ACTION BUTTONS --- */
    .action-bar {
        padding: 2.5rem 3rem;
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-save {
        background: var(--primary);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 16px;
        font-weight: 700;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
    }

    .btn-save:hover {
        background: var(--primary-hover);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
    }

    .btn-back {
        color: var(--slate);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: 0.3s;
    }

    .btn-back:hover {
        color: var(--dark);
        transform: translateX(-5px);
    }

    .badge-status {
        font-size: 0.65rem;
        padding: 6px 14px;
        border-radius: 100px;
        background: var(--primary-soft);
        color: var(--primary);
        font-weight: 800;
        letter-spacing: 0.05em;
    }
</style>

<div class="container py-5 page-animate">
    <div class="elite-container">

        <form action="<?= $act ?>" method="POST" class="main-form-card">
            <?= csrf_field() ?>

            <div class="form-hero">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="icon-box">
                        <i class="fas fa-user-graduate fs-4 text-primary"></i>
                    </div>
                    <span class="badge-status">
                        <i class="fas fa-lock me-1"></i> <?= strtoupper($btn) ?> MODE
                    </span>
                </div>
                <h2 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.03em;">
                    <?= $btn == 'edit' ? 'Update Data' : 'Tambah Mahasiswa' ?>
                </h2>
                <p class="text-muted mb-0">Lengkapi berkas akademik mahasiswa dengan data valid PDDIKTI.</p>
            </div>

            <div class="p-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="field-label">Nomor Induk Mahasiswa</label>
                            <input type="text" class="input-premium" name="nim" placeholder="Masukkan NIM" required
                                value="<?= $btn == 'edit' ? esc($data['nim']) : '' ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="field-label">Nama Mahasiswa</label>
                            <input type="text" class="input-premium" name="nama" placeholder="Nama Lengkap" required
                                value="<?= $btn == 'edit' ? esc($data['nama']) : '' ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="field-label">Jenjang Pendidikan</label>
                            <select name="jenjang" class="input-premium" required>
                                <option value="" disabled selected>Pilih Jenjang</option>
                                <?php
                                $jenjangOptions = ['D3', 'D4', 'S1', 'S2', 'S3', 'Profesi'];
                                foreach ($jenjangOptions as $j) {
                                    $selected = ($btn == 'edit' && $data['jenjang'] == $j) ? 'selected' : '';
                                    echo "<option value=\"$j\" $selected>$j</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="field-label">Kategori Penerima</label>
                            <select name="kategori" class="input-premium" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Skema Pembiayaan Penuh" <?= $btn == 'edit' && $data['kategori'] == 'Skema Pembiayaan Penuh' ? 'selected' : '' ?>>Skema Pembiayaan Penuh</option>
                                <option value="Skema Biaya Pendidikan" <?= $btn == 'edit' && $data['kategori'] == 'Skema Biaya Pendidikan' ? 'selected' : '' ?>>Skema Biaya Pendidikan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="field-label">Program Studi</label>
                            <select name="id_prodi" class="input-premium" required>
                                <option value="" disabled selected>Pilih Program Studi</option>
                                <?php foreach ($prodi as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= $btn == 'edit' && $p['id'] == $data['id_prodi'] ? 'selected' : '' ?>>
                                        <?= $p['kode_prodi'] ?> - <?= $p['nama_prodi'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="field-label">Tahun Angkatan</label>
                            <input type="number" class="input-premium" name="angkatan" placeholder="Contoh: 2024" required
                                value="<?= $btn == 'edit' ? esc($data['angkatan']) : '' ?>">
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id_pt" value="<?= session()->get('pt') ?>">

            <div class="action-bar">
                <a href="/mahasiswa-list" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-check-circle me-2"></i> Konfirmasi & Simpan
                </button>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>