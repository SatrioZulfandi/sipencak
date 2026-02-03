<?php

namespace App\Controllers\Operator;

use App\Controllers\Operator\BaseOperatorController;
use App\Models\PtModel;
use App\Models\UserptModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Userpt extends BaseOperatorController
{
    public function index()
    {
        $model = new UserptModel();
        $search = $this->request->getVar('search');

        if ($search) {
            $model->groupStart()
                ->like('username', $search)
                ->orLike('perguruan_tinggi', $search)
                ->groupEnd();
        }

        $data = [
            'data'   => $model->WithPtPager(6), // Menggunakan pager dengan limit 6 sesuai konfigurasi Anda
            'pager'  => $model->pager,
            'title'  => 'Manajemen User',
            'search' => $search
        ];

        return view('operator/userpt_list', $data);
    }

    public function create()
    {
        $pt = new PtModel();
        $data = [
            'btn' => 'add',
            'act' => '/userpt-store',
            'sub' => 'Tambah',
            'title' => 'Tambah User',
            'pt' => $pt->findAll(),
        ];
        return view('operator/userpt_form', $data);
    }

    public function store()
    {
        if (
            !$this->validate([
                'password' => 'required|min_length[6]|matches[password_confirm]',
                'password_confirm' => 'required',
            ])
        ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UserptModel();
        $model->save([
            'id_pt' => $this->request->getPost('id_pt'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'nip' => $this->request->getPost('nip'),
            'kontak' => $this->request->getPost('kontak'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
        ]);
        return redirect()->to('userpt-list');
    }

    public function edit($id)
    {
        $pt = new PtModel();
        $model = new UserptModel();
        $data = [
            'btn' => 'edit',
            'act' => '/userpt-update/' . $id,
            'sub' => 'Edit',
            'title' => 'Edit User',
            'data' => $model->find($id),
            'pt' => $pt->findAll(),
        ];
        return view('operator/userpt_form', $data);
    }

    public function import()
    {
        $file = $this->request->getFile('excel');

        if ($file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            $userModel = new \App\Models\UserptModel();
            $ptModel = new \App\Models\PtModel();

            $total = 0;
            foreach (array_slice($sheet, 1) as $row) {
                $kodePt = trim($row[0]);
                $pt = $ptModel->where('kode_pt', $kodePt)->first();

                if ($pt) {
                    $userModel->insert([
                        'id_pt' => $pt['id'],
                        'username' => $row[1],
                        'password' => password_hash($row[2], PASSWORD_DEFAULT),
                        'penanggung_jawab' => $row[3],
                        'nip' => $row[4],
                        'kontak' => $row[5],
                        'email' => $row[6],
                        'status' => strtolower(trim($row[7])) === 'aktif' ? 'aktif' : 'nonaktif',
                    ]);
                    $total++;
                }
            }

            // Notifikasi sesuai hasil
            if ($total > 0) {
                return redirect()->to('userpt-list')->with('success', "$total user berhasil diimpor dari Excel.");
            } else {
                return redirect()->to('userpt-list')->with('error', 'Tidak ada data yang berhasil diimpor. Pastikan kode_pt cocok dengan database.');
            }
        }

        // Gagal upload file
        return redirect()->to('userpt-list')->with('error', 'Gagal mengunggah file. Pastikan file Excel valid dan belum dipindahkan.');
    }

    public function update($id)
    {
        $password = $this->request->getPost('password');
        $password_confirm = $this->request->getPost('password_confirm');

        if (!empty($password)) {
            if (
                !$this->validate([
                    'password' => 'required|min_length[6]|matches[password_confirm]',
                    'password_confirm' => 'required',
                ])
            ) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }
        }

        $data = [
            'id_pt' => $this->request->getPost('id_pt'),
            'username' => $this->request->getPost('username'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'nip' => $this->request->getPost('nip'),
            'kontak' => $this->request->getPost('kontak'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status'),
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model = new UserptModel();
        $model->update($id, $data);

        return redirect()->to('userpt-list');
    }

    public function show($id)
    {
        $model = new UserptModel();
        $data = [
            'data' => $model->findWith($id),
            'title' => 'Detail User',
        ];
        return view('operator/userpt_show', $data);
    }

    public function delete($id)
    {
        $model = new UserptModel();
        $model->delete($id);
        return redirect()->to('userpt-list');
    }
}
