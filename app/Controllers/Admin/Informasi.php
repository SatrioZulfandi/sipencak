<?php

namespace App\Controllers\Admin;

use App\Models\InformasiModel;
use App\Controllers\BaseController;

class Informasi extends BaseController
{
    public function index()
    {
        $model = new InformasiModel();

        $keyword = $this->request->getGet('keyword');

        if (!empty($keyword)) {
            $model->groupStart()
                ->like('judul', $keyword)
                ->orLike('deskripsi', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'   => 'Papan Informasi',
            // Mengurutkan berdasarkan tanggal terbaru (DESC) agar muncul di page 1
            'data'    => $model->orderBy('tanggal', 'DESC')->paginate(3, 'default'),
            'pager'   => $model->pager,
            'keyword' => $keyword
        ];

        return view('admin/informasi_list', $data);
    }

    public function show($id)
    {
        $model = new InformasiModel();
        $data = [
            'data'  => $model->find($id),
            'title' => 'Detail Informasi',
        ];
        return view('admin/informasi_detail', $data);
    }
}
