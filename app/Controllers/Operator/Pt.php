<?php

namespace App\Controllers\Operator;

use App\Controllers\Operator\BaseOperatorController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PtModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pt extends BaseOperatorController
{
    public function index()
    {
        $model = new PtModel();

        // Mengambil input pencarian dari URL
        $search = $this->request->getGet('search');

        if (!empty($search)) {
            $model->groupStart()
                ->like('kode_pt', $search)
                ->orLike('perguruan_tinggi', $search)
                ->orLike('aipt', $search)
                ->groupEnd();
        }

        // Menggunakan paginate (6 data per halaman sesuai preferensi)
        $data = [
            'data'   => $model->paginate(6, 'default'),
            'pager'  => $model->pager,
            'title'  => 'Manajemen Perguruan Tinggi',
            'search' => $search
        ];

        return view('operator/pt_list', $data);
    }

    public function create()
    {
        $data = [
            'btn' => 'add',
            'act' => '/pt-store',
            'sub' => 'Tambah',
            'title' => 'Tambah Perguruan Tinggi',
        ];
        return view('operator/pt_form', $data);
    }

    public function uploadExcel()
    {
        $file = $this->request->getFile('excel_file');

        if (!$file->isValid() || $file->getExtension() !== 'xlsx') {
            return redirect()->back()->with('error', 'File tidak valid atau bukan .xlsx');
        }

        $filePath = WRITEPATH . 'uploads/' . $file->getRandomName();
        $file->move(WRITEPATH . 'uploads', basename($filePath));

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            if (empty($rows) || count($rows[0]) < 3) {
                return redirect()->back()->with('error', 'Format Excel tidak sesuai. Kolom harus: kode_pt, perguruan_tinggi, aipt.');
            }

            $header = array_map('strtolower', $rows[0]);
            $expected = ['kode_pt', 'perguruan_tinggi', 'aipt'];

            if ($header !== $expected) {
                return redirect()->back()->with('error', 'Header kolom Excel tidak sesuai. Gunakan template sesuai tabel.');
            }

            $model = new PtModel();
            $inserted = 0;

            foreach ($rows as $index => $row) {
                if ($index === 0) continue;

                $kodePt = trim($row[0] ?? '');
                $nama = trim($row[1] ?? '');
                $aipt = trim($row[2] ?? '');

                if ($kodePt && $nama && $aipt) {
                    $model->save([
                        'kode_pt' => $kodePt,
                        'perguruan_tinggi' => $nama,
                        'aipt' => $aipt
                    ]);
                    $inserted++;
                }
            }

            return redirect()->to('pt-list')->with('success', "$inserted data berhasil diimpor.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }

    public function store()
    {
        $model = new PtModel();
        $model->save([
            'kode_pt'  => $this->request->getPost('kode_pt'),
            'perguruan_tinggi' => $this->request->getPost('perguruan_tinggi'),
            'aipt' => $this->request->getPost('aipt'),
        ]);
        return redirect()->to('pt-list');
    }

    public function edit($id)
    {
        $model = new PtModel();
        $data = [
            'btn' => 'edit',
            'act' => '/pt-update/' . $id,
            'sub' => 'Edit',
            'title' => 'Edit Perguruan Tinggi',
            'data' => $model->find($id),
        ];
        return view('operator/pt_form', $data);
    }

    public function update($id)
    {
        $model = new PtModel();
        $model->update($id, [
            'kode_pt'  => $this->request->getPost('kode_pt'),
            'perguruan_tinggi' => $this->request->getPost('perguruan_tinggi'),
            'aipt' => $this->request->getPost('aipt'),
        ]);
        return redirect()->to('pt-list');
    }

    public function delete($id)
    {
        $model = new PtModel();
        $model->delete($id);
        return redirect()->to('pt-list');
    }
}
