<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

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
        --radius-lg: 20px;
        --radius-md: 14px;
        --shadow-sm: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background);
        color: var(--text-main);
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .filter-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
        padding: 1.25rem;
        margin-bottom: 2rem;
        transition: 0.3s;
    }

    .filter-card:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .search-input-group {
        position: relative;
        flex-grow: 1;
    }

    .search-input-group i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .form-control-custom {
        height: 45px;
        padding-left: 2.8rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        font-size: 0.85rem;
        width: 100%;
        background: #fcfcfd;
        transition: 0.2s;
    }

    .form-control-custom:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
        background: white;
    }

    .date-input {
        padding-left: 1rem !important;
    }

    .btn-filter {
        height: 45px;
        border-radius: 12px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    @media (max-width: 1200px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .news-grid {
            grid-template-columns: 1fr;
        }
    }

    .news-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.1);
        border-color: var(--brand);
    }

    .image-wrapper {
        position: relative;
        overflow: hidden;
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
    }

    .news-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 1.5rem;
        transition: transform 0.6s ease;
    }

    .category-badge {
        position: absolute;
        top: 0.75rem;
        left: 0.75rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        color: var(--brand);
        padding: 0.3rem 0.8rem;
        border-radius: 100px;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        z-index: 2;
    }

    .news-body {
        padding: 1.25rem;
        flex-grow: 1;
    }

    .news-date {
        font-size: 0.7rem;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .news-title {
        font-weight: 800;
        font-size: 1.05rem;
        line-height: 1.4;
        margin-bottom: 0.75rem;
        color: var(--text-main);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-desc {
        font-size: 0.8rem;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 0;
    }

    .news-footer {
        padding: 1rem 1.25rem;
        background: #fcfcfd;
        border-top: 1px solid var(--border-color);
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        height: 36px;
        width: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        text-decoration: none;
        border: 1px solid var(--border-color);
        font-size: 0.8rem;
    }

    .btn-view-main {
        flex-grow: 1;
        background: var(--brand);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-view-main:hover {
        background: var(--brand-hover);
        color: white;
    }

    .btn-edit:hover {
        border-color: #f59e0b;
        color: #d97706;
        background: #fffbeb;
    }

    .btn-delete:hover {
        border-color: #ef4444;
        color: #dc2626;
        background: #fef2f2;
    }

    .btn-add {
        background: var(--brand);
        color: white;
        padding: 0.6rem 1.25rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add:hover {
        background: var(--brand-hover);
        color: white;
    }

    /* Custom Pager Styling */
    .pagination {
        margin-bottom: 0;
        gap: 5px;
    }

    .pagination li a,
    .pagination li span {
        border-radius: 8px !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-main) !important;
        font-size: 0.8rem !important;
        padding: 8px 14px !important;
    }

    .pagination li.active span {
        background-color: var(--brand) !important;
        border-color: var(--brand) !important;
        color: white !important;
    }
</style>

<div class="container-fluid py-4 px-lg-5">
    <div class="page-header">
        <div>
            <h4 class="fw-800 mb-1">Manajemen Informasi</h4>
            <p class="text-muted small mb-0">Publikasi berita dan panduan KIP-K</p>
        </div>
        <a href="<?= base_url('informasi-create') ?>" class="btn-add">
            <i class="fas fa-plus-circle"></i>
            <span>Tambah</span>
        </a>
    </div>

    <form action="<?= base_url('informasi-list') ?>" method="get" class="filter-card">
        <div class="row g-2">
            <div class="col-lg-5">
                <div class="search-input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control-custom" placeholder="Cari judul atau deskripsi..." value="<?= esc($search ?? '') ?>">
                </div>
            </div>
            <div class="col-lg-3">
                <input type="date" name="start_date" class="form-control-custom date-input" value="<?= esc($start_date ?? '') ?>" title="Tanggal Mulai">
            </div>
            <div class="col-lg-3">
                <input type="date" name="end_date" class="form-control-custom date-input" value="<?= esc($end_date ?? '') ?>" title="Tanggal Selesai">
            </div>
            <div class="col-lg-1">
                <button type="submit" class="btn btn-primary btn-filter w-100">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </div>
        <?php if (!empty($search) || !empty($start_date) || !empty($end_date)): ?>
            <div class="mt-2">
                <a href="<?= base_url('informasi-list') ?>" class="text-decoration-none small text-danger fw-600">
                    <i class="fas fa-times-circle"></i> Hapus Filter
                </a>
            </div>
        <?php endif; ?>
    </form>

    <?php if (empty($data)) : ?>
        <div class="text-center py-5 bg-white rounded-4 border">
            <div class="mb-3 text-muted opacity-25">
                <i class="fas fa-search fa-4x"></i>
            </div>
            <h6 class="fw-700 text-dark">Data tidak ditemukan</h6>
            <p class="small text-muted">Coba ubah kata kunci atau filter tanggal Anda.</p>
            <a href="<?= base_url('informasi-list') ?>" class="btn btn-sm btn-outline-primary rounded-pill">Reset Filter</a>
        </div>
    <?php else : ?>
        <div class="news-grid">
            <?php foreach ($data as $row): ?>
                <div class="news-card">
                    <div class="image-wrapper">
                        <span class="category-badge">Info</span>
                        <img src="<?= base_url('assets/img/lldikti3.png'); ?>" alt="Thumbnail" class="news-image">
                    </div>
                    <div class="news-body">
                        <div class="news-date">
                            <i class="far fa-calendar-alt text-primary"></i>
                            <?= date('d M Y', strtotime($row['tanggal'])) ?>
                        </div>
                        <div class="news-title"><?= esc($row['judul']) ?></div>
                        <p class="news-desc">
                            <?= word_limiter(strip_tags(html_entity_decode($row['deskripsi'])), 12) ?>
                        </p>
                    </div>
                    <div class="news-footer">
                        <a href="<?= base_url('informasi-show/' . $row['id']) ?>" class="btn-view-main">Baca</a>
                        <a href="<?= base_url('informasi-edit/' . $row['id']) ?>" class="btn-action btn-edit" title="Edit"><i class="fas fa-pen"></i></a>
                        <a href="<?= base_url('informasi-delete/' . $row['id']) ?>" class="btn-action btn-delete" title="Hapus" onclick="return confirm('Hapus informasi ini?')"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

        <div class="mt-5 d-flex justify-content-center">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>