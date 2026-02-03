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
        --radius-lg: 20px;
        --radius-md: 14px;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--background);
        color: var(--text-main);
    }

    .form-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        max-width: 800px;
        margin: 0 auto;
    }

    .form-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border-color);
        background: #fcfcfd;
    }

    .form-body {
        padding: 2rem;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .required {
        color: #ef4444;
        margin-left: 2px;
    }

    .form-control-modern {
        height: 48px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 0 1rem;
        font-size: 0.9rem;
        transition: all 0.2s;
        width: 100%;
        background: #fcfcfd;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: var(--brand);
        background: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    select.form-control-modern {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    .btn-modern {
        height: 48px;
        padding: 0 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-save {
        background: var(--brand);
        color: white;
    }

    .btn-save:hover {
        background: var(--brand-hover);
        transform: translateY(-1px);
    }

    .btn-back {
        background: #f1f5f9;
        color: var(--text-muted);
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: var(--text-main);
    }

    .form-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="container-fluid py-5">
    <div class="form-card">
        <div class="form-header">
            <h4 class="fw-800 mb-0" style="letter-spacing: -0.02em;"><?= $sub ?> Perguruan Tinggi</h4>
            <p class="text-muted small mb-0">Lengkapi informasi detail perguruan tinggi di bawah ini</p>
        </div>

        <form action="<?= $act ?>" method="POST">
            <div class="form-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Kode Perguruan Tinggi <span class="required">*</span></label>
                        <input type="text" class="form-control-modern" name="kode_pt" placeholder="Contoh: 031001" required
                            value="<?= $btn == 'edit' ? esc($data['kode_pt']) : '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Akreditasi (AIPT)</label>
                        <select name="aipt" class="form-control-modern">
                            <option value="">- Pilih AIPT -</option>
                            <option value="A (Unggul)" <?= ($btn == 'edit' && $data['aipt'] == 'A (Unggul)') ? 'selected' : '' ?>>A (Unggul)</option>
                            <option value="B (Baik Sekali)" <?= ($btn == 'edit' && $data['aipt'] == 'B (Baik Sekali)') ? 'selected' : '' ?>>B (Baik Sekali)</option>
                            <option value="C (Baik)" <?= ($btn == 'edit' && $data['aipt'] == 'C (Baik)') ? 'selected' : '' ?>>C (Baik)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Nama Perguruan Tinggi <span class="required">*</span></label>
                        <input type="text" class="form-control-modern" name="perguruan_tinggi" placeholder="Masukkan nama resmi perguruan tinggi" required
                            value="<?= $btn == 'edit' ? esc($data['perguruan_tinggi']) : '' ?>">
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <a href="/pt-list" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <button type="submit" class="btn-modern btn-save">
                    <i class="fas fa-save"></i>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>