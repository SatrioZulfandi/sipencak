<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>Sipencak - Elite Login 2026</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
            --bg-body: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            height: 100vh;
            overflow: hidden;
        }

        .split-container {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        /* --- Panel Visual (Kiri) --- */
        .visual-pane {
            flex: 1.2;
            position: relative;
            background: #ffffff;
            overflow: hidden;
            display: none;
        }

        @media (min-width: 992px) {
            .visual-pane {
                display: block;
            }
        }

        .bg-image {
            position: absolute;
            inset: 0;
            filter: blur(2px);
            background-image: linear-gradient(rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0.4)),
                url('<?= base_url('assets/img/bg.jpg') ?>');
            background-size: cover;
            background-position: center;
            transform: scale(1.05);
            transition: transform 10s ease;
        }

        .visual-pane:hover .bg-image {
            transform: scale(1.15);
        }

        .visual-pane::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 150px;
            background: linear-gradient(to right, transparent, #ffffff);
            z-index: 5;
        }

        .branding-top {
            position: absolute;
            top: 50px;
            left: 60px;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 12px 18px;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        /* --- INFO BOX BIRU (Sisi Kiri) --- */
        .info-card-glass {
            position: absolute;
            bottom: 60px;
            left: 60px;
            z-index: 10;
            max-width: 480px;
            padding: 35px;
            /* Menggunakan warna #015ac9 dengan transparansi 0.9 */
            background: rgba(1, 90, 201, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Shadow disesuaikan dengan rona warna #015ac9 */
            box-shadow: 0 25px 50px -12px rgba(1, 90, 201, 0.4);
            animation: slideUp 1s ease-out;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            /* Badge semi-transparan putih di atas biru */
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 14px;
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #4ade80;
            /* Hijau terang agar kontras dengan biru */
            border-radius: 50%;
            box-shadow: 0 0 12px rgba(74, 222, 128, 0.8);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.4);
                opacity: 0.6;
            }
        }

        /* --- Panel Form (Kanan) --- */
        .form-pane {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            z-index: 10;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-section {
            margin-bottom: 40px;
        }

        .header-section img {
            height: 48px;
            margin-bottom: 24px;
        }

        .header-section h1 {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.04em;
        }

        .form-group-modern {
            margin-bottom: 24px;
        }

        .form-group-modern label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field-icon {
            position: absolute;
            left: 18px;
            color: var(--text-muted);
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 18px 14px 50px;
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .input-wrapper input:focus {
            outline: none;
            background: white;
            border-color: var(--primary);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1);
        }

        .btn-elite {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: 0.3s;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.3);
        }

        .btn-elite:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        footer {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid #f1f5f9;
        }
    </style>
</head>

<body>

    <div class="split-container">
        <div class="visual-pane">
            <div class="bg-image"></div>

            <div class="branding-top">
                <img src="<?= base_url('assets/img/lldikti3.png') ?>" style="height: 50px;">
                <div style="width: 1px; height: 30px; background: rgba(0,0,0,0.1);"></div>
                <img src="<?= base_url('assets/img/el.png') ?>" style="height: 40px;">
            </div>

            <div class="info-card-glass">
                <div class="status-badge">
                    <div class="pulse-dot"></div>
                    <span class="small font-weight-bold" style="letter-spacing: 2px; text-transform: uppercase; color: #ffffff; font-size: 0.7rem;">System Operational</span>
                </div>
                <h2 class="font-weight-bold mb-3" style="font-size: 2.2rem; letter-spacing: -1.5px; color: #ffffff; line-height: 1.1;">LLDIKTI Wilayah III</h2>
                <p class="mb-0" style="font-size: 1.05rem; line-height: 1.7; color: rgba(255, 255, 255, 0.9); font-weight: 500;">Transformasi layanan pendidikan tinggi digital terintegrasi untuk masa depan Indonesia yang lebih cerdas.</p>
            </div>
        </div>

        <div class="form-pane">
            <div class="login-box">
                <div class="header-section text-center text-lg-left">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Sipencak Logo">
                    <h1>Portal Akses</h1>
                    <p class="text-muted">Selamat datang. Silakan masukkan kredensial Anda untuk mengelola sistem.</p>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger mb-4" style="border-radius: 12px; padding: 14px 18px; border:none; background: #fef2f2; color: #991b1b; font-weight:600;">
                        <i class="fas fa-circle-exclamation mr-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= url_to('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group-modern">
                        <label>Username</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user field-icon"></i>
                            <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <div class="d-flex justify-content-between">
                            <label>Password</label>
                            <a href="#" class="small font-weight-bold" style="color: var(--primary); text-decoration: none;">Lupa Password?</a>
                        </div>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock field-icon"></i>
                            <input type="password" name="password" id="password" placeholder="••••••••" required>
                            <span class="toggle-btn" id="eye" style="position:absolute; right:18px; cursor:pointer; color:var(--text-muted);">
                                <i class="fa-regular fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn-elite">
                        Masuk ke Dashboard <i class="fa-solid fa-arrow-right-long ml-2"></i>
                    </button>
                </form>

                <footer class="text-center text-lg-left">
                    <p class="small text-muted mb-1">Versi Sistem 4.2.0-Elite Build</p>
                    <p class="small text-muted mb-0">&copy; 2026 Lembaga Layanan Pendidikan Tinggi Wilayah III</p>
                </footer>
            </div>
        </div>
    </div>

    <script>
        const eye = document.querySelector('#eye');
        const pass = document.querySelector('#password');
        eye.addEventListener('click', () => {
            const icon = eye.querySelector('i');
            if (pass.type === 'password') {
                pass.type = 'text';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                pass.type = 'password';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });
    </script>
</body>

</html>