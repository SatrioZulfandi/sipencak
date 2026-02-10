<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\PencairanModel;
use App\Models\PeriodeModel;
use App\Models\LogModel; // Import LogModel
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Pencairan extends BaseController
{
    public function index()
    {
        $model = new PencairanModel();
        $periodeModel = new PeriodeModel();
        $pt = session()->get('pt');

        // Ambil keyword dari input GET
        $keyword = $this->request->getGet('keyword');

        // Query Dasar
        $model->where('id_pt', $pt)
            ->whereIn('status', ['Diproses', 'Selesai', 'Ditolak']);

        // Logika Pencarian
        if ($keyword) {
            $model->groupStart()
                ->like('kategori_penerima', $keyword)
                ->orLike('semester', $keyword)
                ->orLike('status', $keyword)
                ->groupEnd();
        }

        $data = [
            'histori' => $model->orderBy('tanggal_entry', 'DESC')->paginate(10, 'default'),
            'pager'   => $model->pager,
            'draft'   => $model->where('id_pt', $pt)->draft(),
            'title'   => 'Verifikasi Pembaharuan Status',
            'periode' => $periodeModel->periode(),
            'keyword' => $keyword // Kirim balik ke view
        ];

        return view('admin/verifikasi_list', $data);
    }

    public function permohonan()
    {
        $periode = new PeriodeModel();
        $data = [
            'title' => 'Permohonan Pencairan',
            'periode' => $periode->periode(),
        ];
        return view('admin/verifikasi_1', $data);
    }

    public function unduhExcel()
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();

        $data = $mahasiswaModel
            ->select('mahasiswas.*, prodis.nama_prodi, prodis.kode_prodi, pts.perguruan_tinggi, pts.kode_pt, pengajuan_mahasiswa.status_pengajuan')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi', 'left')
            ->join('pts', 'pts.id = mahasiswas.id_pt', 'left')
            ->join('pengajuan_mahasiswa', 'pengajuan_mahasiswa.id_mahasiswa = mahasiswas.id')
            ->join('pencairans', 'pencairans.id = pengajuan_mahasiswa.id_pencairan')
            ->where('pencairans.status', 'Selesai')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['NIM', 'Nama', 'Program Studi', 'Kode Prodi', 'Perguruan Tinggi', 'Jenjang', 'Angkatan', 'Pembaruan Status', 'Status Pengajuan'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        // Data
        $row = 2;
        foreach ($data as $mhs) {
            $sheet->setCellValue('A' . $row, $mhs['nim']);
            $sheet->setCellValue('B' . $row, $mhs['nama']);
            $sheet->setCellValue('C' . $row, $mhs['nama_prodi'] ?? '-');
            $sheet->setCellValue('D' . $row, $mhs['kode_prodi'] ?? '-');
            $sheet->setCellValue('E' . $row, ($mhs['kode_pt'] ?? '-') . ' - ' . ($mhs['perguruan_tinggi'] ?? '-'));
            $sheet->setCellValue('F' . $row, $mhs['jenjang']);
            $sheet->setCellValue('G' . $row, $mhs['angkatan']);
            $sheet->setCellValue('H' . $row, $mhs['pembaruan_status']);
            $sheet->setCellValue('I' . $row, $mhs['status_pengajuan']);
            $row++;
        }

        $lastRow = $row - 1;

        // Tambahkan border ke semua sel yang digunakan
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'wrapText' => true,
            ],
        ];

        $sheet->getStyle('A1:I' . $lastRow)->applyFromArray($styleArray);

        // Set auto width per kolom
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Nama file
        $filename = 'mahasiswa_selesai_admin_' . date('Ymd_His') . '.xlsx';

        // Header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function unduhMahasiswa($id_pencairan)
    {
        $pencairanModel = new \App\Models\PencairanModel();
        $mahasiswaModel = new \App\Models\MahasiswaModel();

        $pencairan = $pencairanModel->find($id_pencairan);

        if (!$pencairan || $pencairan['status'] !== 'Selesai') {
            return redirect()->back()->with('error', 'Data tidak ditemukan atau status belum selesai.');
        }

        $table = $mahasiswaModel->table;
        $mahasiswaList = $mahasiswaModel
            ->select("$table.*, prodis.nama_prodi, pengajuan_mahasiswa.status_pengajuan")
            ->join('prodis', "prodis.id = $table.id_prodi", 'left')
            ->join('pengajuan_mahasiswa', "pengajuan_mahasiswa.id_mahasiswa = $table.id")
            ->where("pengajuan_mahasiswa.id_pencairan", $id_pencairan)
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $headers = ['NIM', 'Nama', 'Program Studi', 'Jenjang', 'Angkatan', 'Pembaruan Status'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        // Data
        $row = 2;
        foreach ($mahasiswaList as $mhs) {
            $sheet->setCellValue('A' . $row, $mhs['nim']);
            $sheet->setCellValue('B' . $row, $mhs['nama']);
            $sheet->setCellValue('C' . $row, $mhs['nama_prodi'] ?? '-');
            $sheet->setCellValue('D' . $row, $mhs['jenjang']);
            $sheet->setCellValue('E' . $row, $mhs['angkatan']);
            $sheet->setCellValue('F' . $row, $mhs['pembaruan_status']);
            $row++;
        }

        $lastRow = $row - 1;

        // Style border dan perataan
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'wrapText' => true,
            ],
        ];
        $sheet->getStyle('A1:F' . $lastRow)->applyFromArray($styleArray);

        // Bold dan rata tengah header
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFDDDDDD']
            ]
        ]);

        // Set kolom auto width
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Nama file
        $filename = 'mahasiswa_pencairan_' . $id_pencairan . '_' . date('Ymd_His') . '.xlsx';

        // Header unduh
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function store()
    {
        $maxSize = 2097152; // 2MB dalam byte
        $folder = 'file/';

        // === SPTJM ===
        $sptjm = $this->request->getFile('sptjm');
        if ($sptjm && $sptjm->isValid() && !$sptjm->hasMoved()) {
            if ($sptjm->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file SPTJM melebihi 2MB.');
            }
            $newsptjm = $sptjm->getRandomName();
            $sptjm->move($folder, $newsptjm);
        } else {
            $newsptjm = null;
        }

        // === SK Penetapan ===
        $sk_penetapan = $this->request->getFile('sk_penetapan');
        if ($sk_penetapan && $sk_penetapan->isValid() && !$sk_penetapan->hasMoved()) {
            if ($sk_penetapan->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file SK Penetapan melebihi 2MB.');
            }
            $newSk_penetapan = $sk_penetapan->getRandomName();
            $sk_penetapan->move($folder, $newSk_penetapan);
        } else {
            $newSk_penetapan = null;
        }

        // === SK Pembatalan ===
        $sk_pembatalan = $this->request->getFile('sk_pembatalan');
        if ($sk_pembatalan && $sk_pembatalan->isValid() && !$sk_pembatalan->hasMoved()) {
            if ($sk_pembatalan->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file SK Pembatalan melebihi 2MB.');
            }
            $newSk_pembatalan = $sk_pembatalan->getRandomName();
            $sk_pembatalan->move($folder, $newSk_pembatalan);
        } else {
            $newSk_pembatalan = null;
        }

        // === Berita Acara ===
        $berita_acara = $this->request->getFile('berita_acara');
        if ($berita_acara && $berita_acara->isValid() && !$berita_acara->hasMoved()) {
            if ($berita_acara->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file Berita Acara melebihi 2MB.');
            }
            $newBerita_acara = $berita_acara->getRandomName();
            $berita_acara->move($folder, $newBerita_acara);
        } else {
            $newBerita_acara = null;
        }

        // Simpan ke database
        $model = new PencairanModel();
        
        // Fix Logic Periode: Ambil dari Semester + Tahun sekarang (atau tahun input jika ada)
        // Format yang diinginkan: "Semester Ganjil" atau "Semester Genap" (sesuai existing database)
        // Kita abaikan input 'periode' dari form yang hardcoded ID 1
        $semesterInput = $this->request->getPost('semester');
        $periodeFixed = 'Semester ' . $semesterInput; // Hasil: "Semester Ganjil" atau "Semester Genap"

        $model->save([
            'id_pt' => $this->request->getPost('id_pt'),
            'periode' => $periodeFixed, // Gunakan fixed logic
            'kategori_penerima' => $this->request->getPost('kategori_penerima'),
            'tanggal_entry' => date('Y-m-d'),
            'no_sk' => $this->request->getPost('no_surat_permohonan'),
            'tanggal' => $this->request->getPost('tanggal'), // Ambil dari input form, bukan date('Y-m-d')
            'semester' => $semesterInput,
            'sptjm' => $newsptjm,
            'sk_penetapan' => $newSk_penetapan,
            'sk_pembatalan' => $newSk_pembatalan,
            'berita_acara' => $newBerita_acara,
        ]);

        return redirect()->to('verifikasi-mahasiswa/' . $model->getInsertID());
    }

    public function laporanHome()
    {
        $model = new \App\Models\PencairanModel();
        $pt = session()->get('pt');

        // Ambil keyword dari input search di View
        $keyword = $this->request->getGet('keyword');

        // Inisialisasi Query
        $query = $model->select('pts.id, pts.kode_pt, pts.perguruan_tinggi, userpts.status')
            ->join('pts', 'pts.id = pencairans.id_pt')
            ->join('userpts', 'userpts.id_pt = pts.id', 'left')
            ->where('pencairans.id_pt', $pt)
            ->distinct();

        // Logika Search
        if ($keyword) {
            $query->groupStart()
                ->like('pts.perguruan_tinggi', $keyword)
                ->orLike('pts.kode_pt', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'   => 'Laporan Perguruan Tinggi',
            'keyword' => $keyword,
            // Diubah dari 12 menjadi 6 agar sesuai dengan keinginan Anda
            'pts'     => $query->orderBy('pts.kode_pt', 'ASC')->paginate(6, 'default'),
            'pager'   => $model->pager,
        ];

        return view('admin/laporan/home', $data);
    }

    public function laporan()
    {
        $model = new \App\Models\PencairanModel();

        // Ambil tahun dari GET atau default ke tahun sekarang
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $builder = $model
            ->select('pencairans.*, pts.kode_pt, pts.perguruan_tinggi')
            ->join('pts', 'pts.id = pencairans.id_pt', 'left')
            ->where("YEAR(pencairans.tanggal_entry)", $tahun);

        $data = [
            'title' => 'Semua Laporan Pencairan',
            'pencairans' => $builder->orderBy('pencairans.id', 'DESC')->findAll(),
            'tahun_terpilih' => $tahun,
        ];

        return view('admin/laporan/list', $data);
    }

    public function laporanByPt($id_pt)
    {
        $model = new \App\Models\PencairanModel();
        $tahun = $this->request->getGet('tahun');

        // Gunakan model langsung untuk inisiasi query agar paginate() bekerja maksimal
        $model->select('pencairans.*, pts.kode_pt, pts.perguruan_tinggi')
            ->join('pts', 'pts.id = pencairans.id_pt', 'left')
            ->where('pencairans.id_pt', $id_pt);

        if ($tahun) {
            $model->where("YEAR(pencairans.tanggal_entry)", $tahun);
        }

        $data = [
            'title'          => 'Laporan Pencairan PT',
            // Menggunakan paginate(10) untuk melimit 10 data per halaman
            'pencairans'     => $model->orderBy('pencairans.id', 'DESC')->paginate(10, 'default'),
            // Mengambil objek pager untuk dikirim ke view
            'pager'          => $model->pager,
            'tahun_terpilih' => $tahun,
        ];

        return view('admin/laporan/list_by_pt', $data);
    }

    public function edit($id)
    {
        $model = new PencairanModel();
        $periode = new PeriodeModel();
        $data = [
            'title' => 'Permohonan Pencairan',
            'data' => $model->find($id),
            'periode' => $periode->periode(),
        ];
        return view('admin/verifikasi_edit', $data);
    }

    public function draft()
    {
        $pt = session()->get('pt');
        $pencairanModel = new \App\Models\PencairanModel();
        
        // AUTO-DELETE: Hapus draft kosong (0 mahasiswa) yang lebih dari 14 hari
        $cutoffDate = date('Y-m-d', strtotime('-14 days'));
        $pencairanModel
            ->where('id_pt', $pt)
            ->where('jumlah_mahasiswa', 0)
            ->where('tanggal_entry <', $cutoffDate)
            ->whereIn('status', ['Ajukan Mahasiswa', 'Finalisasi'])
            ->delete();

        $data = [
            'title' => 'Draft Permohonan Pencairan',
            // Menggunakan paginate(10) untuk limit 10 data per halaman
            'draft' => $pencairanModel
                ->where('id_pt', $pt)
                ->where('status !=', 'Selesai')  // Saring agar 'Selesai' tidak muncul
                ->where('status !=', 'Diproses') // Saring agar 'Diproses' juga tidak muncul
                ->orderBy('id', 'DESC')
                ->paginate(10, 'default'),
            'pager' => $pencairanModel->pager,
            // Hitung jumlah draft kosong untuk tombol
            'emptyDraftCount' => $pencairanModel
                ->where('id_pt', $pt)
                ->where('jumlah_mahasiswa', 0)
                ->whereIn('status', ['Ajukan Mahasiswa', 'Finalisasi'])
                ->countAllResults(),
        ];

        return view('admin/pencairan_draft', $data);
    }
    
    /**
     * Hapus semua draft kosong (0 mahasiswa)
     */
    public function deleteEmptyDrafts()
    {
        $pt = session()->get('pt');
        $pencairanModel = new \App\Models\PencairanModel();
        
        $deleted = $pencairanModel
            ->where('id_pt', $pt)
            ->where('jumlah_mahasiswa', 0)
            ->whereIn('status', ['Ajukan Mahasiswa', 'Finalisasi'])
            ->delete();
        
        return redirect()->to('admin/pencairan/draft')->with('success', 'Draft kosong berhasil dihapus.');
    }

    public function update($id)
    {
        $model = new PencairanModel();
        $dataLama = $model->find($id);

        $folder = 'file/';
        $maxSize = 2097152; // 2MB

        // === SPTJM ===
        $deleteSptjm = $this->request->getPost('delete_sptjm');
        $sptjm = $this->request->getFile('sptjm');
        if ($sptjm && $sptjm->isValid() && !$sptjm->hasMoved()) {
            if ($sptjm->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file SPTJM melebihi 2MB.');
            }
            if (!empty($dataLama['sptjm']) && file_exists($folder . $dataLama['sptjm'])) {
                unlink($folder . $dataLama['sptjm']);
            }
            $newsptjm = $sptjm->getRandomName();
            $sptjm->move($folder, $newsptjm);
        } else {
            // Check if explicitly deleted
            if ($deleteSptjm == '1') {
                if (!empty($dataLama['sptjm']) && file_exists($folder . $dataLama['sptjm'])) {
                    unlink($folder . $dataLama['sptjm']);
                }
                $newsptjm = null;
            } else {
                $newsptjm = $dataLama['sptjm'];
            }
        }

        // === SK PENETAPAN ===
        $deleteSkPenetapan = $this->request->getPost('delete_sk_penetapan');
        $sk_penetapan = $this->request->getFile('sk_penetapan');
        if ($sk_penetapan && $sk_penetapan->isValid() && !$sk_penetapan->hasMoved()) {
            if ($sk_penetapan->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file SK Penetapan melebihi 2MB.');
            }
            if (!empty($dataLama['sk_penetapan']) && file_exists($folder . $dataLama['sk_penetapan'])) {
                unlink($folder . $dataLama['sk_penetapan']);
            }
            $newSk_penetapan = $sk_penetapan->getRandomName();
            $sk_penetapan->move($folder, $newSk_penetapan);
        } else {
            if ($deleteSkPenetapan == '1') {
                if (!empty($dataLama['sk_penetapan']) && file_exists($folder . $dataLama['sk_penetapan'])) {
                    unlink($folder . $dataLama['sk_penetapan']);
                }
                $newSk_penetapan = null;
            } else {
                $newSk_penetapan = $dataLama['sk_penetapan'];
            }
        }

        // === SK PEMBATALAN ===
        $sk_pembatalan = $this->request->getFile('sk_pembatalan');
        if ($sk_pembatalan && $sk_pembatalan->isValid() && !$sk_pembatalan->hasMoved()) {
            if ($sk_pembatalan->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file SK Pembatalan melebihi 2MB.');
            }
            if (!empty($dataLama['sk_pembatalan']) && file_exists($folder . $dataLama['sk_pembatalan'])) {
                unlink($folder . $dataLama['sk_pembatalan']);
            }
            $newSk_pembatalan = $sk_pembatalan->getRandomName();
            $sk_pembatalan->move($folder, $newSk_pembatalan);
        } else {
            $newSk_pembatalan = $dataLama['sk_pembatalan'];
        }

        // === BERITA ACARA ===
        $deleteBeritaAcara = $this->request->getPost('delete_berita_acara');
        $berita_acara = $this->request->getFile('berita_acara');
        if ($berita_acara && $berita_acara->isValid() && !$berita_acara->hasMoved()) {
            if ($berita_acara->getSize() > $maxSize) {
                return redirect()->back()->with('error', 'Ukuran file Berita Acara melebihi 2MB.');
            }
            if (!empty($dataLama['berita_acara']) && file_exists($folder . $dataLama['berita_acara'])) {
                unlink($folder . $dataLama['berita_acara']);
            }
            $newBerita_acara = $berita_acara->getRandomName();
            $berita_acara->move($folder, $newBerita_acara);
        } else {
            if ($deleteBeritaAcara == '1') {
                if (!empty($dataLama['berita_acara']) && file_exists($folder . $dataLama['berita_acara'])) {
                    unlink($folder . $dataLama['berita_acara']);
                }
                $newBerita_acara = null;
            } else {
                $newBerita_acara = $dataLama['berita_acara'];
            }
        }

        // Fix Logic Periode Update
        $semesterInput = $this->request->getPost('semester');
        $periodeFixed = 'Semester ' . $semesterInput;

        // === VALIDATION ===
        // Check if mandatory fields/files are empty
        if (empty($newsptjm) || empty($newSk_penetapan) || empty($newBerita_acara) || 
            empty($this->request->getPost('no_surat_permohonan')) || empty($this->request->getPost('tanggal'))) {
            
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi semua data dan berkas wajib (SPTJM, SK Penetapan, Berita Acara, No. SK, Tanggal) sebelum melanjutkan.');
        }

        // Simpan ke database
        $model->update($id, [
            'id_pt' => $this->request->getPost('id_pt'), // Pastikan ID PT tetap/terupdate jika perlu
            'periode' => $periodeFixed, // Use fixed periode
            'kategori_penerima' => $this->request->getPost('kategori_penerima'),
            'no_sk' => $this->request->getPost('no_surat_permohonan'),
            'tanggal' => $this->request->getPost('tanggal'), // Ambil dari input form
            'semester' => $semesterInput,
            'sptjm' => $newsptjm,
            'sk_penetapan' => $newSk_penetapan,
            'sk_pembatalan' => $newSk_pembatalan,
            'berita_acara' => $newBerita_acara,
        ]);

        // LOGGING
        (new LogModel())->log('update', 'pencairan', 'Memperbarui data verifikasi pengajuan ID: ' . $id);

        return redirect()->to('verifikasi-mahasiswa/' . $id);
    }

    public function verifikasi_mahasiswa($id)
    {
        $pt = session()->get('pt');
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $prodiModel = new \App\Models\ProdiModel();

        // Ambil filter dari request
        $keyword = $this->request->getGet('keyword');
        $filterProdi = $this->request->getGet('filter_prodi');
        $filterAngkatan = $this->request->getGet('filter_angkatan');
        $filterKategori = $this->request->getGet('filter_kategori');

        // Ambil jumlah entries per halaman, default 10
        $entries = $this->request->getGet('entries') ?? 10;
        $validEntries = [10, 25, 50, 100];
        if (!in_array($entries, $validEntries)) {
            $entries = 10;
        }

        // Fetch Pencairan Data to get Category
        $pencairanModel = new \App\Models\PencairanModel();
        $pencairan = $pencairanModel->find($id);
        
        // Enforce Category Filter based on Pencairan record
        if (!empty($pencairan['kategori_penerima'])) {
            $filterKategori = $pencairan['kategori_penerima'];
        }

        // Prepare filters for model
        $filters = [
            'keyword' => $keyword,
            'filter_prodi' => $filterProdi,
            'filter_angkatan' => $filterAngkatan,
            'filter_kategori' => $filterKategori, // Now enforced
            'entries' => $entries
        ];

        // Fetch data
        $listMahasiswa = $mahasiswaModel->universitas($pt, $id, $filters);

        // Data for Dropdowns
        $listProdi = $prodiModel->where('id_pt', $pt)->findAll();
        
        $db = \Config\Database::connect();
        $listAngkatan = $db->table('mahasiswas')
                            ->select('angkatan')
                            ->distinct()
                            ->where('id_pt', $pt)
                            ->orderBy('angkatan', 'DESC')
                            ->get()
                            ->getResultArray();



        $data = [
            'title'           => 'Ajukan Mahasiswa',
            'id_pencairan'    => $id,
            'mahasiswa'       => $listMahasiswa,
            'pager'           => $mahasiswaModel->pager,
            'keyword'         => $keyword,
            'filter_prodi'    => $filterProdi,
            'filter_angkatan' => $filterAngkatan,
            'filter_kategori' => $filterKategori,
            'list_prodi'      => $listProdi,
            'list_angtakan'   => $listAngkatan,
            'entries'         => $entries
        ];

        return view('admin/verifikasi_2', $data);
    }

    public function sync_mahasiswa()
    {
        $json = $this->request->getJSON();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();

        $ids = $json->selected_ids;
        $idPencairan = $json->id_pencairan;
        $isChecked = $json->checked;

        if (!empty($ids)) {
            if ($isChecked) {
                // Insert/Update menjadi 'Proses Pengajuan'
                foreach ($ids as $id_mahasiswa) {
                    // Gunakan replace atau insert ignore handling di model/query manual
                    // Tapi karena CodeIgniter model save() cek primary key, kita pakai logic manual
                    
                    // Cek existency
                    $exist = $pengajuanModel->where('id_mahasiswa', $id_mahasiswa)
                                          ->where('id_pencairan', $idPencairan)
                                          ->first();
                    
                    if ($exist) {
                        $pengajuanModel->update($exist['id'], [
                            'status_pengajuan' => 'Proses Pengajuan'
                        ]);
                    } else {
                        $pengajuanModel->insert([
                            'id_mahasiswa' => $id_mahasiswa,
                            'id_pencairan' => $idPencairan,
                            'status_pengajuan' => 'Proses Pengajuan',
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            } else {
                // Hapus dari pengajuan_mahasiswa
                $pengajuanModel->whereIn('id_mahasiswa', $ids)
                               ->where('id_pencairan', $idPencairan)
                               ->delete();
            }
        }

        return $this->response->setJSON(['success' => true]);
    }

    public function ajukanMahasiswa()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getJSON();
            $selected = $data->selected ?? [];
            $all = $data->all ?? [];
            $idPencairan = $data->id_pencairan ?? null;

            if (!$idPencairan) {
                return $this->response->setJSON(['success' => false, 'message' => 'ID Pencairan tidak ditemukan.']);
            }

            $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();
            $pencairanModel = new \App\Models\PencairanModel();
            $db = \Config\Database::connect();
            
            // Ambil info periode pencairan ini
            $pencairan = $pencairanModel->find($idPencairan);
            $semester = $pencairan['semester'];
            $periode = $pencairan['periode'];

            $db->transStart();

            // 1. Validasi Ganda: Cek apakah mahasiswa ini sudah Diajukan (Final) di pencairan LAIN pada periode yang SAMA
            if (!empty($selected)) {
                foreach ($selected as $mhsId) {
                    if ($pengajuanModel->isFinalInSamePeriode($mhsId, $semester, $periode, $idPencairan)) {
                        $db->transRollback();
                        return $this->response->setJSON(['success' => false, 'message' => 'Salah satu mahasiswa sudah terdaftar di pengajuan Final pada periode ini.']);
                    }
                }
            }

            // 2. Reset status mahasiswa yang batal dicentang (Hapus dari tabel pengajuan)
            if (!empty($all)) {
                $notSelected = array_diff($all, $selected);
                if (!empty($notSelected)) {
                    $pengajuanModel->whereIn('id_mahasiswa', $notSelected)
                        ->where('id_pencairan', $idPencairan)
                        ->delete();
                }
            }

            // 3. Update mahasiswa yang terpilih (Insert/Update)
            if (!empty($selected)) {
                foreach ($selected as $mhsId) {
                    $exist = $pengajuanModel->where('id_mahasiswa', $mhsId)
                                          ->where('id_pencairan', $idPencairan)
                                          ->first();
                    if ($exist) {
                        $pengajuanModel->update($exist['id'], ['status_pengajuan' => 'Proses Pengajuan']);
                    } else {
                        $pengajuanModel->insert([
                            'id_mahasiswa' => $mhsId,
                            'id_pencairan' => $idPencairan,
                            'status_pengajuan' => 'Proses Pengajuan',
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }

            // 4 & 5. Hitung ulang dan Update Tabel Pencairan
            $jumlahRiil = $pengajuanModel->where('id_pencairan', $idPencairan)->countAllResults();
            $pencairanModel->update($idPencairan, [
                'status' => 'Finalisasi',
                'jumlah_mahasiswa' => $jumlahRiil
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui database.']);
            }

            return $this->response->setJSON([
                'success' => true,
                'redirect' => base_url('finalisasi-verifikasi/' . $idPencairan),
            ]);
        }
    }

    public function finalisasi_verifikasi($id)
    {
        $mahasiswaModel = new MahasiswaModel();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel(); // Use new model for count
        $prodiModel = new \App\Models\ProdiModel();
        $db = \Config\Database::connect();

        // Ambil ID PT dari session
        $ptId = session()->get('pt');

        // Ambil filter dari input search
        $keyword = $this->request->getVar('keyword');
        $filterProdi = $this->request->getVar('filter_prodi');
        $filterAngkatan = $this->request->getVar('filter_angkatan');
        $filterKategori = $this->request->getVar('filter_kategori');
        $entries = $this->request->getVar('entries') ?? 10;

        // Validasi entries
        if (!in_array($entries, [10, 25, 50, 100])) {
            $entries = 10;
        }

        $pt = $db->table('pts')
            ->where('id', $ptId)
            ->get()
            ->getRowArray();

        // Hitung dari tabel pengajuan_mahasiswa (Total keseluruhan di batch ini)
        $jumlahTotal = $pengajuanModel->where('id_pencairan', $id)->countAllResults();

        // Filters Array
        $filters = [
            'keyword' => $keyword,
            'filter_prodi' => $filterProdi,
            'filter_angkatan' => $filterAngkatan,
            'filter_kategori' => $filterKategori,
            'entries' => $entries
        ];

        // Retrieve Data Lists for Dropdowns (Sama seperti step 2)
        $listProdi = $prodiModel->where('id_pt', $ptId)->findAll();
        
        $listAngkatan = $db->table('mahasiswas')
                            ->select('angkatan')
                            ->distinct()
                            ->where('id_pt', $ptId)
                            ->orderBy('angkatan', 'DESC')
                            ->get()
                            ->getResultArray();

        $listKategori = $db->table('mahasiswas')
                            ->select('kategori')
                            ->distinct()
                            ->where('id_pt', $ptId)
                            ->where('kategori !=', '')
                            ->where('kategori IS NOT NULL')
                            ->orderBy('kategori', 'ASC')
                            ->get()
                            ->getResultArray();

        $data = [
            'mahasiswa'       => $mahasiswaModel->verifikasi($id, $filters),
            'title'           => 'Finalisasi Verifikasi',
            'id_pencairan'    => $id,
            'pager'           => $mahasiswaModel->pager,
            'jumlah'          => $jumlahTotal,
            'pt'              => $pt,
            'keyword'         => $keyword,
            'filter_prodi'    => $filterProdi,
            'filter_angkatan' => $filterAngkatan,
            'filter_kategori' => $filterKategori,
            'entries'         => $entries,
            'list_prodi'      => $listProdi,
            'list_angkatan'   => $listAngkatan,
            'list_kategori'   => $listKategori
        ];

        return view('admin/verifikasi_3', $data);
    }

    public function verifikasi_final($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        $pencairanModel = new \App\Models\PencairanModel();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();

        // Hitung ulang dari tabel pengajuan
        $jumlah = $pengajuanModel->where('id_pencairan', $id)->countAllResults();

        if ($jumlah <= 0) {
            return redirect()->back()->with('error', 'Gagal: Jumlah mahasiswa 0. Silakan pilih mahasiswa kembali.');
        }

        // Update status mahasiswa secara massal di tabel pengajuan_mahasiswa
        $pengajuanModel->where('id_pencairan', $id)
            ->set(['status_pengajuan' => 'Diajukan'])
            ->update();

        // Finalisasi status pencairan
        $pencairanModel->update($id, [
            'status' => 'Diproses',
            'jumlah_mahasiswa' => $jumlah
        ]);

        // LOGGING
        (new LogModel())->log('approve', 'pencairan', 'Menyelesaikan verifikasi pengajuan ID: ' . $id . '. Jumlah Mahasiswa: ' . $jumlah);

        $db->transComplete();

        return redirect()->to('verifikasi-pembaharuan-status')->with('success', 'Berhasil diajukan ke pusat.');
    }

    public function delete($id)
    {
        $model = new PencairanModel();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();
        $db = \Config\Database::connect();

        // 1. Ambil data pencairan untuk menghapus file fisik
        $data = $model->find($id);

        if ($data) {
            $db->transStart(); // Gunakan transaksi aga reset & hapus sinkron

            // 2. HAPUS RELASI MAHASISWA (Delete dari tabel pengajuan_mahasiswa)
            $pengajuanModel->where('id_pencairan', $id)->delete();

            // 3. HAPUS FILE FISIK
            $folder = 'file/';
            $fields = ['sptjm', 'sk_penetapan', 'sk_pembatalan', 'berita_acara'];

            foreach ($fields as $field) {
                if (!empty($data[$field]) && file_exists($folder . $data[$field])) {
                    unlink($folder . $data[$field]);
                }
            }

            // 4. HAPUS DATA PENCAIRAN DARI DATABASE
            $model->delete($id);

            // LOGGING
            (new LogModel())->log('delete', 'pencairan', 'Membatalkan/Menghapus pengajuan ID: ' . $id . ' dari ' . ($data['id_pt'] ?? 'unknown'));

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal menghapus draft dan mereset data mahasiswa.');
            }
        }

        return redirect()->to('verifikasi-pembaharuan-status')->with('success', 'Draft dihapus dan mahasiswa dikembalikan ke daftar.');
    }

    public function export_mahasiswa($id)
    {
        $model = new MahasiswaModel();
        $data = $model->pencairan($id);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'KODE PTS');
        $sheet->setCellValue('C1', 'PTS');
        $sheet->setCellValue('D1', 'NIM');
        $sheet->setCellValue('E1', 'NAMA');
        $sheet->setCellValue('F1', 'KODE PRODI');
        $sheet->setCellValue('G1', 'NAMA PRODI');
        $sheet->setCellValue('H1', 'JENJANG');
        $sheet->setCellValue('I1', 'ANGKATAN');
        $sheet->setCellValue('J1', 'PEMBARUAN STATUS');
        $row = 2;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['kode_pt']);
            $sheet->setCellValue('C' . $row, $item['perguruan_tinggi']);
            $sheet->setCellValue('D' . $row, $item['nim']);
            $sheet->setCellValue('E' . $row, $item['nama']);
            $sheet->setCellValue('F' . $row, $item['kode_prodi']);
            $sheet->setCellValue('G' . $row, $item['nama_prodi']);
            $sheet->setCellValue('H' . $row, $item['jenjang']);
            $sheet->setCellValue('I' . $row, $item['angkatan']);
            $sheet->setCellValue('J' . $row, $item['pembaruan_status']);
            $row++;
            $no++;
        }

        $filename = 'data_mahasiswa.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function detail($id)
    {
        $model = new PencairanModel();
        $data = $model->find($id);
        $idPt = $data['id_pt']; // Ambil ID PT dari data pencairan

        // Tangkap keyword dan filter dari query string
        $keyword = $this->request->getGet('keyword');
        $filterProdi = $this->request->getGet('filter_prodi');
        $filterAngkatan = $this->request->getGet('filter_angkatan');

        // Entries
        $entries = $this->request->getGet('entries') ?? 10;
        $validEntries = [10, 25, 50, 100];
        if (!in_array($entries, $validEntries)) {
            $entries = 10;
        }

        $mahasiswaModel = new MahasiswaModel();
        $prodiModel = new \App\Models\ProdiModel(); // Load ProdiModel

        // Data for Dropdowns
        $listProdi = $prodiModel->where('id_pt', $idPt)->findAll();
        
        $db = \Config\Database::connect();
        $listAngkatan = $db->table('mahasiswas')
                            ->select('angkatan')
                            ->distinct()
                            ->where('id_pt', $idPt)
                            ->orderBy('angkatan', 'DESC')
                            ->get()
                            ->getResultArray();

        $dataView = [
            'data'            => $data,
            'title'           => 'Detail Pencairan',
            'keyword'         => $keyword,
            'filter_prodi'    => $filterProdi,
            'filter_angkatan' => $filterAngkatan,
            'entries'         => $entries,
            'list_prodi'      => $listProdi,
            'list_angkatan'   => $listAngkatan,
            // Kirim keyword dan filter ke method pencairan di model
            'mahasiswa' => $mahasiswaModel->pencairan($id, $keyword, $filterProdi, $filterAngkatan, $entries),
            'pager'     => $mahasiswaModel->pager,
            // Hitung jumlah dengan filter (opsional, tapi countAllResults biasanya mengabaikan filter yg di apply di method lain kecuali di chain)
            // Untuk simplisitas, kita gunakan countAllResults dengan filter manual atau biarkan total rows dari pager jika memungkinkan.
            // Namun, countAllResults() tanpa where akan menghitung SEMUA di tabel jika tidak hati-hati.
            // Kita gunakan logic count yang sama dengan query pencairan() tapi countAllResults()
            // ATAU: Kita ambil total dari Pager yang sudah otomatis menghitungnya.
            'jumlah'    => $mahasiswaModel->pager->getTotal('default') 
        ];
        
        // Note: $mahasiswaModel->pager->getTotal() only works AFTER paginate() is called.
        // Since we called pencairan() which calls paginate(), it should be available.
        // Fallback or explicit count:
        // $dataView['jumlah'] = $mahasiswaModel->where('id_pencairan', $id)->countAllResults(); // Ini hitung total TANPA filter
         
        return view('admin/verifikasi_detail', $dataView);
    }
    public function ditolak($id)
    {
        $id = (int)$id; // Ensure ID is integer
        $model = new PencairanModel();
        $mahasiswaModel = new MahasiswaModel();
        $db = \Config\Database::connect();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Tangkap alasan dari form
        $alasan = $this->request->getPost('alasan');

        if ($data['status'] === 'Diproses') {
            $db->transStart();

            // 1. Update mahasiswa yang terkait: reset status dan hapus id_pencairan
            // Sehingga bisa diajukan kembali di periode berikutnya
            $mahasiswaModel->where('id_pencairan', $id)
                ->set([
                    'status_pengajuan' => 'Belum Diajukan',
                    'id_pencairan'     => null,
                ])
                ->update();

            // 2. Update status pencairan dan simpan alasan
            $model->update($id, [
                'status'       => 'Ditolak',
                'alasan_tolak' => $alasan
            ]);
            
            // LOGGING
            (new LogModel())->log('reject', 'pencairan', 'Menolak pengajuan ID: ' . $id . '. Alasan: ' . $alasan);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal memproses penolakan.');
            }

            return redirect()->back()->with('success', 'Status berhasil diubah menjadi Ditolak. Mahasiswa dikembalikan ke status Belum Diajukan.');
        }

        return redirect()->back()->with('warning', 'Status tidak dapat diubah.');
    }

    /**
     * API endpoint untuk mendapatkan riwayat pengajuan mahasiswa
     */
    public function riwayatMahasiswa($id_mahasiswa)
    {
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();
        $mahasiswaModel = new MahasiswaModel();

        $mahasiswa = $mahasiswaModel->find($id_mahasiswa);

        if (!$mahasiswa) {
            return $this->response->setJSON(['success' => false, 'message' => 'Mahasiswa tidak ditemukan']);
        }

        $riwayat = $pengajuanModel->getHistoryWithPeriode($id_mahasiswa);

        return $this->response->setJSON([
            'success' => true,
            'mahasiswa' => [
                'nim' => $mahasiswa['nim'],
                'nama' => $mahasiswa['nama']
            ],
            'riwayat' => $riwayat
        ]);
    }
}
