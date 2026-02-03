<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <title><?= $title ?? 'SIPENCAK' ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --dark-text: #1e293b;
            --muted-text: #64748b;
            --border-color: #e2e8f0;
            --card-bg: #ffffff;
            --sidebar-width: 280px;
            --sidebar-minimized: 88px;
            --transition-speed: 0.4s;
        }

        /* Styling Pager Global */
        .pagination {
            gap: 5px;
        }

        .pagination .page-link {
            color: #64748b;
            /* var(--slate) */
            border: 1px solid #e2e8f0;
            /* var(--border) */
            border-radius: 8px !important;
            font-size: 0.75rem;
            /* Compact typography */
            font-weight: 600;
            padding: 0.5rem 0.8rem;
            transition: all 0.2s;
            box-shadow: none;
        }

        .pagination .page-item.active .page-link {
            background-color: #2563eb !important;
            /* var(--primary) */
            border-color: #2563eb !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2) !important;
        }

        .pagination .page-link:hover:not(.active) {
            background-color: #f8fafc;
            border-color: #2563eb;
            color: #2563eb;
        }


        body {
            color: var(--text-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Ganti URL dengan path gambar Anda */
            background-image: linear-gradient(rgba(248, 250, 252, 0.81), rgba(248, 250, 252, 0.81)),
                url('<?= base_url('assets/img/bg.jpg') ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* Gambar tetap diam saat scroll */
            margin: 0;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* --- MAIN WRAPPER SYSTEM --- */
        #main-wrapper {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            min-width: 0;
        }

        #wrapper.toggled #main-wrapper {
            margin-left: var(--sidebar-minimized);
        }

        .page-content-wrapper {
            padding: 1.5rem;
            flex: 1;
            padding-bottom: 80px;
        }

        /* --- FIXED FOOTER --- */
        .fixed-footer {
            position: fixed;
            bottom: 0;
            right: 0;
            width: calc(100% - var(--sidebar-width));
            height: 60px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-top: 1px solid var(--border-color);
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        #wrapper.toggled .fixed-footer {
            width: calc(100% - var(--sidebar-minimized));
        }

        /* --- ADVANCED DROPDOWN REPAIR --- */
        /* Mematikan paksa kalkulasi otomatis Bootstrap/Popper yang sering meleset */
        .topbar .dropdown {
            position: relative !important;
        }

        .topbar .dropdown-menu {
            border: none;
            border-radius: 16px;
            padding: 0.75rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;

            /* Positioning Lock */
            top: 100% !important;
            right: 0 !important;
            left: auto !important;
            margin-top: 12px !important;
            transform: translateY(10px) !important;
            /* Start position for animation */

            display: block;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .topbar .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) !important;
            pointer-events: auto;
        }

        /* Panah Indikator (Caret) */
        .topbar .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 20px;
            width: 12px;
            height: 12px;
            background: #fff;
            transform: rotate(45deg);
            border-top: 1px solid var(--border-color);
            border-left: 1px solid var(--border-color);
            z-index: -1;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1rem;
            border-radius: 12px;
            color: var(--dark-text);
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
            transform: translateX(4px);
        }

        /* --- UI COMPONENTS --- */
        table.dataTable {
            font-size: 0.8rem !important;
        }

        .card-filter {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 12px;
        }

        .card-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .system-badge {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 50px;
            gap: 8px;
        }

        .status-indicator {
            width: 6px;
            height: 6px;
            background: #22c55e;
            border-radius: 50%;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.15);
        }

        @media (max-width: 992px) {
            #main-wrapper {
                margin-left: 0 !important;
            }

            .fixed-footer {
                width: 100% !important;
            }

            #wrapper.toggled #main-wrapper {
                margin-left: 0;
            }

            .topbar .dropdown-menu {
                right: -10px !important;
            }
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">
        <?= $this->include('layouts/sidebar') ?>

        <div id="main-wrapper">
            <?= $this->include('layouts/navbar') ?>

            <main class="page-content-wrapper">
                <div class="container-fluid">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="border-radius: 12px;">
                            <i class="fas fa-check-circle mr-2"></i> <b>Berhasil!</b> <?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?= $this->renderSection('content') ?>
                </div>
            </main>

            <footer class="fixed-footer">
                <div class="footer-container d-flex justify-content-between w-100 align-items-center">
                    <div class="footer-left">
                        <span class="copyright">
                            <span class="brand-name-footer">SIPENCAK</span> &copy; <?= date('Y') ?> LLDIKTI III.
                        </span>
                    </div>
                    <div class="footer-right d-none d-sm-flex align-items-center">
                        <div class="system-badge">
                            <div class="status-indicator"></div>
                            <span class="small font-weight-bold">System Online</span>
                        </div>
                        <div class="mx-3 text-muted" style="opacity: 0.5;">|</div>
                        <div class="small text-muted font-weight-bold">v2.0.4</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sidebar Toggle Logic
            $('#sidebarToggle').on('click', function(e) {
                e.preventDefault();
                $('#wrapper').toggleClass('toggled');
                $('#sidebar').toggleClass('minimized');
                if ($(window).width() < 992) $('#sidebar').toggleClass('active');
            });

            // ADVANCED DROPDOWN LOCK
            // Memaksa dropdown tetap di bawah icon meskipun window di-resize
            $('.dropdown').on('show.bs.dropdown', function() {
                $(this).find('.dropdown-menu').first().stop(true, true).addClass('show');
            });
            $('.dropdown').on('hide.bs.dropdown', function() {
                $(this).find('.dropdown-menu').first().stop(true, true).removeClass('show');
            });

            if ($('#summernote').length) {
                $('#summernote').summernote({
                    height: 200
                });
            }
        });
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>