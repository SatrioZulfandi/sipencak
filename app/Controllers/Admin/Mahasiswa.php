<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ProdiModel;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    public function index()
    {
        $model = new MahasiswaModel();
        $prodiModel = new ProdiModel();
        $idPt = session()->get('pt');

        // Ambil input filter
        $keyword = $this->request->getGet('keyword');
        $filterProdi = $this->request->getGet('filter_prodi');
        $filterAngkatan = $this->request->getGet('filter_angkatan');

        // Base Query
        $model->select('mahasiswas.*, prodis.nama_prodi')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi', 'left')
            ->where('mahasiswas.id_pt', $idPt);

        // Filter Logic
        if ($keyword) {
            $model->groupStart()
                ->like('mahasiswas.nim', $keyword)
                ->orLike('mahasiswas.nama', $keyword)
                ->orLike('prodis.nama_prodi', $keyword)
                ->groupEnd();
        }

        if ($filterProdi) {
            $model->where('mahasiswas.id_prodi', $filterProdi);
        }

        if ($filterAngkatan) {
            $model->where('mahasiswas.angkatan', $filterAngkatan);
        }

        // Data for Dropdowns
        $listProdi = $prodiModel->where('id_pt', $idPt)->findAll();
        // $listAngkatan = $model->findDistinctAngkatanByPt($idPt); // REMOVED: Causing BadMethodCallException

        // Use direct builder for distinct angkatan to avoid model complexity
        $db = \Config\Database::connect();
        $queryAngkatan = $db->table('mahasiswas')
                            ->select('angkatan')
                            ->distinct()
                            ->where('id_pt', $idPt)
                            ->orderBy('angkatan', 'DESC')
                            ->get()
                            ->getResultArray();

        $data = [
            'data'    => $model->paginate(10, 'default'),
            'pager'   => $model->pager,
            'title'   => 'Manajemen Mahasiswa',
            'keyword' => $keyword,
            'filter_prodi' => $filterProdi,
            'filter_angkatan' => $filterAngkatan,
            'list_prodi' => $listProdi,
            'list_angkatan' => $queryAngkatan
        ];

        return view('admin/mahasiswa_list', $data);
    }

    // --- Method create, store, edit, update tetap sama ---

    public function create()
    {
        $prodi = new ProdiModel();
        $data = [
            'btn' => 'add',
            'act' => '/mahasiswa-store',
            'sub' => 'Tambah',
            'title' => 'Tambah Mahasiswa',
            'prodi' => $prodi->Cari(session()->get('pt')),
        ];
        return view('admin/mahasiswa_form', $data);
    }

    public function store()
    {
        $model = new MahasiswaModel();
        $model->save([
            'id_pt' => $this->request->getPost('id_pt'),
            'id_prodi' => $this->request->getPost('id_prodi'),
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'jenjang' => $this->request->getPost('jenjang'),
            'angkatan' => $this->request->getPost('angkatan'),
            'kategori' => $this->request->getPost('kategori'),
            'pembaruan_status' => 'Tetap',
            'status_pengajuan' => 'Belum Diajukan',
        ]);
        return redirect()->to('mahasiswa-list');
    }

    public function edit($id)
    {
        $prodi = new ProdiModel();
        $model = new MahasiswaModel();
        $data = [
            'btn' => 'edit',
            'act' => '/mahasiswa-update/' . $id,
            'sub' => 'Edit',
            'title' => 'Edit mahasiswa',
            'data' => $model->find($id),
            'prodi' => $prodi->Cari(session()->get('pt')),
        ];
        return view('admin/mahasiswa_form', $data);
    }

    public function update($id)
    {
        $model = new MahasiswaModel();
        
        $data = [
            'id' => $id, // Penting untuk validasi is_unique NIM (exclude self)
            'id_pt' => $this->request->getPost('id_pt'),
            'id_prodi' => $this->request->getPost('id_prodi'),
            'nim' => $this->request->getPost('nim'),
            'nama' => $this->request->getPost('nama'),
            'jenjang' => $this->request->getPost('jenjang'),
            'angkatan' => $this->request->getPost('angkatan'),
            'kategori' => $this->request->getPost('kategori'),
            'pembaruan_status' => 'Tetap',
            'status_pengajuan' => 'Belum Diajukan',
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()->withInput()->with('error', 'Gagal update: ' . implode(', ', $model->errors()));
        }

        return redirect()->to('mahasiswa-list')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function show($id)
    {
        $model = new \App\Models\MahasiswaModel();

        // Sesuaikan pts.nama_pt menjadi pts.perguruan_tinggi berdasarkan PtModel Anda
        $mahasiswa = $model->select('mahasiswas.*, prodis.nama_prodi, prodis.kode_prodi, pts.perguruan_tinggi')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi', 'left')
            ->join('pts', 'pts.id = mahasiswas.id_pt', 'left')
            ->find($id);

        if (!$mahasiswa) {
            return redirect()->to('mahasiswa-list')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Mahasiswa - ' . $mahasiswa['nama'],
            'data'  => $mahasiswa,
        ];

        return view('admin/mahasiswa_show', $data);
    }

    public function import()
    {
        $file = $this->request->getFile('excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            try {
                $spreadsheet = IOFactory::load($file->getTempName());
                $sheet = $spreadsheet->getActiveSheet()->toArray();

                $mahasiswaModel = new MahasiswaModel();
                $prodiModel = new ProdiModel();
                $successCount = 0;
                $failureCount = 0;
                
                // Prepare structure for failed data report
                // Header original + Error Column
                $failedData = [];
                $header = $sheet[0] ?? ['Kode Prodi', 'NIM', 'Nama', 'Jenjang', 'Angkatan', 'Kategori'];
                $header[] = 'KETERANGAN ERROR (Perbaiki kolom ini sebelum upload ulang)';
                $failedData[] = $header;

                foreach (array_slice($sheet, 1) as $index => $row) {
                    $rowNumber = $index + 2;
                    $kodeProdi = trim($row[0] ?? '');
                    
                    if (empty($kodeProdi)) continue; 

                    $prodi = $prodiModel->where('kode_prodi', $kodeProdi)->first();
                    $errorMsg = '';

                    if ($prodi) {
                        $data = [
                            'id_pt' => session()->get('pt'),
                            'id_prodi' => $prodi['id'],
                            'nim' => trim($row[1] ?? ''),
                            'nama' => trim($row[2] ?? ''),
                            'jenjang' => trim($row[3] ?? ''),
                            'angkatan' => trim($row[4] ?? ''),
                            'kategori' => trim($row[5] ?? ''),
                            'pembaruan_status' => 'Tetap',
                            'status_pengajuan' => 'Belum Diajukan',
                        ];

                        if ($mahasiswaModel->insert($data)) {
                            $successCount++;
                        } else {
                            $failureCount++;
                            $dbErrors = $mahasiswaModel->errors();
                            $errorMsg = implode(', ', $dbErrors);
                        }
                    } else {
                        $failureCount++;
                        $errorMsg = "Kode Prodi '$kodeProdi' tidak ditemukan.";
                    }

                    // If failed, add to failedData
                    if (!empty($errorMsg)) {
                        $rowWithStatus = $row;
                        // Ensure row has enough columns if original was short
                        $rowWithStatus = array_pad($rowWithStatus, count($header) - 1, '');
                        $rowWithStatus[] = $errorMsg; // Add error message to last column
                        $failedData[] = $rowWithStatus;
                    }
                }

                $message = "$successCount data berhasil diimpor.";
                if ($failureCount > 0) {
                    $message .= " $failureCount data gagal. Silakan download file laporan error untuk memperbaikinya.";
                    
                    // Generate Excel for failed data
                    $spreadsheetFailed = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                    $sheetFailed = $spreadsheetFailed->getActiveSheet();
                    $sheetFailed->setTitle('Data Perbaikan');

                    // Set Data
                    $sheetFailed->fromArray($failedData, NULL, 'A1');

                    // Calculate Last Column and Row
                    $lastColumn = $sheetFailed->getHighestColumn();
                    $lastRow = $sheetFailed->getHighestRow();
                    $headerRange = "A1:{$lastColumn}1";
                    $dataRange = "A1:{$lastColumn}{$lastRow}";

                    // 1. STYLE HEADER (Professional Blue)
                    $headerStyle = [
                        'font' => [
                            'bold' => true,
                            'color' => ['argb' => 'FFFFFFFF'], // White text
                            'size' => 12,
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FF4F81BD'], // Blue background
                        ],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'FFFFFFFF'], 
                            ],
                        ],
                    ];
                    $sheetFailed->getStyle($headerRange)->applyFromArray($headerStyle);
                    $sheetFailed->getRowDimension(1)->setRowHeight(30); // Taller header

                    // 2. STYLE ERROR COLUMN (Red Text, Bold)
                    // The last column is always the Error column in our logic
                    $errorColumnRange = "{$lastColumn}2:{$lastColumn}{$lastRow}";
                    $sheetFailed->getStyle($errorColumnRange)->applyFromArray([
                        'font' => [
                            'color' => ['argb' => 'FFFF0000'], // Red
                            'italic' => true,
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FFFFE6E6'], // Light red background
                        ]
                    ]);

                    // 3. GENERAL TABLE STYLING (Borders & Alignment)
                    $sheetFailed->getStyle($dataRange)->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'FFD9D9D9'], // Gray borders
                            ],
                        ],
                        'alignment' => [
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                            'wrapText' => true, // Wrap text for readibility
                        ],
                    ]);

                    // 4. UX IMPROVEMENTS
                    $sheetFailed->freezePane('A2'); // Freeze Header
                    foreach(range('A', $lastColumn) as $columnID) {
                        $sheetFailed->getColumnDimension($columnID)->setAutoSize(true);
                    }
                    // Make error column wider explicitly if needed, but Autosize usually works. 
                    // Let's set a max width for error column so it doesn't get crazy wide
                    $sheetFailed->getColumnDimension($lastColumn)->setAutoSize(false);
                    $sheetFailed->getColumnDimension($lastColumn)->setWidth(50); // Fixed clear width for errors

                    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheetFailed);
                    $fileName = 'Laporan_Error_Import_' . date('Ymd_His') . '.xlsx';
                    $filePath = WRITEPATH . 'uploads/failed_imports/';
                    
                    if (!is_dir($filePath)) {
                        mkdir($filePath, 0777, true);
                    }
                    
                    $writer->save($filePath . $fileName);
                    
                    session()->setFlashdata('error_filename', $fileName);
                }

                $type = $failureCount > 0 ? 'warning' : 'success';
                return redirect()->to('mahasiswa-list')->with($type, $message);

            } catch (\Throwable $e) {
                return redirect()->to('mahasiswa-list')->with('error', 'Gagal sistem: ' . $e->getMessage());
            }
        }
        return redirect()->to('mahasiswa-list')->with('error', 'File tidak valid atau belum diunggah.');
    }

    public function downloadErrorFile($fileName)
    {
        $filePath = WRITEPATH . 'uploads/failed_imports/' . $fileName;

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName("Perbaikan_Data_Mahasiswa.xlsx");
        }
        
        return redirect()->to('mahasiswa-list')->with('error', 'File laporan error tidak ditemukan.');
    }

    public function downloadTemplate()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Import');

        // Headers
        $headers = ['Kode Prodi', 'NIM', 'Nama', 'Jenjang', 'Angkatan', 'Kategori'];
        $sheet->fromArray($headers, NULL, 'A1');

        // Styling Header (Blue & White)
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], 
                'size' => 12,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4F81BD'], 
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFFFFFFF'], 
                ],
            ],
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Add Input Hints (Comments)
        $sheet->getComment('A1')->getText()->createTextRun('Wajib: Masukkan Kode Prodi yang sesuai dengan database.');
        $sheet->getComment('B1')->getText()->createTextRun('Wajib: NIM harus unik (belum terdaftar).');
        $sheet->getComment('F1')->getText()->createTextRun('Pilihan: "Skema Pembiayaan Penuh" atau "Skema Biaya Pendidikan"');
        
        // Auto Width
        foreach(range('A','F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Example Data (Optional, but helpful)
        $sheet->setCellValue('A2', 'Contoh: 65201');
        $sheet->setCellValue('B2', '12345678');
        $sheet->setCellValue('C2', 'Nama Mahasiswa');
        $sheet->setCellValue('D2', 'S1');
        $sheet->setCellValue('E2', '2024');
        $sheet->setCellValue('F2', 'Skema Pembiayaan Penuh');

        // Style Example Data (Standard)
        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['color' => ['argb' => 'FF000000']],
        ]);

        // FORCE TEXT FORMAT FOR KODE PRODI (A) AND NIM (B)
        // This ensures Excel keeps leading zeros (e.g. 051)
        $sheet->getStyle('A:B')
            ->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $fileName = 'Template_Import_Mahasiswa.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function updateStatus()
    {
        if ($this->request->isAJAX()) {
            $data = $this->request->getJSON();
            $model = new MahasiswaModel();
            $updated = $model->update($data->id, [
                'pembaruan_status' => $data->pembaruan_status,
            ]);
            return $this->response->setJSON(['success' => $updated]);
        }
        return $this->response->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
    }

    public function delete($id)
    {
        $model = new MahasiswaModel();
        $model->delete($id);
        return redirect()->to('mahasiswa-list')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
