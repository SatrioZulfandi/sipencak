<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    .card-modern {
        background-color: #FFFFF0;
        border-radius: 0.75rem;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .text-green {
        color: #48b29f !important;
        font-weight: 700;
    }

    .btn-green {
        background-color: #48b29f;
        color: white;
        border: none;
        padding: 0.45rem 1.25rem;
        font-size: 14px;
        border-radius: 0.5rem;
        transition: 0.3s;
    }

    .btn-green:hover {
        background-color: #3fa28c;
        color: white;
    }

    .table-detail {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .table-detail tr {
        border-bottom: 1px solid #f0f0f0;
    }

    .table-detail td {
        padding: 0.8rem 1rem;
        vertical-align: top;
        font-size: 14px;
        color: #333;
    }

    .table-detail td.label {
        width: 30%;
        font-weight: 600;
        color: #48b29f;
        background-color: #f9fdfc;
    }

    .badge-status {
        padding: 5px 12px;
        font-size: 13px;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-aktif {
        background-color: #48b29f;
        color: white;
    }

    .badge-nonaktif {
        background-color: #e74c3c;
        color: white;
    }

    @media (max-width: 576px) {
        .table-detail td.label {
            width: 40%;
        }
    }
</style>

<div class="container-fluid">
    <div class="card card-modern shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center"
            style="background-color: #f7fffc; border-radius: 0.75rem 0.75rem 0 0;">
            <h5 class="text-green mb-0">Detail User</h5>
        </div>
        <div class="card-body pt-4 pb-3">
            <div class="table-responsive">
                <table class="table-detail">
                    <tbody>
                        <tr>
                            <td class="label">Username</td>
                            <td><?= esc($data['username']) ?></td>
                        </tr>
                        <tr>
                            <td class="label">Perguruan Tinggi</td>
                            <td><?= esc($data['perguruan_tinggi']) ?></td>
                        </tr>
                        <tr>
                            <td class="label">Penanggung Jawab</td>
                            <td><?= esc($data['penanggung_jawab']) ?></td>
                        </tr>
                        <tr>
                            <td class="label">NIP</td>
                            <td><?= esc($data['nip']) ?></td>
                        </tr>
                        <tr>
                            <td class="label">Kontak</td>
                            <td><?= esc($data['kontak']) ?></td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td><?= esc($data['email']) ?></td>
                        </tr>
                        <tr>
                            <td class="label">Status</td>
                            <td>
                                <span class="badge-status <?= $data['status'] === 'aktif' ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                    <?= ucfirst($data['status']) ?>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol kembali dipindah ke luar tabel -->
            <div class="text-end mt-4">
                <a href="/userpt-list" class="btn btn-green">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>