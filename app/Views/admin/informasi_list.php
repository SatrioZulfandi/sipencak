<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #2563eb;
        --primary-hover: #1d4ed8;
        --bg: #f8fafc;
        --card-bg: #ffffff;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --border: #e2e8f0;
        --radius-lg: 24px;
        --radius-md: 16px;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--bg);
        color: var(--text-dark);
        letter-spacing: -0.01em;
    }

    .dashboard-wrapper {
        padding: 3rem 1.5rem;
        min-height: 100vh;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .section-header h2 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .search-wrapper {
        position: relative;
        max-width: 480px;
        margin-bottom: 3rem;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3.5rem;
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
    }

    @media (min-width: 992px) {
        .info-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .premium-card {
        background: var(--card-bg);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .premium-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        /* Interactive shadow on hover */
        border-color: var(--primary);
    }

    .card-img-container {
        height: 180px;
        overflow: hidden;
        position: relative;
        background: #f1f5f9;
    }

    .card-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 800;
        color: var(--primary);
    }

    .card-body-premium {
        padding: 1.75rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    /* Meta Info (Tanggal) Style */
    .info-meta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        margin-bottom: 0.6rem;
    }

    .info-meta i {
        color: var(--primary);
    }

    .info-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-dark);
        text-decoration: none;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .info-desc {
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.6;
        margin-bottom: 1.75rem;
        flex-grow: 1;
    }

    .btn-action {
        background: #f1f5f9;
        color: var(--text-dark);
        padding: 0.8rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        text-decoration: none;
        text-align: center;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
    }

    .btn-action:hover {
        background: var(--primary);
        color: white !important;
    }

    /* Pagination Styling */
    .pagination-container {
        margin-top: 4rem;
        display: flex;
        justify-content: center;
    }

    .pagination-container ul {
        display: flex;
        list-style: none;
        gap: 8px;
        padding: 0;
        align-items: center;
    }

    .pagination-container li a,
    .pagination-container li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        border-radius: 10px;
        border: 1px solid var(--border);
        color: var(--text-dark);
        text-decoration: none;
        font-weight: 700;
        background: var(--card-bg);
        font-size: 0.8rem;
    }

    .pagination-container li.active a,
    .pagination-container li.active span {
        background: var(--primary) !important;
        color: white !important;
        border-color: var(--primary) !important;
    }

    .card-img-container {
        height: 190px;
        /* Diubah dari 180px menjadi lebih kecil */
        overflow: hidden;
        position: relative;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        /* Memberikan ruang agar gambar tidak menyentuh tepi */
    }

    .card-img-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        /* Menggunakan contain agar logo/gambar tidak terpotong */
        transition: transform 0.6s ease;
    }
</style>

<div class="dashboard-wrapper">
    <div class="container">
        <header class="section-header">
            <h2>Papan Informasi</h2>
            <p>Update terkini mengenai kegiatan di lingkungan LLDIKTI III.</p>
        </header>

        <form action="<?= current_url() ?>" method="get" class="search-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input type="text" name="keyword" class="search-input" placeholder="Cari informasi..." value="<?= esc($keyword ?? '') ?>">
        </form>

        <?php if (empty($data)): ?>
            <div class="text-center py-5">
                <h4 class="text-muted">Informasi tidak ditemukan.</h4>
                <a href="<?= base_url('admin/informasi') ?>" class="btn-action d-inline-flex mt-3" style="width: auto; padding: 10px 25px;">Reset</a>
            </div>
        <?php else: ?>
            <div class="info-grid">
                <?php foreach ($data as $row): ?>
                    <article class="premium-card">
                        <div class="card-img-container">
                            <span class="category-badge">NEWS UPDATE</span>
                            <img src="<?= base_url('assets/img/lldikti3.png') ?>" alt="Thumbnail">
                        </div>
                        <div class="card-body-premium">
                            <div class="info-meta">
                                <i class="far fa-calendar-alt"></i>
                                <?= date('d M Y', strtotime($row['tanggal'])) ?>
                            </div>

                            <a href="<?= base_url('informasi-detail/' . $row['id']) ?>" class="info-title">
                                <?= esc($row['judul']) ?>
                            </a>

                            <div class="info-desc">
                                <?= word_limiter(strip_tags($row['deskripsi']), 10) ?>
                            </div>

                            <a href="<?= base_url('informasi-detail/' . $row['id']) ?>" class="btn-action">
                                Baca Selengkapnya <i class="fas fa-arrow-right fa-xs"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach ?>
            </div>

            <div class="pagination-container">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        <?php endif ?>
    </div>
</div>

<?= $this->endSection() ?>