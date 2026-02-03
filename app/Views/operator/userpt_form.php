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
        max-width: 900px;
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
        height: 46px;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 0 1rem;
        font-size: 0.875rem;
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
        background-size: 1.2em;
    }

    .status-selection {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
    }

    .status-option {
        flex: 1;
        cursor: pointer;
    }

    .status-option input {
        display: none;
    }

    .status-box {
        border: 1px solid var(--border-color);
        padding: 0.75rem;
        border-radius: 12px;
        text-align: center;
        font-weight: 700;
        font-size: 0.85rem;
        transition: 0.2s;
        color: var(--text-muted);
        background: #fcfcfd;
    }

    .status-option input:checked+.status-box.active {
        background: #dcfce7;
        color: #166534;
        border-color: #86efac;
    }

    .status-option input:checked+.status-box.inactive {
        background: #fee2e2;
        color: #991b1b;
        border-color: #fca5a5;
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
            <h4 class="fw-800 mb-0"><?= $sub ?> User PT</h4>
            <p class="text-muted small mb-0">Kelola kredensial dan informasi penanggung jawab</p>
        </div>

        <form action="<?= $act ?>" method="POST">
            <div class="form-body">
                <?php if (session('errors')): ?>
                    <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4">
                        <ul class="mb-0 small fw-600">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">Username <span class="required">*</span></label>
                        <input type="text" class="form-control-modern" name="username" required
                            value="<?= $btn === 'edit' ? esc($data['username']) : '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Perguruan Tinggi <span class="required">*</span></label>
                        <select name="id_pt" class="form-control-modern" required>
                            <option value="" disabled selected>- Pilih PT -</option>
                            <?php foreach ($pt as $item): ?>
                                <option value="<?= $item['id'] ?>" <?= ($btn === 'edit' && $data['id_pt'] == $item['id']) ? 'selected' : '' ?>>
                                    <?= $item['kode_pt'] ?> - <?= $item['perguruan_tinggi'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password <?= $btn === 'edit' ? '<small class="text-muted fw-normal">(Kosongkan jika tidak ubah)</small>' : '<span class="required">*</span>' ?></label>
                        <input type="password" class="form-control-modern" name="password" <?= $btn === 'add' ? 'required' : '' ?>>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Konfirmasi Password <?= $btn === 'edit' ? '' : '<span class="required">*</span>' ?></label>
                        <input type="password" class="form-control-modern" name="password_confirm" <?= $btn === 'add' ? 'required' : '' ?>>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-control-modern" name="penanggung_jawab" value="<?= $btn === 'edit' ? esc($data['penanggung_jawab']) : '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NIP / Identitas</label>
                        <input type="text" class="form-control-modern" name="nip" value="<?= $btn === 'edit' ? esc($data['nip']) : '' ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kontak (WhatsApp/Telp)</label>
                        <input type="text" class="form-control-modern" name="kontak" value="<?= $btn === 'edit' ? esc($data['kontak']) : '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Instansi</label>
                        <input type="email" class="form-control-modern" name="email" value="<?= $btn === 'edit' ? esc($data['email']) : '' ?>">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Status Akun</label>
                        <div class="status-selection">
                            <label class="status-option">
                                <input type="radio" name="status" value="aktif" <?= ($btn === 'add' || ($btn === 'edit' && $data['status'] === 'aktif')) ? 'checked' : '' ?>>
                                <div class="status-box active">Aktif</div>
                            </label>
                            <label class="status-option">
                                <input type="radio" name="status" value="nonaktif" <?= ($btn === 'edit' && $data['status'] === 'nonaktif') ? 'checked' : '' ?>>
                                <div class="status-box inactive">Nonaktif</div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <a href="/userpt-list" class="btn-modern btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn-modern btn-save">
                    <i class="fas fa-save"></i> <?= $btn === 'edit' ? 'Perbarui User' : 'Simpan User' ?>
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>