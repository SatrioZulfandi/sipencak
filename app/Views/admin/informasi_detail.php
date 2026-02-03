<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --brand: #2563eb;
        --brand-hover: #1d4ed8;
        --brand-soft: rgba(37, 99, 235, 0.05);
        --surface: #ffffff;
        --background: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --radius-xl: 32px;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background);
        color: var(--text-main);
    }

    /* --- LAYOUT --- */
    .info-container {
        max-width: 1000px;
        margin: 0 auto;
        padding-bottom: 4rem;
    }

    /* --- NAVIGATION --- */
    .nav-top {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .btn-circle-back {
        width: 42px;
        height: 42px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-main);
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-circle-back:hover {
        background: var(--brand);
        color: white;
        transform: translateX(-3px);
    }

    /* --- MAIN CARD --- */
    .modern-info-card {
        background: white;
        border-radius: var(--radius-xl);
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .info-body {
        padding: clamp(1.5rem, 5vw, 4rem);
    }

    .info-title-large {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.02em;
        margin-bottom: 2rem;
    }

    /* --- ARTICLE BOX --- */
    .article-box {
        background: #fcfcfc;
        border-radius: 24px;
        padding: 2.5rem;
        border: 1px solid #f1f5f9;
        position: relative;
    }

    .article-text {
        font-size: 1.1rem;
        line-height: 1.9;
        color: #334155;
        text-align: justify;
    }

    .article-text p {
        margin-bottom: 1.5rem;
    }

    /* --- GRID FOOTER INFO --- */
    .info-footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .footer-card-mini {
        background: white;
        border: 1px solid var(--border-color);
        padding: 1.5rem;
        border-radius: 20px;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: 0.3s;
    }

    .footer-card-mini:hover {
        border-color: var(--brand);
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: var(--brand-soft);
        color: var(--brand);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* --- COPYRIGHT AREA --- */
    .bottom-disclaimer {
        text-align: center;
        padding-top: 2rem;
        border-top: 1px solid var(--border-color);
        margin-top: 3rem;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    /* Animations */
    .reveal {
        animation: reveal 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes reveal {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .meta-bar-custom {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1.5rem;
        padding: 0 1rem 1.5rem 1rem;
        /* Jarak Kiri & Kanan (1rem) */
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.9rem;
        color: var(--text-muted);
    }
</style>

<div class="container py-4">
    <div class="info-container">

        <div class="nav-top">
            <a href="#" onclick="window.history.length > 1 ? window.history.back() : window.location.href='<?= site_url('/papan-informasi') ?>';" class="btn-circle-back shadow-sm">
                <i class="fas fa-arrow-left"></i>
            </a>
            <span class="fw-700 text-muted small uppercase" style="letter-spacing: 1px;">Detail Informasi</span>
        </div>

        <div class="modern-info-card reveal">
            <div class="info-body">
                <div class="d-flex flex-wrap align-items-center mb-4 border-bottom pb-4 px-3"
                    style="font-size: 0.9rem; color: var(--text-muted); column-gap: 2.0rem; row-gap: 1rem;">

                    <div class="d-flex align-items-center" style="gap: 3px;">
                        <i class="fas fa-calendar-alt text-primary me-2" style="font-size: 1rem;"></i>
                        <span><?= tgl_indo($data['tanggal']); ?></span>
                    </div>

                    <div class="d-flex align-items-center" style="gap: 3px;">
                        <i class="fas fa-eye text-primary me-3" style="font-size: 1.1rem;"></i>
                        <span style="letter-spacing: 1.9px;">Official Update</span>
                    </div>

                    <div class="ms-md-auto d-none d-md-flex align-items-center text-success fw-bold" style="gap: 3px;">
                        <i class="fas fa-shield-alt me-2"></i>
                        <span>Terverifikasi Sistem</span>
                    </div>

                </div>

                <h1 class="info-title-large"><?= esc($data['judul']); ?></h1>

                <div class="article-box">
                    <div class="article-text">
                        <?php
                        $deskripsi = html_entity_decode($data['deskripsi']);
                        echo $deskripsi;
                        ?>
                    </div>
                </div>

                <?php if (!empty($data['file'])): ?>
                    <div class="mt-4">
                        <a href="<?= base_url('/informasi/' . $data['file']); ?>" class="btn btn-primary w-100 py-3 rounded-pill fw-bold" download="<?= $data['file']; ?>">
                            <i class="fas fa-file-download me-2"></i> Download Lampiran Dokumen (<?= esc($data['file']); ?>)
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="info-footer-grid reveal" style="animation-delay: 0.2s;">
            <div class="footer-card-mini">
                <div class="icon-circle"><i class="fas fa-university"></i></div>
                <div>
                    <div class="fw-800 small text-dark">Sumber Informasi</div>
                    <div class="text-muted small">LLDIKTI Wilayah III Jakarta</div>
                </div>
            </div>

            <div class="footer-card-mini">
                <div class="icon-circle"><i class="fas fa-headset"></i></div>
                <div>
                    <div class="fw-800 small text-dark">Pusat Bantuan</div>
                    <div class="text-muted small">Helpdesk KIP-K Terintegrasi</div>
                </div>
            </div>

            <div class="footer-card-mini">
                <div class="icon-circle"><i class="fas fa-lock"></i></div>
                <div>
                    <div class="fw-800 small text-dark">Enkripsi Data</div>
                    <div class="text-muted small">Informasi Publik Aman</div>
                </div>
            </div>
        </div>

        <div class="bottom-disclaimer reveal" style="animation-delay: 0.4s;">
            <p class="mb-1"><strong>Penting:</strong> Pastikan Anda membaca seluruh isi pengumuman sebelum melakukan tindakan lebih lanjut.</p>
            <p>&copy; 2026 Pusat Informasi KIP-Kuliah LLDIKTI III. Seluruh hak cipta dilindungi undang-undang.</p>
            <div class="mt-3">
                <a href="#" class="text-muted mx-2 small text-decoration-none">Syarat & Ketentuan</a>
                <a href="#" class="text-muted mx-2 small text-decoration-none">Kebijakan Privasi</a>
            </div>
        </div>

    </div>
</div>

<?php
function tgl_indo($tanggal)
{
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $pecah = explode('-', date('Y-m-d', strtotime($tanggal)));
    return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}
?>

<?= $this->endSection(); ?>