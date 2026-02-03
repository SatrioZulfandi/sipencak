<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<style>
    :root {
        --primary: #2563eb;
        --primary-soft: #eff6ff;
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

    .detail-container {
        max-width: 900px;
        margin: auto;
    }

    .profile-header {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 32px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        background: var(--primary-soft);
        color: var(--primary);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    .info-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.05);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0;
    }

    .info-item {
        padding: 2rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-item:nth-child(odd) {
        border-right: 1px solid #f1f5f9;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--slate);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 8px;
        display: block;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #f1f5f9;
        color: var(--slate);
    }

    .badge-penerima {
        background: #dcfce7;
        color: #15803d;
    }

    .action-footer {
        margin-top: 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-edit-link {
        background: var(--primary);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 16px;
        font-weight: 700;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-edit-link:hover {
        background: var(--primary-hover);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        color: white;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-item:nth-child(odd) {
            border-right: none;
        }
    }
</style>

<div class="container py-5 page-animate">
    <div class="detail-container">

        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--dark); letter-spacing: -0.03em;"><?= esc($data['nama']) ?></h2>
                <div class="d-flex gap-2 align-items-center">
                    <span class="status-badge"><i class="fas fa-fingerprint me-2"></i><?= esc($data['nim']) ?></span>
                    <span class="status-badge badge-penerima"><i class="fas fa-check-circle me-2"></i><?= esc($data['status_pengajuan']) ?></span>
                </div>
            </div>
        </div>

        <div class="info-card">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Program Studi</span>
                    <div class="info-value"><?= esc($data['kode_prodi']) ?> - <?= esc($data['nama_prodi']) ?></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Jenjang Pendidikan</span>
                    <div class="info-value"><?= esc($data['jenjang']) ?></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Angkatan</span>
                    <div class="info-value"><?= esc($data['angkatan']) ?></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Kategori Beasiswa</span>
                    <div class="info-value"><?= esc($data['kategori']) ?></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Pembaruan Status</span>
                    <div class="info-value">
                        <span class="badge rounded-pill bg-light text-dark border px-3"><?= esc($data['pembaruan_status']) ?></span>
                    </div>
                </div>
                <div class="info-item">
                    <span class="info-label">Perguruan Tinggi</span>
                    <div class="info-value">
                        <?= esc($data['perguruan_tinggi']) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-footer">
            <a href="<?= site_url('mahasiswa-list') ?>" class="text-decoration-none fw-bold text-slate">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
            </a>
            <a href="<?= site_url('mahasiswa-edit/' . $data['id']) ?>" class="btn-edit-link">
                <i class="fas fa-edit me-2"></i> Perbarui Data
            </a>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>