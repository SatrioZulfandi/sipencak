<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>Verifikasi OTP - Sipencak LLDIKTI</title>

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

        .info-card-glass {
            position: absolute;
            bottom: 60px;
            left: 60px;
            z-index: 10;
            max-width: 480px;
            padding: 35px;
            background: rgba(1, 90, 201, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(1, 90, 201, 0.4);
            animation: slideUp 1s ease-out;
        }

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
            font-size: 2rem;
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

        .otp-input-container {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .otp-input {
            width: 50px;
            height: 60px;
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 12px;
            transition: 0.3s;
        }

        .otp-input:focus {
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
            cursor: pointer;
        }

        .btn-elite:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            transition: 0.3s;
        }

        .back-link:hover {
            color: var(--primary);
            text-decoration: none;
        }

        .alert-info-custom {
            border-radius: 12px;
            padding: 14px 18px;
            border: none;
            background: #eff6ff;
            color: #1e40af;
            font-weight: 600;
        }

        .alert-danger-custom {
            border-radius: 12px;
            padding: 14px 18px;
            border: none;
            background: #fef2f2;
            color: #991b1b;
            font-weight: 600;
        }

        .timer-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fef3c7;
            color: #92400e;
            padding: 8px 16px;
            border-radius: 100px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 20px;
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
                <h2 class="font-weight-bold mb-3" style="font-size: 2rem; letter-spacing: -1.5px; color: #ffffff; line-height: 1.1;">
                    <i class="fas fa-key mr-2"></i> Verifikasi OTP
                </h2>
                <p class="mb-0" style="font-size: 1rem; line-height: 1.7; color: rgba(255, 255, 255, 0.9); font-weight: 500;">
                    Masukkan 6 digit kode OTP yang telah dikirim ke email Anda. Periksa folder spam jika tidak ditemukan.
                </p>
            </div>
        </div>

        <div class="form-pane">
            <div class="login-box">
                <a href="<?= base_url('forgot') ?>" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <div class="header-section text-center text-lg-left">
                    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Sipencak Logo">
                    <h1>Verifikasi OTP</h1>
                    <p class="text-muted">Masukkan 6 digit kode yang telah dikirim ke email:</p>
                    <p class="font-weight-bold text-dark"><?= esc($email ?? '') ?></p>
                </div>

                <div class="text-center">
                    <div class="timer-badge">
                        <i class="fas fa-clock"></i>
                        <span>Kode berlaku 10 menit</span>
                    </div>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger-custom mb-4">
                        <i class="fas fa-circle-exclamation mr-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('info')) : ?>
                    <div class="alert alert-info-custom mb-4">
                        <i class="fas fa-info-circle mr-2"></i> <?= session()->getFlashdata('info') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('check-code') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="email" value="<?= esc($email ?? '') ?>">

                    <div class="form-group-modern">
                        <label class="text-center d-block">Kode OTP</label>
                        <div class="otp-input-container">
                            <input type="text" class="otp-input" maxlength="1" data-index="0" inputmode="numeric" pattern="[0-9]" required>
                            <input type="text" class="otp-input" maxlength="1" data-index="1" inputmode="numeric" pattern="[0-9]" required>
                            <input type="text" class="otp-input" maxlength="1" data-index="2" inputmode="numeric" pattern="[0-9]" required>
                            <input type="text" class="otp-input" maxlength="1" data-index="3" inputmode="numeric" pattern="[0-9]" required>
                            <input type="text" class="otp-input" maxlength="1" data-index="4" inputmode="numeric" pattern="[0-9]" required>
                            <input type="text" class="otp-input" maxlength="1" data-index="5" inputmode="numeric" pattern="[0-9]" required>
                        </div>
                        <input type="hidden" name="code" id="otp-code">
                    </div>

                    <button type="submit" class="btn-elite">
                        <i class="fas fa-check-circle"></i> Verifikasi Kode
                    </button>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted small">Tidak menerima kode? <a href="<?= base_url('forgot') ?>" class="font-weight-bold" style="color: var(--primary);">Kirim ulang</a></p>
                </div>

                <footer class="text-center text-lg-left">
                    <p class="small text-muted mb-1">Versi Sistem 4.2.0-Elite Build</p>
                    <p class="small text-muted mb-0">&copy; <?= date('Y') ?> Lembaga Layanan Pendidikan Tinggi Wilayah III</p>
                </footer>
            </div>
        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll('.otp-input');
        const hiddenInput = document.getElementById('otp-code');

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                const value = e.target.value;
                
                // Only allow numbers
                if (!/^\d*$/.test(value)) {
                    e.target.value = '';
                    return;
                }

                // Move to next input
                if (value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }

                // Update hidden input
                updateHiddenInput();
            });

            input.addEventListener('keydown', (e) => {
                // Handle backspace
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').slice(0, 6);
                
                if (/^\d+$/.test(pastedData)) {
                    pastedData.split('').forEach((char, i) => {
                        if (inputs[i]) {
                            inputs[i].value = char;
                        }
                    });
                    updateHiddenInput();
                    if (pastedData.length === 6) {
                        inputs[5].focus();
                    }
                }
            });
        });

        function updateHiddenInput() {
            let code = '';
            inputs.forEach(input => {
                code += input.value;
            });
            hiddenInput.value = code;
        }

        // Focus first input on load
        inputs[0].focus();
    </script>

</body>

</html>
