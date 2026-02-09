<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PanduanAdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'judul' => 'Panduan Penggunaan Sistem SIPENCAK untuk Admin (Pihak Kampus)',
            'tanggal' => date('Y-m-d'),
            'deskripsi' => $this->getPanduanContent(),
        ];

        // Check if already exists
        $existing = $this->db->table('informasis')
            ->like('judul', 'Panduan Penggunaan Sistem SIPENCAK')
            ->get()
            ->getRow();

        if ($existing) {
            // Update existing
            $this->db->table('informasis')
                ->where('id', $existing->id)
                ->update($data);
            echo "Panduan Admin updated successfully!\n";
        } else {
            // Insert new
            $this->db->table('informasis')->insert($data);
            echo "Panduan Admin inserted successfully!\n";
        }
    }

    private function getPanduanContent()
    {
        return <<<'HTML'
<h1>📋 PANDUAN PENGGUNAAN SISTEM SIPENCAK</h1>
<h2>Untuk Admin (Pihak Kampus)</h2>
<hr>

<h2>🎯 TENTANG SIPENCAK</h2>
<p><strong>SIPENCAK</strong> adalah <strong>Sistem Informasi Pencairan KIP-K</strong> yang dikelola oleh LLDIKTI Wilayah III Jakarta. Sistem ini digunakan untuk:</p>
<ul>
    <li>Mengelola data mahasiswa penerima beasiswa KIP-K</li>
    <li>Mengajukan permohonan pencairan beasiswa</li>
    <li>Memverifikasi status mahasiswa</li>
    <li>Melihat laporan pencairan</li>
</ul>
<hr>

<h2>📌 DAFTAR ISI</h2>
<ol>
    <li>Cara Login ke Sistem</li>
    <li>Memahami Dashboard</li>
    <li>Mengelola Data Prodi</li>
    <li>Mengelola Data Mahasiswa</li>
    <li>Proses Verifikasi dan Pengajuan Pencairan</li>
    <li>Melihat Papan Informasi</li>
    <li>Mengganti Password</li>
    <li>Keluar dari Sistem (Logout)</li>
    <li>Tips dan Perhatian</li>
</ol>
<hr>

<h2>1. CARA LOGIN KE SISTEM</h2>
<h3>Langkah-langkah:</h3>
<ol>
    <li><strong>Buka browser</strong> (Google Chrome, Mozilla Firefox, atau Microsoft Edge)</li>
    <li><strong>Ketikkan alamat website SIPENCAK</strong> yang telah diberikan oleh LLDIKTI</li>
    <li>Anda akan melihat <strong>halaman login</strong></li>
</ol>

<h3>Mengisi Form Login:</h3>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #2563eb; color: white;">
        <tr>
            <th>Kolom</th>
            <th>Yang Harus Diisi</th>
        </tr>
    </thead>
    <tbody>
        <tr><td><strong>Username</strong></td><td>Masukkan username yang telah diberikan oleh LLDIKTI</td></tr>
        <tr><td><strong>Password</strong></td><td>Masukkan password Anda</td></tr>
        <tr><td><strong>Kode Captcha</strong></td><td>Ketikkan kode huruf/angka yang terlihat pada gambar</td></tr>
    </tbody>
</table>
<p>💡 <strong>Tips:</strong> Jika kode captcha sulit dibaca, klik tombol 🔄 (refresh) di sebelah gambar captcha untuk mendapatkan kode baru.</p>
<ol start="4">
    <li>Klik tombol <strong>Login</strong> untuk masuk ke sistem</li>
    <li>Jika berhasil, Anda akan diarahkan ke <strong>Dashboard</strong></li>
</ol>

<h3>Lupa Password?</h3>
<ol>
    <li>Klik link <strong>"Lupa Password?"</strong> di halaman login</li>
    <li>Masukkan email yang terdaftar</li>
    <li>Sistem akan mengirimkan kode OTP ke email Anda</li>
    <li>Masukkan kode OTP tersebut</li>
    <li>Buat password baru</li>
</ol>
<hr>

<h2>2. MEMAHAMI DASHBOARD</h2>
<p>Setelah login, Anda akan melihat <strong>Dashboard</strong> yang menampilkan ringkasan data.</p>

<h3>Informasi yang Ditampilkan:</h3>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #2563eb; color: white;">
        <tr>
            <th>Kotak Statistik</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr><td><strong>Ttl. PT</strong></td><td>Jumlah total Perguruan Tinggi</td></tr>
        <tr><td><strong>Mhs.</strong></td><td>Jumlah total Mahasiswa</td></tr>
        <tr><td><strong>Verifikator</strong></td><td>Jumlah User PT/Operator</td></tr>
        <tr><td><strong>Pencairan</strong></td><td>Jumlah permohonan pencairan</td></tr>
    </tbody>
</table>

<h3>Navigasi Menu (Sidebar Kiri):</h3>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #2563eb; color: white;">
        <tr>
            <th>Menu</th>
            <th>Fungsi</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>🏠 <strong>Dashboard</strong></td><td>Kembali ke halaman utama</td></tr>
        <tr><td>📚 <strong>Manajemen Prodi</strong></td><td>Kelola data program studi</td></tr>
        <tr><td>👥 <strong>Manajemen Mahasiswa</strong></td><td>Kelola data mahasiswa KIP-K</td></tr>
        <tr><td>✅ <strong>Verifikasi Pembaharuan Status</strong></td><td>Melihat daftar pengajuan pencairan</td></tr>
        <tr><td>📝 <strong>Draft Pencairan</strong></td><td>Lihat daftar pengajuan yang masih draft</td></tr>
        <tr><td>📊 <strong>Laporan</strong></td><td>Melihat laporan pencairan</td></tr>
        <tr><td>📢 <strong>Papan Informasi</strong></td><td>Melihat pengumuman</td></tr>
        <tr><td>📋 <strong>Log Aktivitas</strong></td><td>Melihat catatan aktivitas sistem</td></tr>
    </tbody>
</table>
<hr>

<h2>3. MENGELOLA DATA PRODI</h2>
<p>Menu ini digunakan untuk mengelola data <strong>Program Studi</strong> yang ada di kampus Anda.</p>

<h3>A. Melihat Daftar Prodi</h3>
<ol>
    <li>Klik menu <strong>Manajemen Prodi</strong> di sidebar</li>
    <li>Anda akan melihat tabel berisi daftar prodi</li>
    <li>Gunakan <strong>kotak pencarian</strong> untuk mencari prodi tertentu</li>
</ol>

<h3>B. Menambah Prodi Baru</h3>
<ol>
    <li>Klik tombol <strong>+ Tambah Prodi</strong></li>
    <li>Isi form yang muncul:
        <ul>
            <li><strong>Kode Prodi</strong>: Masukkan kode prodi sesuai PDDIKTI</li>
            <li><strong>Nama Prodi</strong>: Masukkan nama program studi</li>
        </ul>
    </li>
    <li>Klik tombol <strong>Simpan</strong></li>
</ol>

<h3>C. Mengubah Data Prodi</h3>
<ol>
    <li>Cari prodi yang ingin diubah di tabel</li>
    <li>Klik tombol <strong>✏️ Edit</strong> pada baris prodi tersebut</li>
    <li>Ubah data yang diperlukan</li>
    <li>Klik tombol <strong>Simpan</strong></li>
</ol>

<h3>D. Menghapus Prodi</h3>
<ol>
    <li>Cari prodi yang ingin dihapus</li>
    <li>Klik tombol <strong>🗑️ Hapus</strong> pada baris prodi tersebut</li>
    <li>Konfirmasi penghapusan jika diminta</li>
</ol>

<h3>E. Import Prodi dari Excel</h3>
<ol>
    <li>Klik tombol <strong>📥 Download Template</strong> untuk mengunduh file Excel template</li>
    <li>Buka file tersebut dan isi data prodi sesuai format:
        <ul>
            <li>Kolom A: Kode PT</li>
            <li>Kolom B: Kode Prodi</li>
            <li>Kolom C: Nama Prodi</li>
        </ul>
    </li>
    <li>Simpan file Excel</li>
    <li>Kembali ke sistem, klik tombol <strong>📤 Import Excel</strong></li>
    <li>Pilih file Excel yang sudah diisi</li>
    <li>Klik <strong>Upload</strong></li>
</ol>
<hr>

<h2>4. MENGELOLA DATA MAHASISWA</h2>
<p>Menu ini adalah fitur <strong>UTAMA</strong> untuk mengelola data mahasiswa penerima beasiswa KIP-K.</p>

<h3>A. Melihat Daftar Mahasiswa</h3>
<ol>
    <li>Klik menu <strong>Manajemen Mahasiswa</strong> di sidebar</li>
    <li>Tabel akan menampilkan: NIM, Nama, Prodi, Status, Aksi</li>
</ol>

<h3>B. Filter dan Pencarian</h3>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #2563eb; color: white;">
        <tr>
            <th>Filter</th>
            <th>Fungsi</th>
        </tr>
    </thead>
    <tbody>
        <tr><td><strong>Semester</strong></td><td>Filter berdasarkan semester</td></tr>
        <tr><td><strong>Prodi</strong></td><td>Filter berdasarkan program studi</td></tr>
        <tr><td><strong>Search</strong></td><td>Cari berdasarkan nama atau NIM</td></tr>
    </tbody>
</table>

<h3>C. Menambah Data Mahasiswa Baru</h3>
<ol>
    <li>Klik tombol <strong>+ Tambah Mahasiswa</strong></li>
    <li>Isi form lengkap:</li>
</ol>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #10b981; color: white;">
        <tr>
            <th>Kolom</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr><td><strong>Nomor Induk Mahasiswa</strong></td><td>Masukkan NIM mahasiswa</td></tr>
        <tr><td><strong>Nama Mahasiswa</strong></td><td>Masukkan nama lengkap mahasiswa</td></tr>
        <tr><td><strong>Jenjang Pendidikan</strong></td><td>Pilih jenjang (D3, D4, S1, S2, dll.)</td></tr>
        <tr><td><strong>Kategori Penerima</strong></td><td>Pilih kategori beasiswa</td></tr>
        <tr><td><strong>Program Studi</strong></td><td>Pilih program studi dari daftar</td></tr>
        <tr><td><strong>Tahun Angkatan</strong></td><td>Masukkan tahun angkatan (contoh: 2024)</td></tr>
    </tbody>
</table>
<ol start="3">
    <li>Klik tombol <strong>Konfirmasi & Simpan</strong></li>
</ol>

<h3>D. Melihat Detail Mahasiswa</h3>
<ol>
    <li>Klik tombol <strong>👁️ Detail</strong> atau <strong>Lihat</strong> pada baris mahasiswa</li>
    <li>Akan muncul informasi lengkap mahasiswa</li>
    <li>Anda juga bisa melihat <strong>Riwayat Pengajuan</strong> mahasiswa tersebut</li>
</ol>

<h3>E. Mengubah Data Mahasiswa</h3>
<ol>
    <li>Klik tombol <strong>✏️ Edit</strong> pada baris mahasiswa</li>
    <li>Ubah data yang diperlukan</li>
    <li>Klik <strong>Simpan</strong></li>
</ol>

<h3>F. Import Data Mahasiswa dari Excel (FITUR PENTING!)</h3>
<p>Untuk memasukkan banyak data mahasiswa sekaligus:</p>

<p><strong>1. Download Template Excel</strong></p>
<ul>
    <li>Klik tombol <strong>📥 Download Template</strong></li>
    <li>File Excel akan terdownload</li>
</ul>

<p><strong>2. Isi Data pada Template</strong></p>
<p>Buka file Excel dan isi kolom-kolom berikut:</p>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #f59e0b; color: white;">
        <tr>
            <th>Kolom</th>
            <th>Header</th>
            <th>Contoh</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>A</td><td>Kode Prodi</td><td>65201</td></tr>
        <tr><td>B</td><td>NIM</td><td>12345678</td></tr>
        <tr><td>C</td><td>Nama</td><td>Nama Mahasiswa</td></tr>
        <tr><td>D</td><td>Jenjang</td><td>S1</td></tr>
        <tr><td>E</td><td>Angkatan</td><td>2024</td></tr>
        <tr><td>F</td><td>Kategori</td><td>Skema Pembiayaan Penuh</td></tr>
    </tbody>
</table>

<p><strong>3. Upload File Excel</strong></p>
<ul>
    <li>Simpan file Excel</li>
    <li>Klik tombol <strong>📤 Import Excel</strong></li>
    <li>Pilih file yang sudah diisi</li>
    <li>Klik <strong>Upload</strong></li>
</ul>

<p><strong>4. Periksa Hasil Import</strong></p>
<ul>
    <li>Jika ada error, sistem akan memberitahu baris mana yang bermasalah</li>
    <li>Anda bisa download file error untuk melihat detailnya</li>
    <li>Perbaiki data yang error dan upload ulang</li>
</ul>
<hr>

<h2>5. PROSES VERIFIKASI DAN PENGAJUAN PENCAIRAN</h2>
<p>Ini adalah <strong>PROSES UTAMA</strong> dalam sistem SIPENCAK untuk mengajukan pencairan beasiswa.</p>

<h3>A. Alur Proses Pencairan</h3>
<div style="background: #f1f5f9; padding: 15px; border-radius: 8px; font-family: monospace; text-align: center;">
    <strong>1. DRAFT</strong> ➡️ <strong>2. DIPROSES</strong> ➡️ <strong>3. SELESAI</strong><br><br>
    (Persiapan) → (Verifikasi LLDIKTI) → (Dana Cair ke Rek. Mahasiswa)
</div>

<h3>B. Melihat Daftar Pengajuan</h3>
<ol>
    <li>Klik menu <strong>Verifikasi Pembaharuan Status</strong></li>
    <li>Anda akan melihat tabel berisi semua pengajuan pencairan</li>
    <li>Setiap pengajuan memiliki <strong>status</strong>:</li>
</ol>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #2563eb; color: white;">
        <tr>
            <th>Status</th>
            <th>Warna</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr><td><strong>Draft</strong></td><td style="background: #9ca3af; color: white;">Abu-abu</td><td>Masih dalam proses penyusunan</td></tr>
        <tr><td><strong>Diproses</strong></td><td style="background: #fbbf24; color: black;">Kuning</td><td>Sedang diverifikasi oleh LLDIKTI</td></tr>
        <tr><td><strong>Selesai</strong></td><td style="background: #10b981; color: white;">Hijau</td><td>Pencairan sudah dilakukan</td></tr>
        <tr><td><strong>Ditolak</strong></td><td style="background: #ef4444; color: white;">Merah</td><td>Pengajuan ditolak, perlu revisi</td></tr>
    </tbody>
</table>

<h3>C. Membuat Pengajuan Pencairan Baru</h3>
<p><strong>Langkah 1: Buat Permohonan Baru</strong></p>
<ol>
    <li>Klik menu <strong>Verifikasi Pembaharuan Status</strong></li>
    <li>Klik tombol <strong>+ Buat Permohonan Baru</strong></li>
    <li>Pilih <strong>Periode</strong> pencairan</li>
    <li>Klik <strong>Simpan</strong> - Status akan menjadi <strong>Draft</strong></li>
</ol>

<p><strong>Langkah 2: Pilih Mahasiswa yang Diajukan</strong></p>
<ol>
    <li>Klik tombol <strong>Detail</strong> pada pengajuan yang baru dibuat</li>
    <li>Anda akan melihat daftar mahasiswa</li>
    <li><strong>Centang (✓)</strong> mahasiswa yang akan diajukan pencairannya</li>
    <li>Klik tombol <strong>Simpan Perubahan</strong></li>
</ol>

<p><strong>Langkah 3: Verifikasi dan Finalisasi</strong></p>
<ol>
    <li>Setelah memilih semua mahasiswa, klik <strong>Finalisasi</strong></li>
    <li>Periksa kembali data mahasiswa yang terpilih</li>
    <li>Jika sudah benar, klik <strong>Kirim Pengajuan</strong></li>
    <li>Status akan berubah menjadi <strong>Diproses</strong></li>
</ol>

<h3>D. Melihat Detail Pengajuan</h3>
<ol>
    <li>Klik tombol <strong>👁️ Detail</strong> pada baris pengajuan</li>
    <li>Halaman detail menampilkan:
        <ul>
            <li>Informasi periode pencairan</li>
            <li>Daftar mahasiswa yang diajukan</li>
            <li>Status setiap mahasiswa</li>
            <li>Total nominal pencairan</li>
        </ul>
    </li>
</ol>

<h3>E. Export Data Mahasiswa ke Excel</h3>
<ol>
    <li>Di halaman detail pengajuan, klik <strong>📥 Unduh Excel</strong></li>
    <li>Data mahasiswa akan terdownload dalam format Excel</li>
    <li>Gunakan untuk arsip atau verifikasi manual</li>
</ol>
<hr>

<h2>6. MELIHAT PAPAN INFORMASI</h2>
<p>Papan Informasi berisi pengumuman penting dari LLDIKTI.</p>

<h3>Cara Mengakses:</h3>
<ol>
    <li>Klik menu <strong>Papan Informasi</strong> di sidebar</li>
    <li>Anda akan melihat daftar pengumuman/informasi</li>
    <li>Klik judul pengumuman untuk melihat detail lengkap</li>
</ol>

<h3>Informasi yang Ditampilkan:</h3>
<ul>
    <li><strong>Tanggal</strong> - Tanggal pengumuman diterbitkan</li>
    <li><strong>Judul</strong> - Judul pengumuman</li>
    <li><strong>Isi</strong> - Isi lengkap pengumuman</li>
    <li><strong>Lampiran</strong> - File pendukung (jika ada)</li>
</ul>
<hr>

<h2>7. MENGGANTI PASSWORD</h2>
<p>Untuk keamanan, ganti password Anda secara berkala.</p>

<h3>Langkah-langkah:</h3>
<ol>
    <li>Klik <strong>ikon profil/nama Anda</strong> di pojok kanan atas</li>
    <li>Pilih <strong>Ganti Password</strong> atau <strong>Pengaturan Akun</strong></li>
    <li>Masukkan <strong>password lama</strong> Anda</li>
    <li>Masukkan <strong>password baru</strong> (minimal 8 karakter)</li>
    <li>Ketik ulang <strong>konfirmasi password baru</strong></li>
    <li>Klik <strong>Simpan</strong></li>
</ol>

<h3>Ganti Password dengan OTP:</h3>
<ol>
    <li>Klik <strong>Ganti Password via Email</strong></li>
    <li>Sistem akan mengirimkan kode OTP ke email terdaftar</li>
    <li>Masukkan kode OTP</li>
    <li>Buat password baru</li>
    <li>Klik <strong>Simpan</strong></li>
</ol>
<hr>

<h2>8. KELUAR DARI SISTEM (LOGOUT)</h2>
<div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 10px 0;">
    ⚠️ <strong>PENTING:</strong> Selalu logout setelah selesai menggunakan sistem!
</div>

<h3>Cara Logout:</h3>
<ol>
    <li>Klik <strong>ikon profil/nama Anda</strong> di pojok kanan atas</li>
    <li>Klik tombol <strong>Logout</strong> atau <strong>Keluar</strong></li>
    <li>Anda akan diarahkan ke halaman login</li>
</ol>
<hr>

<h2>9. TIPS DAN PERHATIAN</h2>

<h3>✅ Yang HARUS Dilakukan:</h3>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #10b981; color: white;">
        <tr>
            <th>No</th>
            <th>Tips</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Selalu <strong>logout</strong> setelah selesai menggunakan sistem</td></tr>
        <tr><td>2</td><td>Gunakan <strong>browser terbaru</strong> (Chrome/Firefox/Edge)</td></tr>
        <tr><td>3</td><td>Pastikan <strong>data mahasiswa sudah benar</strong> sebelum mengajukan pencairan</td></tr>
        <tr><td>4</td><td><strong>Simpan</strong> pekerjaan secara berkala</td></tr>
        <tr><td>5</td><td><strong>Backup</strong> data penting dengan export ke Excel</td></tr>
        <tr><td>6</td><td>Periksa <strong>Papan Informasi</strong> secara rutin untuk update terbaru</td></tr>
    </tbody>
</table>

<h3>❌ Yang TIDAK BOLEH Dilakukan:</h3>
<table border="1" cellpadding="10" style="border-collapse: collapse; width: 100%;">
    <thead style="background-color: #ef4444; color: white;">
        <tr>
            <th>No</th>
            <th>Larangan</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>1</td><td>Jangan bagikan <strong>username dan password</strong> kepada orang lain</td></tr>
        <tr><td>2</td><td>Jangan biarkan komputer <strong>tidak terkunci</strong> saat ditinggalkan</td></tr>
        <tr><td>3</td><td>Jangan gunakan wifi <strong>publik/tidak aman</strong> saat mengakses sistem</td></tr>
        <tr><td>4</td><td>Jangan <strong>asal menghapus data</strong> tanpa koordinasi</td></tr>
    </tbody>
</table>

<h3>🆘 Jika Mengalami Masalah:</h3>
<p><strong>1. Tidak bisa login?</strong></p>
<ul>
    <li>Periksa username dan password</li>
    <li>Pastikan captcha diisi dengan benar</li>
    <li>Gunakan fitur "Lupa Password" jika lupa password</li>
</ul>

<p><strong>2. Halaman error?</strong></p>
<ul>
    <li>Refresh halaman (tekan F5)</li>
    <li>Hapus cache browser</li>
    <li>Coba browser lain</li>
</ul>

<p><strong>3. Masih bermasalah?</strong></p>
<ul>
    <li>Hubungi admin LLDIKTI Wilayah III</li>
    <li>Jelaskan masalah dengan detail</li>
    <li>Sertakan screenshot jika perlu</li>
</ul>
<hr>

<p style="text-align: center; color: #64748b; margin-top: 30px;">
    <strong>Dokumen ini dibuat untuk memudahkan pengguna Admin (Pihak Kampus) dalam mengoperasikan Sistem SIPENCAK.</strong><br><br>
    <strong>Versi Dokumen:</strong> 1.0<br>
    <strong>Tanggal Pembaruan:</strong> Februari 2026<br><br>
    <em>© 2026 LLDIKTI Wilayah III - Sistem Informasi Pencairan KIP-K</em>
</p>
HTML;
    }
}
