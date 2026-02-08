<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanMahasiswaModel extends Model
{
    protected $table            = 'pengajuan_mahasiswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_mahasiswa',
        'id_pencairan',
        'status_pengajuan',
        'created_at'
    ];

    protected $useTimestamps = false;

    /**
     * Ambil semua pengajuan berdasarkan pencairan
     */
    public function getByPencairan($id_pencairan)
    {
        return $this->where('id_pencairan', $id_pencairan)->findAll();
    }

    /**
     * Ambil semua pengajuan berdasarkan mahasiswa
     */
    public function getByMahasiswa($id_mahasiswa)
    {
        return $this->where('id_mahasiswa', $id_mahasiswa)->findAll();
    }

    /**
     * Cek apakah mahasiswa sudah diajukan di pencairan tertentu
     */
    public function isAlreadySubmitted($id_mahasiswa, $id_pencairan)
    {
        return $this->where('id_mahasiswa', $id_mahasiswa)
            ->where('id_pencairan', $id_pencairan)
            ->first() !== null;
    }

    /**
     * Ambil status pengajuan mahasiswa untuk pencairan tertentu
     */
    public function getStatus($id_mahasiswa, $id_pencairan)
    {
        $result = $this->where('id_mahasiswa', $id_mahasiswa)
            ->where('id_pencairan', $id_pencairan)
            ->first();

        return $result ? $result['status_pengajuan'] : null;
    }

    /**
     * Cek apakah mahasiswa sudah FINAL (status=Diajukan) di semester+periode yang sama
     */
    public function isFinalInSamePeriode($id_mahasiswa, $semester, $periode, $exclude_pencairan_id = null)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pengajuan_mahasiswa pm')
            ->select('pm.id')
            ->join('pencairans p', 'p.id = pm.id_pencairan')
            ->where('pm.id_mahasiswa', $id_mahasiswa)
            ->where('pm.status_pengajuan', 'Diajukan')
            ->where('p.semester', $semester)
            ->where('p.periode', $periode);

        if ($exclude_pencairan_id) {
            $builder->where('p.id !=', $exclude_pencairan_id);
        }

        return $builder->get()->getRow() !== null;
    }

    /**
     * Hapus semua pengajuan berdasarkan pencairan
     */
    public function deleteByPencairan($id_pencairan)
    {
        return $this->where('id_pencairan', $id_pencairan)->delete();
    }

    /**
     * Hapus pengajuan mahasiswa tertentu dari pencairan
     */
    public function removeFromPencairan($id_mahasiswa, $id_pencairan)
    {
        return $this->where('id_mahasiswa', $id_mahasiswa)
            ->where('id_pencairan', $id_pencairan)
            ->delete();
    }

    /**
     * Ambil data mahasiswa dengan status pengajuan untuk pencairan tertentu
     */
    public function getMahasiswaWithStatus($id_pencairan, $keyword = null, $perPage = 6)
    {
        $builder = $this->select('pengajuan_mahasiswa.*, mahasiswas.nim, mahasiswas.nama, mahasiswas.jenjang, mahasiswas.angkatan, mahasiswas.kategori, mahasiswas.pembaruan_status, prodis.nama_prodi, prodis.kode_prodi')
            ->join('mahasiswas', 'mahasiswas.id = pengajuan_mahasiswa.id_mahasiswa')
            ->join('prodis', 'prodis.id = mahasiswas.id_prodi')
            ->where('pengajuan_mahasiswa.id_pencairan', $id_pencairan);

        if ($keyword) {
            $builder->groupStart()
                ->like('mahasiswas.nama', $keyword)
                ->orLike('mahasiswas.nim', $keyword)
                ->groupEnd();
        }

        return $builder->paginate($perPage, 'default');
    }

    /**
     * Hitung jumlah mahasiswa dalam pencairan
     */
    public function countByPencairan($id_pencairan)
    {
        return $this->where('id_pencairan', $id_pencairan)->countAllResults();
    }

    /**
     * Update status semua mahasiswa dalam pencairan
     */
    public function updateStatusByPencairan($id_pencairan, $status)
    {
        return $this->where('id_pencairan', $id_pencairan)
            ->set(['status_pengajuan' => $status])
            ->update();
    }
}
