<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --brand: #2563eb;
        --brand-hover: #1d4ed8;
        --surface: #ffffff;
        --background: #f8fafc;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
        --radius-lg: 24px;
        --radius-md: 16px;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background);
        color: var(--text-main);
    }

    .detail-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-top: 2rem;
    }

    .detail-header-custom {
        padding: 2rem 2.5rem;
        background: linear-gradient(to bottom, #ffffff, #f8fafc);
        border-bottom: 1px solid var(--border-color);
    }

    .btn-back-custom {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: 0.2s;
        margin-bottom: 1.5rem;
    }

    .btn-back-custom:hover {
        color: var(--brand);
    }

    .info-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand);
        border-radius: 100px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .info-title {
        font-weight: 800;
        font-size: 1.75rem;
        line-height: 1.3;
        letter-spacing: -0.02em;
        color: var(--text-main);
    }

    .info-meta {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-top: 1.5rem;
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-body {
        padding: 2.5rem;
    }

    .content-area {
        line-height: 1.8;
        color: #334155;
        font-size: 1rem;
    }

    .attachment-box {
        background: #f1f5f9;
        border-radius: var(--radius-md);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        border: 1px solid var(--border-color);
    }

    .attachment-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .attachment-icon {
        height: 48px;
        width: 48px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand);
        font-size: 1.25rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .btn-download-custom {
        background: var(--brand);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-download-custom:hover {
        background: var(--brand-hover);
        color: white;
        transform: translateY(-2px);
    }

    .toggle-wrapper {
        margin-top: 2rem;
        text-align: center;
    }

    .btn-toggle-custom {
        background: transparent;
        border: 2px solid var(--border-color);
        color: var(--text-main);
        padding: 0.5rem 1.5rem;
        border-radius: 100px;
        font-weight: 700;
        font-size: 0.85rem;
        transition: 0.2s;
    }

    .btn-toggle-custom:hover {
        border-color: var(--brand);
        color: var(--brand);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <a href="#" onclick="window.history.length > 1 ? window.history.back() : window.location.href='<?= site_url('/informasi-list') ?>';" class="btn-back-custom">
                <i class="fas fa-chevron-left"></i>
                <span>Kembali ke Daftar</span>
            </a>

            <div class="detail-card">
                <div class="detail-header-custom">
                    <span class="info-badge">Informasi Publik</span>
                    <h1 class="info-title"><?= esc($data['judul']) ?></h1>

                    <div class="info-meta">
                        <div class="meta-item">
                            <i class="far fa-calendar-alt"></i>
                            <span><?= date('d F Y', strtotime($data['tanggal'])) ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-clock"></i>
                            <span>09:00 WIB</span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-user"></i>
                            <span>Administrator</span>
                        </div>
                    </div>
                </div>

                <div class="detail-body">
                    <?php if (!empty($data['file'])): ?>
                        <div class="attachment-box">
                            <div class="attachment-info">
                                <div class="attachment-icon">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark mb-0">Lampiran Dokumen</div>
                                    <div class="small text-muted"><?= esc($data['file']) ?></div>
                                </div>
                            </div>
                            <a href="<?= base_url('/informasi/' . $data['file']); ?>" class="btn-download-custom" download>
                                <i class="fas fa-cloud-download-alt me-2"></i> Unduh
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    $decoded = html_entity_decode($data['deskripsi']);
                    $strip = strip_tags($decoded);
                    $limit = 600;
                    $isLong = strlen($strip) > $limit;

                    function smart_truncate($html, $limit)
                    {
                        $decoded = html_entity_decode($html);
                        if (strlen(strip_tags($decoded)) <= $limit) return $decoded;
                        return substr($decoded, 0, strpos($decoded, ' ', $limit)) . '...';
                    }
                    ?>

                    <div class="content-area">
                        <div id="desc-short" style="<?= $isLong ? '' : 'display:none' ?>">
                            <?= smart_truncate($data['deskripsi'], $limit) ?>
                            <?php if ($isLong): ?>
                                <div class="toggle-wrapper">
                                    <button class="btn-toggle-custom" onclick="toggleDeskripsi()">Baca Selengkapnya</button>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div id="desc-full" style="<?= $isLong ? 'display:none' : '' ?>">
                            <?= $decoded ?>
                            <?php if ($isLong): ?>
                                <div class="toggle-wrapper">
                                    <button class="btn-toggle-custom" onclick="toggleDeskripsi()">Sembunyikan</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDeskripsi() {
        const short = document.getElementById('desc-short');
        const full = document.getElementById('desc-full');
        const isShortVisible = short.style.display !== 'none';

        short.style.display = isShortVisible ? 'none' : '';
        full.style.display = isShortVisible ? '' : 'none';

        if (isShortVisible) {
            full.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest'
            });
        }
    }
</script>

<?= $this->endSection(); ?>