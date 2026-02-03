<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? 'SIPENCAK' ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* --- 1. GLOBAL WRAPPER CONFIG --- */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            /* Mengatur sidebar dan konten secara horizontal */
            min-height: 100vh;
            width: 100%;
        }

        /* --- 2. MAIN CONTENT AREA (Kunci Agar Tidak Bentrok) --- */
        #main-wrapper {
            flex: 1;
            /* Margin-left harus SAMA dengan lebar sidebar */
            margin-left: 280px;
            width: calc(100% - 280px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        /* --- 3. KONDISI SIDEBAR MINIMIZED --- */
        /* Saat Sidebar memiliki class .minimized, Main Content harus bergeser */
        #sidebar.minimized+#main-wrapper,
        #main-wrapper.expanded {
            margin-left: 88px;
            width: calc(100% - 88px);
        }

        /* --- 4. PAGE CONTENT PADDING --- */
        .page-content {
            padding: 1.5rem;
            flex: 1;
            /* Ruang bawah agar tidak tertutup fixed footer */
            padding-bottom: 80px;
        }

        /* Responsive untuk Tablet/HP */
        @media (max-width: 992px) {
            #main-wrapper {
                margin-left: 0 !important;
                width: 100% !important;
            }

            #sidebar {
                left: -280px;
                /* Sembunyikan sidebar di mobile */
            }

            #sidebar.active {
                left: 0;
            }
        }
    </style>
</head>

<body>

    <div id="wrapper">
        <?= $this->include('layout/sidebar') ?>

        <div id="main-wrapper">
            <?= $this->include('layout/navbar') ?>

            <main class="page-content">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
            </main>

            <?= $this->include('layout/footer') ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // SINKRONISASI TOGGLE
            $('#sidebarToggle').on('click', function() {
                // Kecilkan Sidebar
                $('#sidebar').toggleClass('minimized');
                // Geser Main Wrapper ke kiri
                $('#main-wrapper').toggleClass('expanded');

                // Opsional: Jika menggunakan fixed footer di dalam footer.php
                $('.fixed-footer').toggleClass('expanded');
            });

            // Handle Mobile View
            if ($(window).width() < 992) {
                $('#sidebarToggle').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });
            }
        });
    </script>
</body>

</html>