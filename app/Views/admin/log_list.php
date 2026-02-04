<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 mb-2 text-gray-800">Log Aktivitas</h1>
            <p class="mb-4 text-muted">Rekam jejak aktivitas admin dalam mengelola data.</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Waktu</th>
                            <th>User</th>
                            <th>Aksi</th>
                            <th>Menu</th>
                            <th>Deskripsi</th>
                            <th>IP Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <td style="white-space: nowrap;"><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <div class="fw-bold"><?= esc($row['username']) ?></div>
                                        <small class="text-muted"><?= esc($row['role']) ?></small>
                                    </td>
                                    <td>
                                        <?php
                                            $badge = 'secondary';
                                            if($row['action'] == 'create') $badge = 'success';
                                            if($row['action'] == 'update') $badge = 'warning';
                                            if($row['action'] == 'delete') $badge = 'danger';
                                            if($row['action'] == 'import') $badge = 'info';
                                        ?>
                                        <span class="badge bg-<?= $badge ?>"><?= strtoupper($row['action']) ?></span>
                                    </td>
                                    <td><?= ucfirst($row['menu']) ?></td>
                                    <td><?= esc($row['description']) ?></td>
                                    <td><small class="font-monospace"><?= esc($row['ip_address']) ?></small></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Belum ada aktivitas.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <?= $pager->links('default', 'default_full') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
