<aside id="sidebar">
    <div class="sidebar-header">
        <a href="<?= base_url('dashboard') ?>" class="brand-link">
            <div class="brand-logo-wrap">
                <img src="<?= base_url('assets/img/logo.png'); ?>" id="sidebarLogo" alt="Logo">
            </div>
            <div class="brand-text">
                <span class="brand-name">SIPENCAK</span>
                <span class="brand-sub">LLDIKTI III</span>
            </div>
        </a>
    </div>

    <div class="nav-container">
        <?php
        $uri = uri_string();
        $role = session()->get('role');
        ?>

        <?php if ($role === 'operator') : ?>
            <div class="nav-label">Main Menu</div>
            <div class="nav-item <?= $uri === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= base_url('dashboard') ?>" class="sidebar-link" data-title="Dashboard">
                    <i class="fas fa-grid-2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div>

            <div class="nav-label">Administrasi</div>
            <div class="nav-item <?= $uri === 'userpt-list' ? 'active' : '' ?>">
                <a href="<?= base_url('userpt-list') ?>" class="sidebar-link" data-title="Manajemen User">
                    <i class="fas fa-users-gear"></i>
                    <span class="sidebar-text">Manajemen User</span>
                </a>
            </div>
            <div class="nav-item <?= $uri === 'pt-list' ? 'active' : '' ?>">
                <a href="<?= base_url('pt-list') ?>" class="sidebar-link" data-title="Manajemen PT">
                    <i class="fas fa-university"></i>
                    <span class="sidebar-text">Manajemen PT</span>
                </a>
            </div>
            <div class="nav-item <?= $uri === 'informasi-list' ? 'active' : '' ?>">
                <a href="<?= base_url('informasi-list') ?>" class="sidebar-link" data-title="Manajemen Informasi">
                    <i class="fas fa-bullhorn"></i>
                    <span class="sidebar-text">Manajemen Informasi</span>
                </a>
            </div>

            <div class="nav-label">Transaksi</div>
            <div class="nav-item <?= $uri === 'pencairan-list' ? 'active' : '' ?>">
                <a href="<?= base_url('pencairan-list') ?>" class="sidebar-link" data-title="Permohonan Cair">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span class="sidebar-text">Permohonan Cair</span>
                </a>
            </div>
            <div class="nav-item <?= $uri === 'laporan' ? 'active' : '' ?>">
                <a href="<?= base_url('laporan') ?>" class="sidebar-link" data-title="Laporan">
                    <i class="fas fa-chart-pie"></i>
                    <span class="sidebar-text">Laporan</span>
                </a>
            </div>
            
            <div class="nav-item <?= $uri === 'activity-logs' ? 'active' : '' ?>">
                <a href="<?= base_url('operator/activity-logs') ?>" class="sidebar-link" data-title="Log Aktivitas">
                    <i class="fas fa-history"></i>
                    <span class="sidebar-text">Log Aktivitas</span>
                </a>
            </div>

        <?php elseif ($role === 'admin') : ?>
            <div class="nav-label">Dashboard</div>
            <div class="nav-item <?= $uri === 'home' ? 'active' : '' ?>">
                <a href="<?= base_url('home') ?>" class="sidebar-link" data-title="Dashboard PT">
                    <i class="fas fa-chart-line"></i>
                    <span class="sidebar-text">Dashboard PT</span>
                </a>
            </div>

            <div class="nav-label">Data Akademik</div>
            <div class="nav-item <?= $uri === 'papan-informasi' ? 'active' : '' ?>">
                <a href="<?= base_url('papan-informasi') ?>" class="sidebar-link" data-title="Papan Informasi">
                    <i class="fas fa-chalkboard-user"></i>
                    <span class="sidebar-text">Papan Informasi</span>
                </a>
            </div>
            <div class="nav-item <?= $uri === 'prodi-list' ? 'active' : '' ?>">
                <a href="<?= base_url('prodi-list') ?>" class="sidebar-link" data-title="Manajemen Prodi">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="sidebar-text">Manajemen Prodi</span>
                </a>
            </div>
            <div class="nav-item <?= $uri === 'mahasiswa-list' ? 'active' : '' ?>">
                <a href="<?= base_url('mahasiswa-list') ?>" class="sidebar-link" data-title="Manajemen Mahasiswa">
                    <i class="fas fa-users-viewfinder"></i>
                    <span class="sidebar-text">Manajemen Mahasiswa</span>
                </a>
            </div>

            <div class="nav-label">Verifikasi & Cair</div>
            <div class="nav-item <?= $uri === 'verifikasi-pembaharuan-status' ? 'active' : '' ?>">
                <a href="<?= base_url('verifikasi-pembaharuan-status') ?>" class="sidebar-link" data-title="Verifikasi Status">
                    <i class="fas fa-user-check"></i>
                    <span class="sidebar-text">Verifikasi Status</span>
                </a>
            </div>
            <div class="nav-item <?= $uri === 'admin/laporan' ? 'active' : '' ?>">
                <a href="<?= base_url('admin/laporan') ?>" class="sidebar-link" data-title="Laporan Pencairan">
                    <i class="fas fa-print"></i>
                    <span class="sidebar-text">Laporan Pencairan</span>
                </a>
            </div>

            <div class="nav-item <?= $uri === 'activity-logs' ? 'active' : '' ?>">
                <a href="<?= base_url('activity-logs') ?>" class="sidebar-link" data-title="Log Aktivitas">
                    <i class="fas fa-history"></i>
                    <span class="sidebar-text">Log Aktivitas</span>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="sidebar-footer">
        <div class="user-pill">
            <div class="status-dot pulse-online"></div>
            <div class="user-info text-truncate">
                <div class="u-name"><?= session()->get('username') ?></div>
                <div class="u-role"><?= strtoupper($role ?? 'USER') ?></div>
            </div>
        </div>
    </div>
</aside>

<style>
    /* SIDEBAR CORE */
    #sidebar {
        width: var(--sidebar-width);
        background: #ffffff;
        border-right: 1px solid var(--border-color);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1050;
        display: flex;
        flex-direction: column;
        transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .sidebar-header {
        height: 80px;
        padding: 0 1.5rem;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .brand-link {
        display: flex;
        align-items: center;
        text-decoration: none !important;
        gap: 12px;
        width: 100%;
    }

    .brand-logo-wrap {
        width: 42px;
        height: 42px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-speed);
    }

    #sidebarLogo {
        max-width: 100%;
        height: auto;
        object-fit: contain;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
        transition: opacity 0.2s ease, visibility 0.2s;
        white-space: nowrap;
    }

    .brand-name {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--dark-text);
        line-height: 1.1;
    }

    .brand-sub {
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--primary-color);
        letter-spacing: 0.5px;
    }

    /* Nav Area */
    .nav-container {
        flex: 1;
        padding: 1rem 0.85rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* Scrollbar minimalis */
    .nav-container::-webkit-scrollbar {
        width: 4px;
    }

    .nav-container::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 10px;
    }

    .nav-label {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        color: #94a3b8;
        margin: 1.5rem 1rem 0.75rem;
        letter-spacing: 1.2px;
        transition: opacity 0.2s;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 0.8rem 1rem;
        color: var(--muted-text);
        text-decoration: none !important;
        border-radius: 12px;
        margin-bottom: 4px;
        position: relative;
        transition: all 0.2s ease;
        font-weight: 600;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .sidebar-link i {
        width: 24px;
        font-size: 1.15rem;
        margin-right: 12px;
        display: flex;
        justify-content: center;
        transition: margin 0.3s;
    }

    .sidebar-link:hover {
        background: #f1f5f9;
        color: var(--primary-color);
        transform: translateX(4px);
    }

    .active .sidebar-link {
        background: rgba(37, 99, 235, 0.08);
        color: var(--primary-color);
    }

    /* Footer */
    .sidebar-footer {
        padding: 1.25rem;
        border-top: 1px solid var(--border-color);
        background: #fff;
    }

    .user-pill {
        display: flex;
        align-items: center;
        background: #f8fafc;
        padding: 10px 15px;
        border-radius: 14px;
        gap: 12px;
        transition: all 0.3s;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #22c55e;
        border-radius: 50%;
    }

    .pulse-online {
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: pulse-green 2s infinite;
    }

    @keyframes pulse-green {
        0% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        }

        70% {
            transform: scale(1);
            box-shadow: 0 0 0 6px rgba(34, 197, 94, 0);
        }

        100% {
            transform: scale(0.95);
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }

    .u-name {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--dark-text);
        line-height: 1;
    }

    .u-role {
        font-size: 0.65rem;
        font-weight: 600;
        color: var(--muted-text);
        margin-top: 2px;
    }

    /* --- MINIMIZED STATE REFINEMENT --- */
    #sidebar.minimized {
        width: var(--sidebar-minimized);
    }

    #sidebar.minimized .brand-text,
    #sidebar.minimized .sidebar-text,
    #sidebar.minimized .nav-label,
    #sidebar.minimized .user-info {
        opacity: 0;
        visibility: hidden;
        width: 0;
        display: none !important;
    }

    #sidebar.minimized .sidebar-header {
        justify-content: center;
        padding: 0;
    }

    #sidebar.minimized .brand-link {
        justify-content: center;
        gap: 0;
    }

    #sidebar.minimized .brand-logo-wrap {
        width: 48px;
        height: 48px;
    }

    #sidebar.minimized .sidebar-link {
        justify-content: center;
        padding: 0.8rem;
    }

    #sidebar.minimized .sidebar-link i {
        margin-right: 0;
        font-size: 1.3rem;
    }

    #sidebar.minimized .user-pill {
        padding: 10px;
        justify-content: center;
        background: transparent;
    }

    /* Tooltip */
    @media (min-width: 992px) {
        #sidebar.minimized .sidebar-link:hover::after {
            content: attr(data-title);
            position: absolute;
            left: calc(var(--sidebar-minimized) - 10px);
            background: var(--dark-text);
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            z-index: 1060;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    }

    /* Responsive */
    @media (max-width: 992px) {
        #sidebar {
            left: calc(var(--sidebar-width) * -1);
        }

        #sidebar.active {
            left: 0;
        }
    }
</style>