<header class="topbar">
    <div class="topbar-left">
        <button id="sidebarToggle" class="btn-toggle-ui" title="Toggle Sidebar">
            <i class="fas fa-bars-staggered"></i>
        </button>
        <div class="breadcrumb-info d-none d-sm-block">
            <h5 class="mb-0 page-title"><?= $title ?? 'Dashboard' ?></h5>
            <span class="small text-muted">Selamat Datang, <?= session()->get('username') ?></span>
        </div>
    </div>

    <div class="topbar-right">
        <div class="dropdown">
            <button class="icon-circle-btn" id="notifMenu" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="pulse-badge"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right notif-dropdown" aria-labelledby="notifMenu">
                <div class="dropdown-header">Pemberitahuan</div>
                <div class="dropdown-body">
                    <a class="dropdown-item py-3" href="#">
                        <div class="icon-wrap bg-soft-primary text-primary">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="text-truncate">
                            <div class="small text-muted" style="font-size: 0.7rem;">Baru Saja</div>
                            <span class="font-weight-bold d-block text-truncate" style="font-size: 0.8rem;">Sistem Berhasil Diperbarui v2.0.4</span>
                        </div>
                    </a>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center small text-muted justify-content-center" href="#">Lihat Semua Notifikasi</a>
            </div>
        </div>

        <div class="topbar-divider"></div>

        <div class="dropdown">
            <div class="user-profile-wrapper dropdown-toggle" id="userMenu" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                <div class="user-meta d-none d-md-block text-right">
                    <span class="user-name"><?= session()->get('username') ?></span>
                    <span class="user-role"><?= strtoupper(session()->get('role') ?? 'ADMIN') ?></span>
                </div>
                <div class="avatar-box">
                    <img src="<?= base_url('assets/img/undraw_profile.svg'); ?>" alt="Avatar">
                </div>
            </div>

            <div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="userMenu">
                <div class="dropdown-header d-md-none text-primary border-bottom mb-2 pb-2">
                    <?= session()->get('username') ?>
                </div>
                <a class="dropdown-item py-2" href="javascript:void(0)" data-toggle="modal" data-target="#modalPassword">
                    <div class="icon-wrap bg-soft-primary text-primary">
                        <i class="fas fa-key"></i>
                    </div>
                    <span class="font-weight-medium">Ganti Password</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item py-2 text-danger font-weight-bold" href="<?= base_url('logout') ?>">
                    <div class="icon-wrap bg-soft-danger text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <span>Keluar Aplikasi</span>
                </a>
            </div>
        </div>
    </div>
</header>

<style>
    /* --- NAVBAR CORE --- */
    .topbar {
        height: 70px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.5rem;
        position: sticky;
        top: 0;
        width: 100%;
        z-index: 1000;
        transition: all var(--transition-speed) ease;
    }

    .topbar-left,
    .topbar-right {
        display: flex;
        align-items: center;
    }

    .btn-toggle-ui {
        background: #f1f5f9;
        border: none;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        color: var(--dark-text);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.3s;
    }

    .btn-toggle-ui:hover {
        background: var(--border-color);
        color: var(--primary-color);
        transform: scale(1.05);
    }

    .page-title {
        font-weight: 800;
        color: var(--dark-text);
        font-size: 1.1rem;
        letter-spacing: -0.5px;
    }

    .breadcrumb-info {
        margin-left: 1.25rem;
    }

    .icon-circle-btn {
        background: transparent;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: var(--muted-text);
        position: relative;
        cursor: pointer;
        transition: 0.3s;
    }

    .icon-circle-btn:hover {
        background: #f1f5f9;
        color: var(--primary-color);
    }

    .pulse-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        width: 8px;
        height: 8px;
        background: #ef4444;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .topbar-divider {
        width: 1px;
        height: 28px;
        background: var(--border-color);
        margin: 0 1.25rem;
    }

    /* --- PROFILE STYLE --- */
    .user-profile-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        padding: 6px 12px;
        border-radius: 50px;
        transition: 0.3s;
    }

    .user-profile-wrapper:hover {
        background: #f8fafc;
    }

    .user-name {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--dark-text);
        line-height: 1.2;
    }

    .user-role {
        display: block;
        font-size: 0.65rem;
        font-weight: 800;
        color: var(--primary-color);
    }

    .avatar-box {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--border-color);
        overflow: hidden;
    }

    .avatar-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* --- ADVANCED DROPDOWN LOCK (THE FIX) --- */
    .topbar .dropdown {
        position: relative !important;
    }

    .topbar .dropdown-menu {
        position: absolute !important;
        top: 100% !important;
        right: 0 !important;
        left: auto !important;
        margin-top: 12px !important;

        /* Disable default display toggle to allow animations */
        display: block !important;
        visibility: hidden;
        opacity: 0;
        pointer-events: none;

        background: #fff;
        border: none;
        border-radius: 16px;
        padding: 0.75rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;

        transform: translateY(15px) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 1100;
    }

    /* Class when active */
    .topbar .dropdown.show .dropdown-menu {
        visibility: visible;
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0) !important;
    }

    /* Caret (Arrow) */
    .topbar .dropdown-menu::before {
        content: '';
        position: absolute;
        top: -6px;
        right: 18px;
        width: 12px;
        height: 12px;
        background: #fff;
        transform: rotate(45deg);
        border-top: 1px solid var(--border-color);
        border-left: 1px solid var(--border-color);
        z-index: -1;
    }

    .notif-dropdown {
        width: 320px;
    }

    .profile-dropdown {
        width: 240px;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 14px;
        border-radius: 12px;
        gap: 12px;
        transition: 0.2s;
        font-size: 0.9rem;
        color: var(--dark-text);
        font-weight: 600;
    }

    .dropdown-item:hover {
        background: #f1f5f9;
        color: var(--primary-color);
        transform: translateX(4px);
    }

    .icon-wrap {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .bg-soft-primary {
        background: rgba(37, 99, 235, 0.1);
    }

    .bg-soft-danger {
        background: rgba(239, 68, 68, 0.1);
    }

    .dropdown-toggle::after {
        display: none;
    }

    @media (max-width: 576px) {
        .notif-dropdown {
            width: calc(100vw - 2rem);
            position: fixed !important;
            left: 1rem !important;
            right: 1rem !important;
            top: 75px !important;
        }

        .topbar .dropdown-menu::before {
            right: 60px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manual Toggle for Bootstrap 4 Static Dropdowns
        const dropdownToggles = document.querySelectorAll('.topbar [data-toggle="dropdown"]');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const parent = this.closest('.dropdown');
                const isOpened = parent.classList.contains('show');

                // Close all other dropdowns
                document.querySelectorAll('.topbar .dropdown').forEach(d => d.classList.remove('show'));

                // Open this one if it wasn't already open
                if (!isOpened) {
                    parent.classList.add('show');
                }
            });
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.topbar .dropdown').forEach(d => d.classList.remove('show'));
            }
        });
    });
</script>