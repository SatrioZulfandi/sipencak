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
     * Menggunakan tabel pengajuan_mahasiswa untuk tracking multi-periode.
     */
    public function universitas($pt, $id_pencairan_aktif = null, $filters = [])
    {
        $db = \Config\Database::connect();
        
        $perPage        = $filters['entries'] ?? 10;
        $filterProdi    = $filters['filter_prodi'] ?? null;
        $filterAngkatan = $filters['filter_angkatan'] ?? null;
        $filterKategori = $filters['filter_kategori'] ?? null;
        $keyword        = $filters['keyword'] ?? null;
        $sort           = $filters['sort'] ?? null;
        $order          = $filters['order'] ?? null;
        
        $allowedSort = ['nim', 'nama', 'prodi', 'jenjang', 'angkatan', 'kategori'];
        $validOrder = ['asc', 'desc'];

        // Ambil info semester dari pencairan yang sedang aktif
        $pencairanModel = new \App\Models\PencairanModel();
        $pencairanAktif = $pencairanModel->find($id_pencairan_aktif);
        $semesterAktif = $pencairanAktif['semester'] ?? null;
        $periodeAktif = $pencairanAktif['periode'] ?? null;
        
        // Cari ID mahasiswa yang sudah FINAL (status=Diajukan) di semester+periode yang SAMA
        // TAPI bukan di pencairan yang sedang aktif ini (jika sedang edit draft)
        $subquery = $db->table('pengajuan_mahasiswa pm')
            ->select('pm.id_mahasiswa')
            ->join('pencairans p', 'p.id = pm.id_pencairan')
            ->where('pm.status_pengajuan', 'Diajukan')
            ->where('p.semester', $semesterAktif)
            ->where('p.periode', $periodeAktif);
            
        if ($id_pencairan_aktif) {
            $subquery->where('pm.id_pencairan !=', $id_pencairan_aktif);
        }
            
        $idsSudahFinal = $subquery->get()->getResultArray();
        $idSudahFinal = array_column($idsSudahFinal, 'id_mahasiswa');

        // Cari ID mahasiswa yang sedang dalam "Proses Pengajuan" di pencairan LAIN (draft lain)
        // untuk mencegah satu mahasiswa ada di 2 draft sekaligus
        $subqueryDraft = $db->table('pengajuan_mahasiswa pm')
            ->select('pm.id_mahasiswa')
            ->where('pm.status_pengajuan', 'Proses Pengajuan');
            
        if ($id_pencairan_aktif) {
            $subqueryDraft->where('pm.id_pencairan !=', $id_pencairan_aktif);
        }
        
        $idsDraftLain = $subqueryDraft->get()->getResultArray();
        $idDraftLain = array_column($idsDraftLain, 'id_mahasiswa');
        
        // Gabungkan ID yang harus di-exclude
        $excludedIds = array_unique(array_merge($idSudahFinal, $idDraftLain));
        
        // Query utama: ambil semua mahasiswa dari PT ini
        $builder = $this->select('mahasiswas.*, prodis.kode_prodi, prodis.nama_prodi, pm_aktif.status_pengajuan as status_di_pencairan_ini')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            // Join ke pengajuan_mahasiswa KHUSUS untuk pencairan ini saja (untuk tahu status checked/unchecked)
            ->join('pengajuan_mahasiswa pm_aktif', 'pm_aktif.id_mahasiswa = mahasiswas.id AND pm_aktif.id_pencairan = ' . $db->escape($id_pencairan_aktif), 'left')
            ->where('mahasiswas.id_pt', $pt);
        
        // Filter Logic
        if ($filterProdi) {
            $builder->where('mahasiswas.id_prodi', $filterProdi);
        }
        if ($filterAngkatan) {
            $builder->where('mahasiswas.angkatan', $filterAngkatan);
        }
        if ($filterKategori) {
            $builder->where('mahasiswas.kategori', $filterKategori);
        }
        if ($keyword) {
            $builder->groupStart()
                ->like('mahasiswas.nama', $keyword)
                ->orLike('mahasiswas.nim', $keyword)
                ->groupEnd();
        }

        // Kecualikan yang sudah FINAL atau Draft Lain
        if (!empty($excludedIds)) {
            $builder->whereNotIn('mahasiswas.id', $excludedIds);
        }

        // Sorting
        if ($sort && in_array($sort, $allowedSort) && in_array($order, $validOrder)) {
            if ($sort == 'prodi') {
                $builder->orderBy('prodis.nama_prodi', $order);
            } else {
                $builder->orderBy('mahasiswas.' . $sort, $order);
            }
        } else {
             $builder->orderBy('mahasiswas.id', 'DESC'); // Default matching other tables
        }

        return $this->paginate($perPage, 'default');
    }

    /**
     * Digunakan untuk list verifikasi mahasiswa dalam satu pencairan
     * Mengambil data dari tabel pengajuan_mahasiswa
     */
    public function verifikasi($id_pencairan, $filters = [])
    {
        $keyword        = $filters['keyword'] ?? null;
        $filterProdi    = $filters['filter_prodi'] ?? null;
        $filterAngkatan = $filters['filter_angkatan'] ?? null;
        $filterKategori = $filters['filter_kategori'] ?? null;
        $filterKategori = $filters['filter_kategori'] ?? null;
        $entries        = $filters['entries'] ?? 10;
        $sort           = $filters['sort'] ?? null;
        $order          = $filters['order'] ?? null;

        $allowedSort = ['nim', 'nama', 'prodi', 'jenjang', 'angkatan', 'kategori'];
        $validOrder = ['asc', 'desc'];

        $builder = $this->select('mahasiswas.*, prodis.kode_prodi, prodis.nama_prodi, pengajuan_mahasiswa.status_pengajuan')
            ->join('pengajuan_mahasiswa', 'pengajuan_mahasiswa.id_mahasiswa = mahasiswas.id')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->where('pengajuan_mahasiswa.id_pencairan', $id_pencairan);

        if ($filterProdi) {
            $builder->where('mahasiswas.id_prodi', $filterProdi);
        }

        if ($filterAngkatan) {
            $builder->where('mahasiswas.angkatan', $filterAngkatan);
        }

        if ($filterKategori) {
            $builder->where('mahasiswas.kategori', $filterKategori);
        }

        if ($keyword) {
            $builder->groupStart()
                ->like('mahasiswas.nama', $keyword)
                ->orLike('mahasiswas.nim', $keyword)
                ->groupEnd();
        }

        // Sorting
        if ($sort && in_array($sort, $allowedSort) && in_array($order, $validOrder)) {
            if ($sort == 'prodi') {
                $builder->orderBy('prodis.nama_prodi', $order);
            } else {
                $builder->orderBy('mahasiswas.' . $sort, $order);
            }
        } else {
             $builder->orderBy('mahasiswas.nama', 'ASC'); // Default for list verification usually name
        }

        return $builder->paginate($entries, 'default');
    }

    /**
     * Digunakan untuk halaman detail pencairan (lengkap dengan data PT)
     */
    public function pencairan($id_pencairan, $keyword = null, $prodi = null, $angkatan = null, $entries = 10, $sort = null, $order = null)
    {
        $allowedSort = ['nim', 'nama', 'prodi', 'jenjang', 'angkatan', 'kategori'];
        $validOrder = ['asc', 'desc'];
        $this->select('mahasiswas.*, pts.perguruan_tinggi, pts.kode_pt, prodis.kode_prodi, prodis.nama_prodi, pengajuan_mahasiswa.status_pengajuan, pengajuan_mahasiswa.id as id_pengajuan')
            ->join('pengajuan_mahasiswa', 'pengajuan_mahasiswa.id_mahasiswa = mahasiswas.id')
            ->join('pts', 'pts.id = mahasiswas.id_pt')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->where('pengajuan_mahasiswa.id_pencairan', $id_pencairan);

        // Jika ada keyword, lakukan filter pencarian
        if (!empty($keyword)) {
            $this->groupStart()
                ->like('mahasiswas.nama', $keyword)
                ->orLike('mahasiswas.nim', $keyword)
                ->groupEnd();
        }

        if (!empty($prodi)) {
            $this->where('mahasiswas.id_prodi', $prodi);
        }

        if (!empty($angkatan)) {
            $this->where('mahasiswas.angkatan', $angkatan);
        }

        // Sorting
        if ($sort && in_array($sort, $allowedSort) && in_array($order, $validOrder)) {
             if ($sort == 'prodi') {
                $this->orderBy('prodis.nama_prodi', $order);
            } else {
                $this->orderBy('mahasiswas.' . $sort, $order);
            }
        } else {
            $this->orderBy('mahasiswas.id', 'DESC');
        }

        // Tetap gunakan pagination sesuai preferensi Anda
        return $this->paginate($entries, 'default');
    }
}
