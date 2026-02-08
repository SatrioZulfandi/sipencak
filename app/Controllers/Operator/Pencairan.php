<?php

namespace App\Controllers\Operator;

use App\Models\PeriodeModel;
use App\Models\MahasiswaModel;
use App\Models\PencairanModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Pencairan extends BaseController
{
    public function index()
    {
        $model = new \App\Models\PencairanModel();
        $periode = new \App\Models\PeriodeModel();
        $ptModel = new \App\Models\PtModel();

        // Ambil input filter dan search dari GET
        $tahun = $this->request->getGet('tahun');
        $pt = $this->request->getGet('pt');
        $search = $this->request->getGet('search');

        /**
         * Menggunakan historiPager dari model yang menangani:
         * 1. Pagination (Limit 6 sesuai preferensi user_context)
         * 2. Filter Tahun (dari kolom tanggal_entry)
         * 3. Filter Perguruan Tinggi (berdasarkan ID PT)
         * 4. Search Box (berdasarkan Nama PT atau No SK)
         */
        $histori = $model->historiPager(6, $tahun, $pt, $search);

        // Ambil daftar seluruh Perguruan Tinggi untuk dropdown filter
        $daftar_pt = $ptModel->orderBy('perguruan_tinggi', 'ASC')->findAll();

        // Kirim data ke view
        $data = [
            'draft'         => $model->draft(),
            'histori'       => $histori,
            'pager'         => $model->pager,
            'title'         => 'Verifikasi Pembaharuan Status',
            'periode'       => $periode->periode(),
            'filter_tahun'  => $tahun,
            'filter_pt'     => $pt,
            'search'        => $search,
            'daftar_pt'     => $daftar_pt
        ];

        return view('operator/pencairan_list', $data);
    }

    public function detail($id)
    {
        $model = new \App\Models\PencairanModel();
        $mahasiswaModel = new \App\Models\MahasiswaModel();

        $search = $this->request->getGet('search');

        $data = $model->detail($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // PERBAIKAN: Join ke tabel pengajuan_mahasiswa
        $builder = $mahasiswaModel
            ->select('mahasiswas.*, prodis.nama_prodi, prodis.kode_prodi, pengajuan_mahasiswa.status_pengajuan')
            ->join('pengajuan_mahasiswa', 'pengajuan_mahasiswa.id_mahasiswa = mahasiswas.id')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi', 'left')
            ->where('pengajuan_mahasiswa.id_pencairan', $id);

        if ($search) {
            $builder->groupStart()
                ->like('mahasiswas.nama', $search)
                ->orLike('mahasiswas.nim', $search)
                ->groupEnd();
        }

        $dataMahasiswa = $builder->paginate(6, 'default');

        return view('operator/pencairan_detail', [
            'data'      => $data,
            'title'     => 'Detail Pencairan',
            'mahasiswa' => $dataMahasiswa,
            'pager'     => $mahasiswaModel->pager,
            'search'    => $search,
            'id'        => $id
        ]);
    }

    public function markSelesai($id)
    {
        $model = new \App\Models\PencairanModel();
        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        if ($data['status'] === 'Diproses') {
            $model->update($id, ['status' => 'Selesai']);
            // dd($model->find($id)); // cek apakah berhasil
            return redirect()->back()->with('success', 'Status berhasil diubah menjadi Selesai.');
        }

        return redirect()->back()->with('warning', 'Status tidak dapat diubah.');
    }

    public function laporan()
    {
        $model = new \App\Models\PencairanModel();
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search');

        $builder = $model
            ->select('pencairans.*, pts.kode_pt, pts.perguruan_tinggi')
            ->join('pts', 'pts.id = pencairans.id_pt', 'left')
            ->where("YEAR(pencairans.tanggal_entry)", $tahun);

        if ($search) {
            $builder->groupStart()
                ->like('pts.perguruan_tinggi', $search)
                ->orLike('pts.kode_pt', $search)
                ->groupEnd();
        }

        $data = [
            'title'          => 'Laporan Pencairan',
            'pencairans'     => $builder->orderBy('pencairans.id', 'DESC')->paginate(6, 'default'),
            'pager'          => $model->pager,
            'tahun_terpilih' => $tahun,
            'search'         => $search
        ];

        return view('operator/laporan/index', $data);
    }

    public function laporanHome()
    {
        $model = new \App\Models\PencairanModel();
        $search = $this->request->getGet('search');

        $builder = $model
            ->select('pts.id, pts.kode_pt, pts.perguruan_tinggi, userpts.status')
            ->join('pts', 'pts.id = pencairans.id_pt')
            ->join('userpts', 'userpts.id_pt = pts.id', 'left')
            ->distinct();

        if ($search) {
            $builder->groupStart()
                ->like('pts.perguruan_tinggi', $search)
                ->orLike('pts.kode_pt', $search)
                ->groupEnd();
        }

        $data = [
            'title'  => 'Laporan Perguruan Tinggi',
            'pts'    => $builder->orderBy('pts.kode_pt', 'ASC')->paginate(10, 'default'),
            'pager'  => $model->pager,
            'search' => $search
        ];

        return view('operator/laporan_home', $data);
    }

    public function laporanByPt($id_pt)
    {
        $model = new \App\Models\PencairanModel();
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search');

        $builder = $model
            ->select('pencairans.*, pts.kode_pt, pts.perguruan_tinggi')
            ->join('pts', 'pts.id = pencairans.id_pt', 'left')
            ->where('pencairans.id_pt', $id_pt)
            ->where("YEAR(pencairans.tanggal_entry)", $tahun);

        if ($search) {
            $builder->groupStart()
                ->like('pencairans.semester', $search)
                ->orLike('pencairans.kategori_penerima', $search)
                ->groupEnd();
        }

        $data = [
            'title'          => 'Laporan Pencairan',
            'pencairans'     => $builder->orderBy('pencairans.id', 'DESC')->paginate(6, 'default'),
            'pager'          => $model->pager,
            'tahun_terpilih' => $tahun,
            'search'         => $search,
            'id_pt'          => $id_pt
        ];

        return view('operator/laporan/index', $data);
    }

    public function unduhLaporan()
    {
        $model = new PencairanModel();

        // Ambil histori lalu filter hanya status Selesai
        $histori = array_filter($model->histori(), function ($item) {
            return strtolower($item['status']) === 'selesai';
        });

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $header = [
            'A1' => 'Kode PT',
            'B1' => 'Perguruan Tinggi',
            'C1' => 'Periode',
            'D1' => 'Tanggal Pengajuan',
            'E1' => 'Kategori',
            'F1' => 'Jumlah Mahasiswa',
            'G1' => 'Status'
        ];

        foreach ($header as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Isi Data
        $row = 2;
        foreach ($histori as $item) {
            $periode = $item['semester'] . ' / ' . date('Y', strtotime($item['tanggal_entry']));
            $tanggal = date('d-m-Y', strtotime($item['tanggal_entry']));

            $sheet->setCellValue("A{$row}", $item['kode_pt']);
            $sheet->setCellValue("B{$row}", $item['perguruan_tinggi']);
            $sheet->setCellValue("C{$row}", $periode);
            $sheet->setCellValue("D{$row}", $tanggal);
            $sheet->setCellValue("E{$row}", $item['kategori_penerima']);
            $sheet->setCellValue("F{$row}", $item['jumlah_mahasiswa']);
            $sheet->setCellValue("G{$row}", $item['status']);
            $row++;
        }

        $lastRow = $row - 1;

        // Style border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle("A1:G{$lastRow}")->applyFromArray($styleArray);

        // Auto-size kolom
        foreach (range('A', 'G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Nama file
        $filename = 'laporan_pencairan_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function unduhExcel()
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();

        // Ambil data mahasiswa dengan pencairan status 'Selesai'
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

        // Header kolom
        $headers = [
            'A1' => 'NIM',
            'B1' => 'Nama',
            'C1' => 'Program Studi',
            'D1' => 'Kode Prodi',
            'E1' => 'Perguruan Tinggi',
            'F1' => 'Jenjang',
            'G1' => 'Angkatan',
            'H1' => 'Pembaruan Status',
            'I1' => 'Status Pengajuan'
        ];

        foreach ($headers as $cell => $label) {
            $sheet->setCellValue($cell, $label);
        }

        // Isi data
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

        // Tambahkan border untuk semua data + header
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle("A1:I{$lastRow}")->applyFromArray($styleArray);

        // Auto-size semua kolom
        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Nama file
        $filename = 'mahasiswa_selesai_' . date('Ymd_His') . '.xlsx';

        // Output untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function unduhMahasiswa($id_pencairan)
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();
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
        $headers = [
            'A1' => 'NIM',
            'B1' => 'Nama',
            'C1' => 'Program Studi',
            'D1' => 'Jenjang',
            'E1' => 'Angkatan',
            'F1' => 'Pembaruan Status'
        ];

        foreach ($headers as $cell => $label) {
            $sheet->setCellValue($cell, $label);
        }

        // Isi data
        $row = 2;
        foreach ($mahasiswaList as $mhs) {
            $sheet->setCellValue("A$row", $mhs['nim']);
            $sheet->setCellValue("B$row", $mhs['nama']);
            $sheet->setCellValue("C$row", $mhs['nama_prodi'] ?? '-');
            $sheet->setCellValue("D$row", $mhs['jenjang']);
            $sheet->setCellValue("E$row", $mhs['angkatan']);
            $sheet->setCellValue("F$row", $mhs['pembaruan_status']);
            $row++;
        }

        $lastRow = $row - 1;

        // Tambahkan border & alignment ke seluruh sel yang terisi
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_LEFT,
            ],
        ];
        $sheet->getStyle("A1:F{$lastRow}")->applyFromArray($styleArray);

        // Auto-size kolom agar konten tidak terpotong
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Nama file
        $filename = 'mahasiswa_pencairan_' . $id_pencairan . '_' . date('Ymd_His') . '.xlsx';

        // Output file Excel untuk didownload
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function ditolak($id)
    {
        $model = new \App\Models\PencairanModel();
        $alasan = $this->request->getPost('alasan');

        $model->update($id, [
            'status' => 'Ditolak',
            'alasan_tolak' => $alasan
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil ditolak dengan alasan.');
    }

    public function markDitolak($id)
    {
        $model = new \App\Models\PencairanModel();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();

        $data = $model->find($id);

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Tangkap alasan dari form
        $alasan = $this->request->getPost('alasan');

        if ($data['status'] === 'Diproses') {
            // Update mahasiswa yang terkait: HAPUS dari tabel pengajuan agar bisa diajukan ulang
            $pengajuanModel->where('id_pencairan', $id)->delete();

            // Update status pencairan dan simpan alasan
            $updateData = [
                'status' => 'Ditolak',
                'alasan_tolak' => $alasan
            ];

            $model->update($id, $updateData);

            return redirect()->back()->with('success', 'Status berhasil diubah menjadi Ditolak. Mahasiswa dikembalikan ke status Belum Diajukan.');
        }

        return redirect()->back()->with('warning', 'Status tidak dapat diubah.');
    }

    public function revisi($id)
    {
        $model = new \App\Models\PencairanModel();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();
        
        $data = $model->find($id);

        if ($data && $data['status'] === 'Diproses') {
            // Ubah status pencairan jadi Draft
            $model->update($id, ['status' => 'Draft']);
            
            // Ubah status pengajuan mahasiswa jadi 'Proses Pengajuan' agar bisa diedit
            $pengajuanModel->where('id_pencairan', $id)
                           ->set(['status_pengajuan' => 'Proses Pengajuan'])
                           ->update();
            
            return redirect()->to('pencairan-list')->with('success', 'Pengajuan dikembalikan ke Draft. Silakan edit.');
        }

        return redirect()->back()->with('error', 'Tidak dapat mengedit pengajuan ini.');
    }

    public function batalkan($id)
    {
        $model = new \App\Models\PencairanModel();
        $pengajuanModel = new \App\Models\PengajuanMahasiswaModel();
        
        $data = $model->find($id);

        if ($data && $data['status'] === 'Diproses') {
            // Lepaskan mahasiswa (Hapus dari tabel pengajuan)
            $pengajuanModel->where('id_pencairan', $id)->delete();
            
            // Update status ke Ditolak (sesuai req user: Batalkan = Tolak/Hapus)
            // Atau jika "Cancel" berarti hapus data pencairannya juga?
            // Existing code: update status to Ditolak.
            $model->update($id, [
                'status' => 'Ditolak',
                'alasan_tolak' => 'Dibatalkan oleh Operator'
            ]);

            // LOGGING
            (new \App\Models\LogModel())->log('cancel', 'pencairan', 'Operator membatalkan pengajuan ID: ' . $id);

            return redirect()->to('pencairan-list')->with('success', 'Pengajuan berhasil dibatalkan. Status diubah menjadi Ditolak.');
        }

        return redirect()->back()->with('error', 'Tidak dapat membatalkan pengajuan ini.');
    }
}
