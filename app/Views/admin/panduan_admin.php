<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom p-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                            <i class="fas fa-book-reader fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">Panduan Penggunaan Sistem SIPENCAK</h4>
                            <p class="text-muted mb-0 small">Dokumentasi lengkap fitur dan cara penggunaan untuk Admin Perguruan Tinggi.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    
                    <!-- KONTEN PANDUAN -->
                    <div class="guide-content">
                        <h2 class="h4 fw-bold text-primary mb-4">🎯 TENTANG SIPENCAK</h2>
                        <p><strong>SIPENCAK</strong> adalah <strong>Sistem Informasi Pencairan KIP-K</strong> yang dikelola oleh LLDIKTI Wilayah III Jakarta. Sistem ini digunakan untuk:</p>
                        <ul class="mb-4">
                            <li>Mengelola data mahasiswa penerima beasiswa KIP-K</li>
                            <li>Mengajukan permohonan pencairan beasiswa</li>
                            <li>Memverifikasi status mahasiswa</li>
                            <li>Melihat laporan pencairan</li>
                        </ul>

                        <div class="alert alert-info border-0 d-flex gap-3 align-items-center mb-5">
                            <i class="fas fa-info-circle fa-2x"></i>
                            <div>
                                <strong>Tips Penting:</strong>
                                <p class="mb-0">Gunakan browser terbaru (Chrome/Edge) dan selalu logout setelah selesai menggunakan sistem.</p>
                            </div>
                        </div>

                        <hr class="my-5">

                        <h2 class="h4 fw-bold text-primary mb-4">1. CARA LOGIN KE SISTEM</h2>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6">
                                <ol class="ps-3">
                                    <li class="mb-2">Buka browser dan akses alamat SIPENCAK.</li>
                                    <li class="mb-2">Masukkan <strong>Username</strong> dan <strong>Password</strong>.</li>
                                    <li class="mb-2">Masukkan <strong>Kode Captcha</strong> sesuai gambar.</li>
                                    <li class="mb-2">Klik tombol <strong>Login</strong>.</li>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded-3 border text-center">
                                    <small class="text-muted d-block mb-2">Form Login</small>
                                    <i class="fas fa-user-lock fa-3x text-secondary opacity-50"></i>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        <h2 class="h4 fw-bold text-primary mb-4">2. MEMAHAMI DASHBOARD</h2>
                        <p>Setelah login, Anda akan melihat Dashboard dengan statistik utama:</p>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="p-3 border rounded text-center bg-light">
                                    <strong class="d-block text-primary">Total PT</strong>
                                    <span class="small text-muted">Statistik kampus</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 border rounded text-center bg-light">
                                    <strong class="d-block text-success">Mahasiswa</strong>
                                    <span class="small text-muted">Total penerima</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 border rounded text-center bg-light">
                                    <strong class="d-block text-info">Verifikator</strong>
                                    <span class="small text-muted">Akun aktif</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="p-3 border rounded text-center bg-light">
                                    <strong class="d-block text-warning">Pencairan</strong>
                                    <span class="small text-muted">Status pengajuan</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        <h2 class="h4 fw-bold text-primary mb-4">3. MENGELOLA DATA MAHASISWA</h2>
                        <p>Fitur utama untuk menambah dan mengedit data penerima KIP-K.</p>
                        
                        <h5 class="fw-bold mt-4">A. Tambah Mahasiswa Manual</h5>
                        <ol class="ps-3 mb-4">
                            <li>Klik menu <strong>Manajemen Mahasiswa</strong>.</li>
                            <li>Klik tombol <strong>+ Tambah Mahasiswa</strong>.</li>
                            <li>Isi form lengkap (NIM, Nama, Prodi, Jenjang, dll).</li>
                            <li>Klik <strong>Simpan</strong>.</li>
                        </ol>

                        <h5 class="fw-bold mt-4">B. Import Data Excel (Bulk Upload)</h5>
                        <div class="card bg-warning bg-opacity-10 border-warning border-opacity-25 mb-3">
                            <div class="card-body">
                                <h6 class="fw-bold text-warning-emphasis"><i class="fas fa-file-excel me-2"></i>Format Excel Wajib:</h6>
                                <div class="table-responsive bg-white rounded border">
                                    <table class="table table-sm table-bordered mb-0 small">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kolom A</th>
                                                <th>Kolom B</th>
                                                <th>Kolom C</th>
                                                <th>Kolom D</th>
                                                <th>Kolom E</th>
                                                <th>Kolom F</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Kode Prodi</td>
                                                <td>NIM</td>
                                                <td>Nama</td>
                                                <td>Jenjang</td>
                                                <td>Angkatan</td>
                                                <td>Kategori</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">Contoh: 65201</td>
                                                <td class="text-muted">12345678</td>
                                                <td class="text-muted">Budi Santoso</td>
                                                <td class="text-muted">S1</td>
                                                <td class="text-muted">2024</td>
                                                <td class="text-muted">Pembiayaan Penuh</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        <h2 class="h4 fw-bold text-primary mb-4">4. PENGAJUAN PENCAIRAN (PENTING!)</h2>
                        <div class="alert alert-warning border-0 d-flex gap-3 align-items-center mb-4">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                            <div>
                                <p class="mb-0">Proses ini dilakukan untuk mengajukan nama-nama mahasiswa agar dananya dapat dicairkan. <strong>Pastikan data mahasiswa sudah benar</strong> sebelum melakukan proses ini.</p>
                            </div>
                        </div>

                        <div class="step-guide">
                            <h5 class="fw-bold text-dark mt-4 mb-3"><i class="fas fa-calendar-plus me-2 text-primary"></i>Tahap 1: Membuat Wadah Pengajuan</h5>
                            <ol class="ps-3 mb-4">
                                <li class="mb-2">Klik menu <strong>Verifikasi Pembaharuan Status</strong> di sidebar kiri.</li>
                                <li class="mb-2">Klik tombol biru <strong>+ Buat Permohonan Baru</strong>.</li>
                                <li class="mb-2">Pilih <strong>Periode Pencairan</strong> (Misal: Semester Ganjil 2024).</li>
                                <li class="mb-2">Klik <strong>Simpan</strong>.</li>
                            </ol>
                            <div class="bg-light p-3 rounded mb-4 ms-3 border-start border-4 border-secondary">
                                <small class="d-block text-muted">Hasil Tahap 1:</small>
                                <strong>Status "Draft" (Abu-abu)</strong> akan muncul. Ini artinya pengajuan masih berupa konsep dan belum terkirim ke LLDIKTI.
                            </div>

                            <h5 class="fw-bold text-dark mt-4 mb-3"><i class="fas fa-user-check me-2 text-primary"></i>Tahap 2: Memilih Mahasiswa</h5>
                            <ol class="ps-3 mb-4">
                                <li class="mb-2">Klik tombol <strong>Detail</strong> (ikon mata) pada baris pengajuan yang barusan dibuat.</li>
                                <li class="mb-2">Anda akan melihat daftar seluruh mahasiswa.</li>
                                <li class="mb-2"><strong>Centang (Checklist)</strong> kotak di sebelah kiri nama mahasiswa yang ingin diajukan.</li>
                                <li class="mb-2">Klik tombol <strong>Simpan Perubahan</strong> di bagian bawah.</li>
                            </ol>
                            <div class="alert alert-danger py-2 ms-3">
                                <i class="fas fa-exclamation-circle me-1"></i> <strong>JANGAN LUPA KLIK SIMPAN!</strong> Jika tidak, pilihan mahasiswa anda tidak akan tersimpan.
                            </div>

                            <h5 class="fw-bold text-dark mt-4 mb-3"><i class="fas fa-paper-plane me-2 text-primary"></i>Tahap 3: Mengirim ke LLDIKTI (Finalisasi)</h5>
                            <ol class="ps-3 mb-4">
                                <li class="mb-2">Pastikan semua mahasiswa yang berhak sudah dicentang.</li>
                                <li class="mb-2">Klik tombol <strong>Finalisasi</strong> (Warna Hijau/Biru).</li>
                                <li class="mb-2">Akan muncul konfirmasi, klik <strong>Ya / OK</strong>.</li>
                            </ol>
                            <div class="bg-light p-3 rounded mb-4 ms-3 border-start border-4 border-warning">
                                <small class="d-block text-muted">Hasil Tahap 3:</small>
                                <strong>Status "Diproses" (Kuning)</strong>. Data sudah masuk ke sistem LLDIKTI dan sedang dicek. Anda tidak bisa mengubah data lagi setelah ini.
                            </div>
                        </div>

                        <div class="card mt-5 border-0 bg-light">
                            <div class="card-body">
                                <h6 class="fw-bold mb-3">Kamus Status Pengajuan:</h6>
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-secondary me-2" style="width: 80px;">DRAFT</span>
                                        <small class="text-muted">Masih konsep kampus, belum terlihat oleh LLDIKTI. Masih bisa diedit.</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-warning text-dark me-2" style="width: 80px;">DIPROSES</span>
                                        <small class="text-muted">Sudah dikirim ke LLDIKTI. Menunggu verifikasi.</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-success me-2" style="width: 80px;">SELESAI</span>
                                        <small class="text-muted">Pencairan disetujui dan sedang diproses bank.</small>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-danger me-2" style="width: 80px;">DITOLAK</span>
                                        <small class="text-muted">Ada kesalahan data. Perlu perbaikan dan pengajuan ulang.</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5">

                        <div class="text-center py-4 bg-light rounded-4">
                            <h5 class="fw-bold mb-3">Butuh Bantuan Lebih Lanjut?</h5>
                            <p class="text-muted mb-4">Silakan hubungi tim IT LLDIKTI Wilayah III jika mengalami kendala teknis.</p>
                            <a href="<?= base_url('home') ?>" class="btn btn-outline-primary px-4 rounded-pill">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.guide-content p, .guide-content li {
    font-size: 1.05rem;
    line-height: 1.7;
    color: #475569;
}
.guide-content h2 {
    border-left: 5px solid #2563eb;
    padding-left: 15px;
}
</style>

<?= $this->endSection(); ?>
