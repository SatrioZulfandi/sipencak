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
        $idPpt = session()->get('pt');

        // Ambil input keyword dari pencarian
        $keyword = $this->request->getGet('keyword');

        $model->select('mahasiswas.*, prodis.nama_prodi')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi', 'left')
            ->where('mahasiswas.id_pt', $idPpt);

        // Tambahkan logika pencarian jika keyword ada
        if ($keyword) {
            $model->groupStart()
                ->like('mahasiswas.nim', $keyword)
                ->orLike('mahasiswas.nama', $keyword)
                ->orLike('prodis.nama_prodi', $keyword)
                ->groupEnd();
        }

        $data = [
            'data'    => $model->paginate(10, 'default'),
            'pager'   => $model->pager,
            'title'   => 'Manajemen Mahasiswa',
            'keyword' => $keyword // Kirim balik ke view
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
        $model->update($id, [
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
                $total = 0;
                $gagal = 0;

                foreach (array_slice($sheet, 1) as $row) {
                    $kodeProdi = trim($row[0]);
                    $prodi = $prodiModel->where('kode_prodi', $kodeProdi)->first();

                    if ($prodi) {
                        $mahasiswaModel->insert([
                            'id_pt' => session()->get('pt'),
                            'id_prodi' => $prodi['id'],
                            'nim' => trim($row[1]),
                            'nama' => trim($row[2]),
                            'jenjang' => trim($row[3]),
                            'angkatan' => trim($row[4]),
                            'kategori' => trim($row[5]),
                            'pembaruan_status' => 'Tetap',
                            'status_pengajuan' => 'Belum Diajukan',
                        ]);
                        $total++;
                    } else {
                        $gagal++;
                    }
                }
                return redirect()->to('mahasiswa-list')->with('success', "$total mahasiswa berhasil diimpor.");
            } catch (\Throwable $e) {
                return redirect()->to('mahasiswa-list')->with('error', 'Gagal: ' . $e->getMessage());
            }
        }
        return redirect()->to('mahasiswa-list')->with('error', 'File tidak valid.');
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
        return redirect()->to('mahasiswa-list');
    }
}
