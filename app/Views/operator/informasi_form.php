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
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        max-width: 900px;
        margin: 2rem auto;
    }

    .form-header {
        padding: 1.5rem 2rem;
        background: linear-gradient(to right, #ffffff, #f8fafc);
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-icon {
        width: 40px;
        height: 40px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--brand);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .form-body {
        padding: 2rem;
    }

    .label-custom {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--text-main);
        margin-bottom: 0.5rem;
        display: block;
    }

    .required {
        color: #ef4444;
    }

    .form-control-custom {
        border-radius: 10px;
        border: 1px solid var(--border-color);
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: 0.2s;
        background: #fcfcfd;
    }

    .form-control-custom:focus {
        border-color: var(--brand);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        background: white;
        outline: none;
    }

    .file-upload-wrapper {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        background: #f8fafc;
        transition: 0.2s;
    }

    .file-upload-wrapper:hover {
        border-color: var(--brand);
        background: #f0f7ff;
    }

    .note-editor {
        border-radius: 12px !important;
        border: 1px solid var(--border-color) !important;
        overflow: hidden;
    }

    .note-toolbar {
        background: #f8fafc !important;
        border-bottom: 1px solid var(--border-color) !important;
    }

    .form-footer {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-save {
        background: var(--brand);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-save:hover {
        background: var(--brand-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-cancel {
        color: var(--text-muted);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        color: var(--text-main);
    }
</style>

<div class="container-fluid py-4">
    <div class="form-card">
        <div class="form-header">
            <div class="header-icon">
                <i class="fas <?= $btn == 'edit' ? 'fa-edit' : 'fa-plus-circle' ?>"></i>
            </div>
            <div>
                <h5 class="fw-800 mb-0" style="letter-spacing: -0.02em;"><?= $sub ?> Informasi</h5>
                <p class="text-muted small mb-0">Lengkapi data informasi di bawah ini</p>
            </div>
        </div>

        <form action="<?= $act ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-body">
                <div class="mb-4">
                    <label class="label-custom">Judul Informasi <span class="required">*</span></label>
                    <input type="text" class="form-control-custom w-100" name="judul"
                        placeholder="Contoh: Pengumuman Seleksi KIP-K 2026" required
                        value="<?= $btn == 'edit' ? esc($data['judul']) : '' ?>">
                </div>

                <div class="mb-4">
                    <label class="label-custom">Deskripsi Lengkap <span class="required">*</span></label>
                    <textarea id="summernote" name="deskripsi"><?= $btn == 'edit' ? html_entity_decode($data['deskripsi']) : '' ?></textarea>
                </div>

                <div class="mb-2">
                    <label class="label-custom">Lampiran Dokumen <span class="text-muted">(Opsional)</span></label>
                    <div class="file-upload-wrapper">
                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                        <input type="file" class="form-control d-none" name="file" id="fileInput">
                        <label for="fileInput" class="d-block small fw-600 text-primary" style="cursor: pointer;">
                            Klik untuk unggah berkas atau tarik ke sini
                        </label>
                        <p class="text-muted mb-0" style="font-size: 0.7rem;">PDF, DOCX, JPG (Maks. 5MB)</p>

                        <?php if (!empty($data['file'])): ?>
                            <div class="mt-3 p-2 bg-white rounded border d-inline-flex align-items-center gap-2">
                                <i class="fas fa-file-alt text-primary"></i>
                                <span class="small fw-600"><?= esc($data['file']) ?></span>
                                <a href="<?= base_url('/informasi/' . $data['file']); ?>" target="_blank" class="text-decoration-none small ms-2">Lihat</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <a href="<?= base_url('informasi-list') ?>" class="btn-cancel">
                    <i class="fas fa-chevron-left"></i> Kembali ke Daftar
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-check-circle me-1"></i> Simpan Informasi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
            placeholder: 'Tulis detail informasi di sini...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onInit: function() {
                    $('.note-editable').css('font-size', '0.9rem');
                }
            }
        });

        // Simple file name display
        $('#fileInput').change(function(e) {
            var fileName = e.target.files[0].name;
            $(this).next('label').text('Terpilih: ' + fileName).addClass('text-success');
        });
    });
</script>

<?= $this->endSection() ?>