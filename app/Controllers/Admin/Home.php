<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserptModel;
use App\Models\MahasiswaModel;
use App\Models\PencairanModel;
use App\Models\PtModel;
use App\Models\InformasiModel;

class Home extends BaseController
{
    public function index()
    {
        $userModel       = new UserptModel();
        $mahasiswaModel  = new MahasiswaModel();
        $pencairanModel  = new PencairanModel();
        $ptModel         = new PtModel();
        $informasiModel  = new InformasiModel();

        // Statistik keseluruhan (TANPA dibatasi id_pt)
        $jumlah_pt         = $ptModel->countAll();
        $jumlah_userpt     = $userModel->countAll();
        $jumlah_mahasiswa  = $mahasiswaModel->countAll();
        $jumlah_pencairan  = $pencairanModel->where('status', 'selesai')->countAllResults();

        // Ambil 6 informasi terbaru (semua PT)
        $informasi = $informasiModel->orderBy('tanggal', 'DESC')->findAll(6);

        $data = [
            'title'             => 'Admin PT - Dashboard',
            'jumlah_pt'         => $jumlah_pt,
            'jumlah_mahasiswa'  => $jumlah_mahasiswa,
            'jumlah_userpt'     => $jumlah_userpt,
            'jumlah_pencairan'  => $jumlah_pencairan,
            'informasi'         => $informasi
        ];

        return view('admin/index', $data);
    }

    public function update($id)
    {
        $password = $this->request->getPost('password');

        if (empty($password)) {
            return redirect()->back()->with('error', 'Password tidak boleh kosong.');
        }

        $model = new UserptModel();
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        $model->update($id, $data);
        
        
        // LOGGING
        // use App\Models\LogModel; // Removed invalid placement
        (new \App\Models\LogModel())->log('update', 'user', 'Mengubah password admin ID: ' . $id);

        return redirect()->to(base_url('home'))->with('success', 'Password berhasil diperbarui.');
    }
}
