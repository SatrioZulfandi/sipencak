<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->post('login', 'Auth::login');

// Forgot Password Routes
$routes->get('forgot', 'Auth::forgot');
$routes->post('send-reset', 'Auth::sendReset');
$routes->get('verify', 'Auth::verify');
$routes->post('check-code', 'Auth::checkCode');
$routes->get('new-password', 'Auth::newPassword');
$routes->post('update-password', 'Auth::updatePassword');

// Captcha Route
$routes->get('refresh-captcha', 'Auth::refreshCaptcha');

// Protected page (hanya bisa diakses setelah login)
$routes->group('', ['filter' => 'operatorAuth'], function ($routes) {
    $routes->get('dashboard', 'Operator\Dashboard::index');
    $routes->post('password-update/(:num)', 'Operator\Dashboard::update/$1');
    
    // Change Password with OTP (Operator)
    $routes->post('operator/send-change-otp', 'Operator\Dashboard::sendChangeOtp');
    $routes->post('operator/verify-change-otp', 'Operator\Dashboard::verifyChangeOtp');
    $routes->post('operator/update-password-otp', 'Operator\Dashboard::updatePasswordOtp');
    
    // Update Email (Operator)
    $routes->post('operator/update-email', 'Operator\Dashboard::updateEmail');
    
    // Update Profile (Operator)
    $routes->post('operator/update-profile', 'Operator\Dashboard::updateProfile');

    // Manajemen Perguruan Tinggi
    $routes->get('pt-list', 'Operator\Pt::index');
    $routes->post('pt-upload', 'Operator\Pt::uploadExcel');
    $routes->get('pt-create', 'Operator\Pt::create');
    $routes->get('pt-edit/(:num)', 'Operator\Pt::edit/$1');
    $routes->get('pt-delete/(:num)', 'Operator\Pt::delete/$1');
    $routes->post('pt-store', 'Operator\Pt::store');
    $routes->post('pt-update/(:num)', 'Operator\Pt::update/$1');

    // Manajemen User PT
    $routes->get('userpt-list', 'Operator\Userpt::index');
    $routes->get('userpt-create', 'Operator\Userpt::create');
    $routes->get('userpt-edit/(:num)', 'Operator\Userpt::edit/$1');
    $routes->get('userpt-delete/(:num)', 'Operator\Userpt::delete/$1');
    $routes->get('userpt-show/(:num)', 'Operator\Userpt::show/$1');
    $routes->post('userpt-store', 'Operator\Userpt::store');
    $routes->post('userpt-update/(:num)', 'Operator\Userpt::update/$1');
    $routes->post('userpt-import', 'Operator\Userpt::import');

    // Manajemen Informasi
    $routes->get('informasi-list', 'Operator\Informasi::index');
    $routes->get('informasi-create', 'Operator\Informasi::create');
    $routes->get('informasi-edit/(:num)', 'Operator\Informasi::edit/$1');
    $routes->get('informasi-delete/(:num)', 'Operator\Informasi::delete/$1');
    $routes->get('informasi-show/(:num)', 'Operator\Informasi::show/$1');
    $routes->post('informasi-store', 'Operator\Informasi::store');
    $routes->post('informasi-update/(:num)', 'Operator\Informasi::update/$1');

    // Pencairan
    $routes->get('pencairan-list', 'Operator\Pencairan::index');
    $routes->get('operator/pencairan/unduh-excel', 'Operator\Pencairan::unduhExcel');
    $routes->get('pencairan-detail/(:num)', 'Operator\Pencairan::detail/$1');
    $routes->get('operator/pencairan/unduh-mahasiswa/(:num)', 'Operator\Pencairan::unduhMahasiswa/$1');
    $routes->post('pencairan/selesai/(:num)', 'Operator\Pencairan::markSelesai/$1');
    $routes->post('pencairan/ditolak/(:num)', 'Operator\Pencairan::markDitolak/$1');
    $routes->post('pencairan/revisi/(:num)', 'Operator\Pencairan::revisi/$1'); // Edit (Kembali ke Draft)
    $routes->post('pencairan/batalkan/(:num)', 'Operator\Pencairan::batalkan/$1'); // Batalkan (Hapus)
    $routes->get('laporan-list', 'Operator\Pencairan::laporan');
    $routes->get('laporan-detail/(:num)', 'Operator\Pencairan::detail/$1');
    $routes->get('laporan', 'Operator\Pencairan::laporanHome');
    $routes->get('laporan-list/(:num)', 'Operator\Pencairan::laporanByPt/$1');
    $routes->get('Operator/pencairan/unduh-laporan', 'Operator\Pencairan::unduhLaporan');
    $routes->get('operator/activity-logs', 'Admin\Log::index'); // Unique URL for Operator
    $routes->get('operator/mahasiswa/riwayat/(:num)', 'Operator\Pencairan::riwayatMahasiswa/$1');
});


$routes->group('', ['filter' => 'adminAuth'], function ($routes) {
    $routes->get('home', 'Admin\Home::index');
    $routes->post('password-updates/(:num)', 'Admin\Home::update/$1');
    
    // Change Password with OTP (Admin)
    $routes->post('send-change-otp', 'Admin\Home::sendChangeOtp');
    $routes->post('verify-change-otp', 'Admin\Home::verifyChangeOtp');
    $routes->post('update-password-otp', 'Admin\Home::updatePasswordOtp');

    // Manajemen Prodi
    $routes->get('prodi-list', 'Admin\Prodi::index');
    $routes->get('prodi-create', 'Admin\Prodi::create');
    $routes->get('prodi-edit/(:num)', 'Admin\Prodi::edit/$1');
    $routes->get('prodi-delete/(:num)', 'Admin\Prodi::delete/$1');
    $routes->post('prodi-store', 'Admin\Prodi::store');
    $routes->post('prodi-update/(:num)', 'Admin\Prodi::update/$1');
    $routes->post('prodi-import', 'Admin\Prodi::import');
    $routes->get('prodi-download-template', 'Admin\Prodi::downloadTemplate');
    $routes->get('activity-logs', 'Admin\Log::index'); // Route Log Aktivitas
    $routes->post('ajukan-mahasiswa-sync', 'Admin\Pencairan::sync_mahasiswa');

    // Manajemen Mahasiswa
    $routes->get('mahasiswa-list', 'Admin\Mahasiswa::index');
    $routes->get('mahasiswa-create', 'Admin\Mahasiswa::create');
    $routes->get('mahasiswa-edit/(:num)', 'Admin\Mahasiswa::edit/$1');
    $routes->get('mahasiswa-delete/(:num)', 'Admin\Mahasiswa::delete/$1');
    $routes->get('mahasiswa-show/(:num)', 'Admin\Mahasiswa::show/$1');
    $routes->post('mahasiswa-store', 'Admin\Mahasiswa::store');
    $routes->post('mahasiswa-update/(:num)', 'Admin\Mahasiswa::update/$1');
    $routes->post('mahasiswa/updateStatus', 'Admin\Mahasiswa::updateStatus');
    $routes->post('mahasiswa-import', 'Admin\Mahasiswa::import');
    $routes->get('mahasiswa-download-error/(:segment)', 'Admin\Mahasiswa::downloadErrorFile/$1');
    $routes->get('mahasiswa-download-template', 'Admin\Mahasiswa::downloadTemplate');

    // 1
    $routes->get('verifikasi-pembaharuan-status', 'Admin\Pencairan::index');
    $routes->get('permohonan-pencairan', 'Admin\Pencairan::permohonan');
    $routes->get('verifikasi-delete/(:num)', 'Admin\Pencairan::delete/$1');
    $routes->get('verifikasi-edit/(:num)', 'Admin\Pencairan::edit/$1');
    $routes->get('verifikasi-detail/(:num)', 'Admin\Pencairan::detail/$1');
    $routes->get('export-mahasiswa/(:num)', 'Admin\Pencairan::export_mahasiswa/$1');
    $routes->post('verifikasi-ditolak/(:num)', 'Admin\Pencairan::ditolak/$1');
    $routes->post('verifikasi-update/(:num)', 'Admin\Pencairan::update/$1');
    $routes->post('permohonan-store', 'Admin\Pencairan::store');
    $routes->get('admin/pencairan/unduh-excel', 'Admin\Pencairan::unduhExcel');
    $routes->get('admin/pencairan/unduh-mahasiswa/(:num)', 'Admin\Pencairan::unduhMahasiswa/$1');
    $routes->get('admin/laporan', 'Admin\Pencairan::laporanHome');
    $routes->get('admin/laporan-list', 'Admin\Pencairan::laporan');
    $routes->get('admin/laporan-list/(:num)', 'Admin\Pencairan::laporanByPt/$1');
    $routes->get('admin/laporan-detail/(:num)', 'Admin\Pencairan::detail/$1');
    $routes->get('admin/mahasiswa/riwayat/(:num)', 'Admin\Pencairan::riwayatMahasiswa/$1');

    // 2
    $routes->get('verifikasi-mahasiswa/(:num)', 'Admin\Pencairan::verifikasi_mahasiswa/$1');
    $routes->post('ajukan-mahasiswa', 'Admin\Pencairan::ajukanMahasiswa');
    $routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {
        $routes->get('pencairan/draft', 'Admin\Pencairan::draft');
        $routes->post('pencairan/delete-empty-drafts', 'Admin\Pencairan::deleteEmptyDrafts');
    });

    // 3
    $routes->get('finalisasi-verifikasi/(:num)', 'Admin\Pencairan::finalisasi_verifikasi/$1');
    $routes->get('verifikasi-final/(:num)', 'Admin\Pencairan::verifikasi_final/$1');

    // Informasi
    $routes->get('papan-informasi', 'Admin\Informasi::index');
    $routes->get('informasi-detail/(:num)', 'Admin\Informasi::show/$1');
});
