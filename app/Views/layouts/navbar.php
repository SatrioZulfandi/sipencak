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
                <?php if (session()->get('role') === 'operator'): ?>
                <a class="dropdown-item py-2" href="javascript:void(0)" data-toggle="modal" data-target="#modalSettings">
                    <div class="icon-wrap bg-soft-info text-info">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="font-weight-medium">Pengaturan Akun</span>
                </a>
                <?php endif; ?>
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

    /* Modal Step Styles */
    .step-indicator {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-bottom: 20px;
    }
    .step-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #e2e8f0;
        transition: 0.3s;
    }
    .step-dot.active {
        background: #2563eb;
        transform: scale(1.2);
    }
    .step-content {
        display: none;
    }
    .step-content.active {
        display: block;
    }
    .otp-inputs {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    .otp-input {
        width: 48px;
        height: 56px;
        text-align: center;
        font-size: 24px;
        font-weight: 700;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: 0.3s;
    }
    .otp-input:focus {
        border-color: #2563eb;
        outline: none;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid #fff;
        border-top-color: transparent;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
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

<!-- Modal Ganti Password dengan OTP -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title font-weight-bold" id="modalPasswordLabel" style="font-size: 1.25rem; color: #1e293b;">
                        <i class="fas fa-key text-primary mr-2"></i>Ganti Password
                    </h5>
                    <p class="text-muted small mb-0" id="stepDescription">Klik tombol di bawah untuk mengirim kode OTP ke email Anda</p>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background: #f1f5f9; border: none; width: 36px; height: 36px; border-radius: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-3">
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step-dot active" id="dot1"></div>
                    <div class="step-dot" id="dot2"></div>
                    <div class="step-dot" id="dot3"></div>
                </div>

                <!-- Alert Message -->
                <div id="alertBox" class="alert d-none mb-3" style="border-radius: 12px; border: none;"></div>

                <!-- Step 1: Request OTP -->
                <div class="step-content active" id="step1">
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-envelope-open-text" style="font-size: 48px; color: #2563eb;"></i>
                        </div>
                        <p class="text-muted mb-4">Kami akan mengirimkan kode OTP ke email yang terdaftar di akun Anda.</p>
                        
                        <!-- Email form for operators without email -->
                        <div id="emailFormContainer" class="d-none mb-4">
                            <div class="form-group text-left">
                                <label class="font-weight-bold small text-dark">Masukkan Email Anda</label>
                                <input type="email" class="form-control" id="operatorEmail" placeholder="email@example.com" style="border-radius: 10px; padding: 12px 15px; border: 2px solid #e2e8f0;">
                            </div>
                            <button type="button" class="btn btn-success btn-lg px-5 mb-2" id="btnSaveEmail" style="border-radius: 12px; font-weight: 600;">
                                <i class="fas fa-save mr-2"></i> Simpan Email
                            </button>
                            <p class="text-muted small">Setelah menyimpan email, Anda dapat menerima kode OTP</p>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-lg px-5" id="btnSendOtp" style="border-radius: 12px; font-weight: 600; background: #2563eb; border: none;">
                            <i class="fas fa-paper-plane mr-2"></i> Kirim Kode OTP
                        </button>
                    </div>
                </div>

                <!-- Step 2: Verify OTP -->
                <div class="step-content" id="step2">
                    <div class="text-center py-3">
                        <p class="text-muted mb-3">Masukkan 6 digit kode OTP yang dikirim ke email <strong id="emailDisplay"></strong></p>
                        <div class="otp-inputs mb-4">
                            <input type="text" class="otp-input" maxlength="1" data-index="0">
                            <input type="text" class="otp-input" maxlength="1" data-index="1">
                            <input type="text" class="otp-input" maxlength="1" data-index="2">
                            <input type="text" class="otp-input" maxlength="1" data-index="3">
                            <input type="text" class="otp-input" maxlength="1" data-index="4">
                            <input type="text" class="otp-input" maxlength="1" data-index="5">
                        </div>
                        <button type="button" class="btn btn-primary btn-lg px-5" id="btnVerifyOtp" style="border-radius: 12px; font-weight: 600; background: #2563eb; border: none;">
                            <i class="fas fa-check-circle mr-2"></i> Verifikasi
                        </button>
                        <div class="mt-3">
                            <button type="button" class="btn btn-link text-muted" id="btnResendOtp">Kirim ulang kode</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: New Password -->
                <div class="step-content" id="step3">
                    <div class="py-3">
                        <div class="form-group">
                            <label class="font-weight-bold small text-dark">Password Baru</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: #f1f5f9; border: none; border-radius: 10px 0 0 10px;">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input type="password" id="newPassword" class="form-control" placeholder="Minimal 8 karakter" required minlength="8"
                                    style="border: none; background: #f1f5f9; padding: 12px 15px;">
                                <div class="input-group-append">
                                    <button type="button" class="btn toggle-pass" data-target="newPassword" style="background: #f1f5f9; border: none; border-radius: 0 10px 10px 0;">
                                        <i class="fas fa-eye-slash text-muted"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label class="font-weight-bold small text-dark">Konfirmasi Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background: #f1f5f9; border: none; border-radius: 10px 0 0 10px;">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                </div>
                                <input type="password" id="confirmPassword" class="form-control" placeholder="Ulangi password baru" required minlength="8"
                                    style="border: none; background: #f1f5f9; padding: 12px 15px;">
                                <div class="input-group-append">
                                    <button type="button" class="btn toggle-pass" data-target="confirmPassword" style="background: #f1f5f9; border: none; border-radius: 0 10px 10px 0;">
                                        <i class="fas fa-eye-slash text-muted"></i>
                                    </button>
                                </div>
                            </div>
                            <small id="passwordMatchError" class="text-danger d-none mt-1">Password tidak cocok</small>
                        </div>
                        <button type="button" class="btn btn-primary btn-lg btn-block" id="btnSavePassword" style="border-radius: 12px; font-weight: 600; background: #2563eb; border: none;">
                            <i class="fas fa-save mr-2"></i> Simpan Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pengaturan Akun (Operator Only) -->
<?php if (session()->get('role') === 'operator'): ?>
<?php 
    $userModel = new \App\Models\UserModel();
    $currentUser = $userModel->find(session()->get('id'));
    $initials = strtoupper(substr($currentUser['nama'] ?? 'O', 0, 1));
?>
<div class="modal fade" id="modalSettings" tabindex="-1" role="dialog" aria-labelledby="modalSettingsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden;">
            <!-- Profile Header -->
            <div class="profile-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem; text-align: center; position: relative;">
                <div class="profile-avatar mx-auto mb-3" style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid rgba(255,255,255,0.5);">
                    <span style="font-size: 2.5rem; font-weight: 700; color: #fff;"><?= $initials ?></span>
                </div>
                <h4 class="text-white font-weight-bold mb-1"><?= $currentUser['nama'] ?? session()->get('username') ?></h4>
                <span class="badge badge-light px-3 py-2" style="border-radius: 20px; font-size: 0.8rem;">
                    <i class="fas fa-user-shield mr-1"></i> Operator
                </span>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 15px; right: 20px; opacity: 0.8; font-size: 1.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body p-4">
                <!-- Alert Message -->
                <div id="settingsAlertBox" class="alert d-none mb-4" style="border-radius: 12px; border: none;"></div>
                
                <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                    <i class="fas fa-user-edit mr-2"></i>Informasi Profil
                </h6>
                
                <div class="row">
                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold small text-dark">
                                <i class="fas fa-id-card text-primary mr-1"></i> Nama Lengkap
                            </label>
                            <input type="text" class="form-control" id="settingsNama" 
                                   value="<?= $currentUser['nama'] ?? '' ?>"
                                   placeholder="Masukkan nama lengkap"
                                   style="border-radius: 10px; padding: 12px 15px; border: 2px solid #e2e8f0; transition: border-color 0.3s;">
                        </div>
                    </div>
                    
                    <!-- Username (readonly) -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold small text-dark">
                                <i class="fas fa-at text-secondary mr-1"></i> Username
                            </label>
                            <input type="text" class="form-control bg-light" id="settingsUsername" 
                                   value="<?= $currentUser['username'] ?? '' ?>"
                                   readonly
                                   style="border-radius: 10px; padding: 12px 15px; border: 2px solid #e2e8f0; cursor: not-allowed;">
                            <small class="text-muted"><i class="fas fa-lock mr-1"></i>Username tidak dapat diubah</small>
                        </div>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                    <i class="fas fa-envelope mr-2"></i>Pengaturan Email
                </h6>
                
                <!-- Email -->
                <div class="form-group">
                    <label class="font-weight-bold small text-dark">
                        <i class="fas fa-envelope text-info mr-1"></i> Alamat Email
                    </label>
                    <input type="email" class="form-control" id="settingsEmail" 
                           value="<?= $currentUser['email'] ?? '' ?>"
                           placeholder="contoh@email.com"
                           style="border-radius: 10px; padding: 12px 15px; border: 2px solid #e2e8f0; transition: border-color 0.3s;">
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i>Email digunakan untuk menerima kode OTP saat ganti password
                    </small>
                </div>
                
                <hr class="my-3">
                
                <h6 class="text-uppercase text-muted small font-weight-bold mb-3">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Akun
                </h6>
                
                <div class="row">
                    <div class="col-6">
                        <div class="info-card p-3" style="background: #f8fafc; border-radius: 12px;">
                            <small class="text-muted d-block mb-1">User ID</small>
                            <span class="font-weight-bold text-dark">#<?= session()->get('id') ?></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="info-card p-3" style="background: #f8fafc; border-radius: 12px;">
                            <small class="text-muted d-block mb-1">Status</small>
                            <span class="badge badge-success px-2 py-1">
                                <i class="fas fa-check-circle mr-1"></i>Aktif
                            </span>
                        </div>
                    </div>
                </div>
                
                <button type="button" class="btn btn-lg btn-block mt-4" id="btnSaveSettings" style="border-radius: 12px; font-weight: 600; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: #fff; padding: 14px;">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<style>
#modalSettings .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
}
#modalSettings .profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}
#btnSaveSettings:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}
</style>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = '<?= csrf_hash() ?>';
    const csrfName = '<?= csrf_token() ?>';
    const userRole = '<?= session()->get('role') ?>';
    
    // URL berdasarkan role
    const otpUrls = {
        send: userRole === 'operator' ? '<?= base_url('operator/send-change-otp') ?>' : '<?= base_url('send-change-otp') ?>',
        verify: userRole === 'operator' ? '<?= base_url('operator/verify-change-otp') ?>' : '<?= base_url('verify-change-otp') ?>',
        update: userRole === 'operator' ? '<?= base_url('operator/update-password-otp') ?>' : '<?= base_url('update-password-otp') ?>',
        updateEmail: '<?= base_url('operator/update-email') ?>'
    };
    
    let currentStep = 1;
    
    // Show alert
    function showAlert(message, type = 'danger') {
        const alertBox = document.getElementById('alertBox');
        alertBox.className = `alert alert-${type} mb-3`;
        alertBox.style.cssText = 'border-radius: 12px; border: none;';
        alertBox.innerHTML = message;
        alertBox.classList.remove('d-none');
    }
    
    function hideAlert() {
        document.getElementById('alertBox').classList.add('d-none');
    }
    
    // Go to step
    function goToStep(step) {
        currentStep = step;
        document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.step-dot').forEach(el => el.classList.remove('active'));
        
        document.getElementById(`step${step}`).classList.add('active');
        for (let i = 1; i <= step; i++) {
            document.getElementById(`dot${i}`).classList.add('active');
        }
        
        const descriptions = {
            1: 'Klik tombol di bawah untuk mengirim kode OTP ke email Anda',
            2: 'Masukkan kode OTP yang dikirim ke email Anda',
            3: 'Buat password baru untuk akun Anda'
        };
        document.getElementById('stepDescription').textContent = descriptions[step];
        hideAlert();
    }
    
    // Step 1: Send OTP
    document.getElementById('btnSendOtp').addEventListener('click', async function() {
        const btn = this;
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner mr-2"></span> Mengirim...';
        
        try {
            const formData = new FormData();
            formData.append(csrfName, csrfToken);
            
            const response = await fetch(otpUrls.send, {
                method: 'POST',
                body: formData
            });
            
            // Check if response is ok
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Server error:', response.status, errorText);
                showAlert('Error ' + response.status + ': Silakan refresh halaman dan coba lagi.');
                return;
            }
            
            const data = await response.json();
            
            if (data.success) {
                document.getElementById('emailDisplay').textContent = data.email;
                document.getElementById('emailFormContainer').classList.add('d-none');
                goToStep(2);
                document.querySelector('.otp-input').focus();
            } else {
                showAlert(data.message);
                // Show email form if need_email is true
                if (data.need_email && userRole === 'operator') {
                    document.getElementById('emailFormContainer').classList.remove('d-none');
                }
            }
        } catch (error) {
            console.error('Fetch error:', error);
            showAlert('Terjadi kesalahan: ' + error.message);
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Kirim Kode OTP';
        }
    });
    
    // Save Email button handler (for operators)
    document.getElementById('btnSaveEmail').addEventListener('click', async function() {
        const btn = this;
        const email = document.getElementById('operatorEmail').value;
        
        if (!email) {
            showAlert('Silakan masukkan email');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner mr-2"></span> Menyimpan...';
        
        try {
            const formData = new FormData();
            formData.append(csrfName, csrfToken);
            formData.append('email', email);
            
            const response = await fetch(otpUrls.updateEmail, {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            if (data.success) {
                showAlert('<i class="fas fa-check-circle mr-2"></i> ' + data.message, 'success');
                document.getElementById('emailFormContainer').classList.add('d-none');
                // Otomatis kirim OTP setelah email tersimpan
                setTimeout(() => {
                    document.getElementById('btnSendOtp').click();
                }, 1500);
            } else {
                showAlert(data.message);
            }
        } catch (error) {
            showAlert('Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Email';
        }
    });
    
    // OTP inputs handling
    const otpInputs = document.querySelectorAll('.otp-input');
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });
        
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
        
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
            pastedData.split('').forEach((char, i) => {
                if (otpInputs[i]) otpInputs[i].value = char;
            });
            if (pastedData.length === 6) otpInputs[5].focus();
        });
    });
    
    // Step 2: Verify OTP
    document.getElementById('btnVerifyOtp').addEventListener('click', async function() {
        const btn = this;
        let otp = '';
        otpInputs.forEach(input => otp += input.value);
        
        if (otp.length !== 6) {
            showAlert('Masukkan 6 digit kode OTP');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner mr-2"></span> Memverifikasi...';
        
        try {
            const formData = new FormData();
            formData.append(csrfName, csrfToken);
            formData.append('otp', otp);
            
            const response = await fetch(otpUrls.verify, {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            if (data.success) {
                goToStep(3);
                document.getElementById('newPassword').focus();
            } else {
                showAlert(data.message);
            }
        } catch (error) {
            showAlert('Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-check-circle mr-2"></i> Verifikasi';
        }
    });
    
    // Resend OTP
    document.getElementById('btnResendOtp').addEventListener('click', function() {
        goToStep(1);
        document.getElementById('btnSendOtp').click();
    });
    
    // Toggle password visibility
    document.querySelectorAll('.toggle-pass').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });
    });
    
    // Password match validation
    document.getElementById('confirmPassword').addEventListener('input', function() {
        const password = document.getElementById('newPassword').value;
        const confirm = this.value;
        const error = document.getElementById('passwordMatchError');
        
        if (confirm && password !== confirm) {
            error.classList.remove('d-none');
        } else {
            error.classList.add('d-none');
        }
    });
    
    // Step 3: Save Password
    document.getElementById('btnSavePassword').addEventListener('click', async function() {
        const btn = this;
        const password = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        
        if (password.length < 8) {
            showAlert('Password minimal 8 karakter');
            return;
        }
        
        if (password !== confirmPassword) {
            showAlert('Konfirmasi password tidak cocok');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = '<span class="loading-spinner mr-2"></span> Menyimpan...';
        
        try {
            const formData = new FormData();
            formData.append(csrfName, csrfToken);
            formData.append('password', password);
            formData.append('confirm_password', confirmPassword);
            
            const response = await fetch(otpUrls.update, {
                method: 'POST',
                body: formData
            });
            const data = await response.json();
            
            if (data.success) {
                showAlert('<i class="fas fa-check-circle mr-2"></i> ' + data.message, 'success');
                setTimeout(() => {
                    $('#modalPassword').modal('hide');
                    // Reset modal
                    goToStep(1);
                    document.getElementById('newPassword').value = '';
                    document.getElementById('confirmPassword').value = '';
                    otpInputs.forEach(input => input.value = '');
                }, 2000);
            } else {
                showAlert(data.message);
            }
        } catch (error) {
            showAlert('Terjadi kesalahan. Silakan coba lagi.');
        } finally {
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Password';
        }
    });
    
    // Reset modal on close
    $('#modalPassword').on('hidden.bs.modal', function() {
        goToStep(1);
        document.getElementById('newPassword').value = '';
        document.getElementById('confirmPassword').value = '';
        otpInputs.forEach(input => input.value = '');
        hideAlert();
    });
    
    // Settings Modal Handler (for operators only)
    const btnSaveSettings = document.getElementById('btnSaveSettings');
    if (btnSaveSettings) {
        btnSaveSettings.addEventListener('click', async function() {
            const btn = this;
            const nama = document.getElementById('settingsNama').value;
            const email = document.getElementById('settingsEmail').value;
            const alertBox = document.getElementById('settingsAlertBox');
            
            function showSettingsAlert(message, type = 'danger') {
                alertBox.className = `alert alert-${type} mb-4`;
                alertBox.innerHTML = message;
                alertBox.classList.remove('d-none');
            }
            
            if (!nama.trim()) {
                showSettingsAlert('<i class="fas fa-exclamation-circle mr-2"></i>Silakan masukkan nama lengkap');
                return;
            }
            
            if (!email.trim()) {
                showSettingsAlert('<i class="fas fa-exclamation-circle mr-2"></i>Silakan masukkan email');
                return;
            }
            
            btn.disabled = true;
            btn.innerHTML = '<span class="loading-spinner mr-2"></span> Menyimpan...';
            
            try {
                const formData = new FormData();
                formData.append(csrfName, csrfToken);
                formData.append('nama', nama);
                formData.append('email', email);
                
                const response = await fetch('<?= base_url('operator/update-profile') ?>', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (data.success) {
                    showSettingsAlert('<i class="fas fa-check-circle mr-2"></i> ' + data.message, 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showSettingsAlert(data.message);
                }
            } catch (error) {
                showSettingsAlert('Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Pengaturan';
            }
        });
    }
});
</script>