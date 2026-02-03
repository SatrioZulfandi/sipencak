<?php

namespace App\Models;

use CodeIgniter\Model;

class PencairanModel extends Model
{
    protected $table            = 'pencairans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'id_pt',
        'periode',
        'kategori_penerima',
        'tanggal_entry',
        'no_sk',
        'tanggal',
        'semester',
        'sptjm',
        'sk_penetapan',
        'sk_pembatalan',
        'berita_acara',
        'status',
        'jumlah_mahasiswa',
        'alasan_tolak' // <-- Pastikan jumlah_mahasiswa ada di sini
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function draft()
    {
        return $this->select('pencairans.*, pts.perguruan_tinggi, pts.kode_pt')
            ->join('pts', 'pts.id = pencairans.id_pt')
            ->groupStart()
            ->where('status !=', 'Diproses')
            ->where('status !=', 'Selesai')
            ->groupEnd()
            ->findAll();
    }

    public function histori()
    {
        return $this->select('pencairans.*, pts.perguruan_tinggi, pts.kode_pt')
            ->join('pts', 'pts.id = pencairans.id_pt')
            ->whereIn('status', ['Diproses', 'Selesai', 'Ditolak']) // ✅ tambahkan Ditolak
            ->findAll();
    }

    // Fungsi BARU untuk Histori dengan Pagination & Filter
    public function historiPager($limit, $tahun = null, $pt = null, $search = null)
    {
        $builder = $this->select('pencairans.*, pts.perguruan_tinggi, pts.kode_pt')
            ->join('pts', 'pts.id = pencairans.id_pt')
            ->whereIn('pencairans.status', ['Diproses', 'Selesai', 'Ditolak']);

        if ($tahun) {
            $builder->where('YEAR(pencairans.tanggal_entry)', $tahun);
        }

        if ($pt) {
            // Jika filter_pt mengirimkan Nama PT (string), gunakan ini:
            // $builder->like('pts.perguruan_tinggi', $pt);

            // Jika filter_pt mengirimkan ID (rekomendasi), gunakan ini:
            $builder->where('pencairans.id_pt', $pt);
        }

        if ($search) {
            $builder->groupStart()
                ->like('pts.perguruan_tinggi', $search)
                ->orLike('pencairans.no_sk', $search)
                ->groupEnd();
        }

        return $builder->orderBy('pencairans.tanggal_entry', 'DESC')
            ->paginate($limit, 'default');
    }

    public function detail($id)
    {
        return $this->select('pencairans.*,pts.perguruan_tinggi,pts.kode_pt')->join('pts', 'pts.id = pencairans.id_pt')->where('pencairans.id', $id)->first();
    }
}
