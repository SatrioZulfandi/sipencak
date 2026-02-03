<?php

namespace App\Controllers\Operator;

use App\Controllers\Operator\BaseOperatorController;
use App\Models\InformasiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Informasi extends BaseOperatorController
{

    public function index()
    {
        $model = new InformasiModel();

        // Ambil input dari filter form (GET)
        $search    = $this->request->getGet('search');
        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        // Logika Filter Search Box
        if (!empty($search)) {
            $model->groupStart()
                ->like('judul', $search)
                ->orLike('deskripsi', $search)
                ->groupEnd();
        }

        // Logika Filter Rentang Tanggal
        if (!empty($startDate) && !empty($endDate)) {
            $model->where('tanggal >=', $startDate)
                ->where('tanggal <=', $endDate);
        } elseif (!empty($startDate)) {
            $model->where('tanggal', $startDate);
        }

        $data = [
            'data'       => $model->orderBy('tanggal', 'DESC')->paginate(6, 'default'),
            'pager'      => $model->pager,
            'title'      => 'Manajemen Informasi',
            'search'     => $search,
            'start_date' => $startDate,
            'end_date'   => $endDate
        ];

        return view('operator/informasi_list', $data);
    }

    public function create()
    {
        $data = [
            'btn' => 'add',
            'act' => '/informasi-store',
            'sub' => 'Tambah',
            'title' => 'Tambah Informasi',
        ];
        return view('operator/informasi_form', $data);
    }

    public function store()
    {
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('informasi', $newName);
        } else {
            $newName = null;
        }

        $model = new InformasiModel();
        $model->save([
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'file' => $newName,
            'tanggal' => date('Y-m-d'),
        ]);

        return redirect()->to('informasi-list');
    }

    public function edit($id)
    {
        $model = new InformasiModel();
        $data = [
            'btn' => 'edit',
            'act' => '/informasi-update/' . $id,
            'sub' => 'Edit',
            'title' => 'Edit Informasi',
            'data' => $model->find($id),
        ];
        return view('operator/informasi_form', $data);
    }

    public function update($id)
    {
        $model = new InformasiModel();

        $oldData = $model->find($id);
        $oldFile = $oldData['file'];

        $file = $this->request->getFile('file');
        $newName = $oldFile;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('informasi', $newName);
            if ($oldFile && file_exists('informasi/' . $oldFile)) {
                unlink('informasi/' . $oldFile);
            }
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'file' => $newName,
        ];

        $model->update($id, $data);

        return redirect()->to('informasi-list');
    }

    public function show($id)
    {
        $model = new InformasiModel();
        $data = [
            'data' => $model->find($id),
            'title' => 'Detail Informasi',
        ];
        return view('operator/informasi_show', $data);
    }

    public function delete($id)
    {
        $model = new InformasiModel();
        $model->delete($id);
        return redirect()->to('informasi-list');
    }
}
