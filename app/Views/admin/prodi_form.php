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

    .elite-container {
        max-width: 800px;
        margin: auto;
    }

    .main-form-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 32px;
        box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05);
        overflow: hidden;
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

    /* --- NEO-INPUT DESIGN --- */
    .field-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .field-label {
        font-size: 0.75rem;
        /* Compact 0.8rem equivalent */
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
        padding: 1.1rem 1.25rem;
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

    /* --- ACTION BAR --- */
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
        background: #1d4ed8;
        transform: translateY(-3px);
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
                        <i class="fas fa-book-open fs-4 text-primary"></i>
                    </div>
                    <span class="badge-status">
                        <i class="fas fa- university me-1"></i> <?= strtoupper($sub) ?> DATA
                    </span>
                </div>
                <h2 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.03em;">
                    <?= $btn == 'edit' ? 'Perbarui' : 'Tambah' ?> Program Studi
                </h2>
                <p class="text-muted mb-0">Kelola identitas program studi untuk sinkronisasi data mahasiswa.</p>
            </div>

            <div class="p-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="field-group">
                            <label class="field-label">Kode Program Studi</label>
                            <input type="text" class="input-premium" name="kode_prodi" placeholder="Contoh: INF-01" required
                                value="<?= $btn == 'edit' ? esc($data['kode_prodi']) : '' ?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="field-group">
                            <label class="field-label">Nama Lengkap Prodi</label>
                            <input type="text" class="input-premium" name="nama_prodi" placeholder="Masukkan nama program studi" required
                                value="<?= $btn == 'edit' ? esc($data['nama_prodi']) : '' ?>">
                        </div>
                    </div>
                </div>

                <input type="hidden" name="id_pt" value="<?= session()->get('pt') ?>">
            </div>

            <div class="action-bar">
                <a href="/prodi-list" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection(); ?>