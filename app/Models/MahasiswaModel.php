<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table            = 'mahasiswas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pt',
        'id_prodi',
        'id_pencairan',
        'nim',
        'nama',
        'jenjang',
        'angkatan',
        'pembaruan_status',
        'status_pengajuan',
        'kategori'
    ];

    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'id' => 'permit_empty', // Required for placeholder {id} to work
        'nim' => 'required|is_unique[mahasiswas.nim,id,{id}]',
        'nama' => 'required',
        'id_pt' => 'required',
        'id_prodi' => 'required',
    ];

    protected $validationMessages = [
        'nim' => [
            'is_unique' => 'NIM sudah terdaftar.',
            'required' => 'NIM wajib diisi.'
        ],
        'nama' => [
            'required' => 'Nama mahasiswa wajib diisi.'
        ]
    ];

    /**
     * Mengambil semua data mahasiswa dengan detail prodi
     */
    public function With()
    {
        return $this->select('mahasiswas.*, prodis.kode_prodi, prodis.nama_prodi')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->findAll();
    }

    /**
     * Mengambil data mahasiswa berdasarkan PT tertentu
     */
    public function WithByPt($id_pt)
    {
        return $this->select('mahasiswas.*, prodis.kode_prodi, prodis.nama_prodi, pencairans.kategori_penerima')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->join('pencairans', 'pencairans.id = mahasiswas.id_pencairan', 'left')
            ->where('mahasiswas.id_pt', $id_pt)
            ->findAll();
    }

    /**
     * PERBAIKAN: Logika per-semester untuk pengajuan KIP.
     * Mahasiswa bisa diajukan kembali di semester berbeda,
     * tapi tidak bisa diajukan 2x dalam semester yang sama.
     * 
     * Logika:
     * - Mahasiswa dikecualikan HANYA jika sudah "Diajukan" di semester+periode yang SAMA
     * - Mahasiswa yang sudah diajukan di semester LAIN tetap muncul
     */
    public function universitas($pt, $id_pencairan_aktif = null, $perPage = 10)
    {
        $db = \Config\Database::connect();
        
        // Ambil info semester dari pencairan yang sedang aktif
        $pencairanModel = new \App\Models\PencairanModel();
        $pencairanAktif = $pencairanModel->find($id_pencairan_aktif);
        $semesterAktif = $pencairanAktif['semester'] ?? null;
        $periodeAktif = $pencairanAktif['periode'] ?? null;
        
        // Cari ID mahasiswa yang sudah FINAL (status=Diajukan) di semester+periode yang SAMA
        $subquery = $db->table('mahasiswas m')
            ->select('m.id')
            ->join('pencairans p', 'p.id = m.id_pencairan')
            ->where('m.id_pt', $pt)
            ->where('m.status_pengajuan', 'Diajukan')
            ->where('p.semester', $semesterAktif)
            ->where('p.periode', $periodeAktif)
            ->where('p.id !=', $id_pencairan_aktif)
            ->get()->getResultArray();
        
        $idSudahFinal = array_column($subquery, 'id');
        
        // Query utama: ambil semua mahasiswa dari PT ini
        $builder = $this->select('mahasiswas.*, prodis.kode_prodi, prodis.nama_prodi')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->where('mahasiswas.id_pt', $pt);
        
        // Kecualikan yang sudah FINAL di semester+periode yang sama
        if (!empty($idSudahFinal)) {
            $builder->whereNotIn('mahasiswas.id', $idSudahFinal);
        }
        
        // Kecualikan yang sedang dalam proses pengajuan LAIN (bukan pencairan ini)
        $builder->groupStart()
            ->where('mahasiswas.id_pencairan', null)
            ->orWhere('mahasiswas.id_pencairan', $id_pencairan_aktif)
            ->orWhere('mahasiswas.status_pengajuan !=', 'Proses Pengajuan')
        ->groupEnd();

        return $this->paginate($perPage, 'default');
    }

    /**
     * Digunakan untuk list verifikasi mahasiswa dalam satu pencairan
     */
    public function verifikasi($id, $keyword = null)
    {
        $builder = $this->select('mahasiswas.*, prodis.kode_prodi, prodis.nama_prodi')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->where('mahasiswas.id_pencairan', $id);

        if ($keyword) {
            $builder->groupStart()
                ->like('mahasiswas.nama', $keyword)
                ->orLike('mahasiswas.nim', $keyword)
                ->groupEnd();
        }

        return $builder->paginate(10, 'default');
    }

    /**
     * Digunakan untuk halaman detail pencairan (lengkap dengan data PT)
     */
    public function pencairan($id, $keyword = null)
    {
        $this->select('mahasiswas.*, pts.perguruan_tinggi, pts.kode_pt, prodis.kode_prodi, prodis.nama_prodi')
            ->join('pts', 'pts.id = mahasiswas.id_pt')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->where('mahasiswas.id_pencairan', $id);

        // Jika ada keyword, lakukan filter pencarian
        if (!empty($keyword)) {
            $this->groupStart()
                ->like('mahasiswas.nama', $keyword)
                ->orLike('mahasiswas.nim', $keyword)
                ->groupEnd();
        }

        // Tetap gunakan pagination 6 data per halaman sesuai preferensi Anda
        return $this->paginate(6, 'default');
    }
}
