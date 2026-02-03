<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\PtModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Prodi extends BaseController
{
    public function index()
    {
        $model = new ProdiModel();
        $id_pt = session()->get('pt');

        // Ambil kata kunci pencarian dari URL (GET)
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $model->groupStart()
                ->like('kode_prodi', $keyword)
                ->orLike('nama_prodi', $keyword)
                ->groupEnd();
        }

        $data = [
            'data'    => $model->where('id_pt', $id_pt)->paginate(10, 'default'),
            'pager'   => $model->pager,
            'title'   => 'Manajemen Prodi',
            'keyword' => $keyword // Kirim balik ke view untuk mengisi value input
        ];

        return view('admin/prodi_list', $data);
    }

    public function create()
    {
        $data = [
            'btn' => 'add',
            'act' => '/prodi-store',
            'sub' => 'Tambah',
            'title' => 'Tambah Prodi',
        ];
        return view('admin/prodi_form', $data);
    }

    public function store()
    {
        $model = new ProdiModel();
        $model->save([
            'kode_prodi'  => $this->request->getPost('kode_prodi'),
            'nama_prodi'  => $this->request->getPost('nama_prodi'),
            'id_pt'       => $this->request->getPost('id_pt'),
        ]);
        return redirect()->to('prodi-list');
    }

    public function edit($id)
    {
        $model = new ProdiModel();
        $data = [
            'btn'   => 'edit',
            'act'   => '/prodi-update/' . $id,
            'sub'   => 'Edit',
            'title' => 'Edit Prodi',
            'data'  => $model->find($id),
        ];
        return view('admin/prodi_form', $data);
    }

    public function update($id)
    {
        $model = new ProdiModel();
        $model->update($id, [
            'kode_prodi'  => $this->request->getPost('kode_prodi'),
            'nama_prodi'  => $this->request->getPost('nama_prodi'),
        ]);
        return redirect()->to('prodi-list');
    }

    public function delete($id)
    {
        $model = new ProdiModel();
        $model->delete($id);
        return redirect()->to('prodi-list');
    }

    public function import()
    {
        $file = $this->request->getFile('excel');

        if ($file->isValid() && !$file->hasMoved()) {
            try {
                $spreadsheet = IOFactory::load($file->getTempName());
                $sheet = $spreadsheet->getActiveSheet()->toArray();

                $prodiModel = new ProdiModel();
                $ptModel    = new PtModel();

                $imported = 0;
                $skipped  = 0;

                foreach (array_slice($sheet, 1) as $row) {
                    $kode_pt    = trim($row[0]);
                    $kode_prodi = trim($row[1]);
                    $nama_prodi = trim($row[2]);

                    if ($kode_pt && $kode_prodi && $nama_prodi) {
                        $pt = $ptModel->where('kode_pt', $kode_pt)->first();

                        if ($pt) {
                            $prodiModel->insert([
                                'id_pt'       => $pt['id'],
                                'kode_prodi'  => $kode_prodi,
                                'nama_prodi'  => $nama_prodi,
                            ]);
                            $imported++;
                        } else {
                            $skipped++;
                        }
                    }
                }

                $message = "$imported Prodi berhasil diimpor.";
                if ($skipped > 0) {
                    $message .= " $skipped baris dilewati karena kode_pt tidak ditemukan.";
                }

                return redirect()->to('prodi-list')->with('success', $message);
            } catch (\Exception $e) {
                return redirect()->to('prodi-list')->with('error', 'Gagal memproses file: ' . $e->getMessage());
            }
        }

        return redirect()->to('prodi-list')->with('error', 'File tidak valid atau gagal diunggah.');
    }
}
