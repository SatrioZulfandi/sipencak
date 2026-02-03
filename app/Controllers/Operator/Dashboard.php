<?php

namespace App\Controllers\Operator;

use App\Controllers\Operator\BaseOperatorController;
use App\Models\PtModel;
use App\Models\PencairanModel;
use App\Models\UserptModel;
use App\Models\MahasiswaModel;
use App\Models\InformasiModel;
use App\Models\UserModel;

class Dashboard extends BaseOperatorController
{
    public function index()
    {
        helper('text');

        $ptModel         = new PtModel();
        $pencairanModel  = new PencairanModel();
        $userptModel     = new UserptModel();
        $mahasiswaModel  = new MahasiswaModel();
        $informasiModel  = new InformasiModel();

        // Semua data PT
        $jumlah_pt = count($ptModel->findAll());

        // Semua data userpt
        $jumlah_userpt = count($userptModel->findAll());

        // Semua mahasiswa (tanpa filter id_pt)
        $jumlah_mahasiswa = count($mahasiswaModel->findAll());

        // Semua pencairan dari semua PT yang berstatus selesai
        $jumlah_pencairan = count(
            $pencairanModel->where('status', 'selesai')->findAll()
        );

        // Menampilkan 5 informasi terbaru
        $informasi = $informasiModel->orderBy('tanggal', 'DESC')->findAll(5);

        $data = [
            'title'              => 'PT - Dashboard',
            'jumlah_pt'          => $jumlah_pt,
            'jumlah_mahasiswa'   => $jumlah_mahasiswa,
            'jumlah_pencairan'   => $jumlah_pencairan,
            'jumlah_userpt'      => $jumlah_userpt,
            'informasi'          => $informasi,
        ];

        return view('operator/index', $data);
    }

    public function update($id)
    {
        $data = [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $model = new UserModel();
        $model->update($id, $data);

        return redirect()->to('dashboard');
    }
}
