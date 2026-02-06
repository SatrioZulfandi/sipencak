<?php

namespace App\Models;

use CodeIgniter\Model;

class UserptModel extends Model
{
    protected $table = 'userpts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_pt', 'username', 'password', 'penanggung_jawab', 'nip', 'kontak', 'email', 'status', 'reset_code', 'reset_expired'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function WithPt()
    {
        return $this->select('userpts.*, pts.perguruan_tinggi')
            ->join('pts', 'pts.id = userpts.id_pt', 'left') // <- ini yang diubah
            ->findAll();
    }

    public function WithPtPager($limit, $search = null)
    {
        $builder = $this->select('userpts.*, pts.perguruan_tinggi')
            ->join('pts', 'pts.id = userpts.id_pt', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('userpts.username', $search)
                ->orLike('userpts.penanggung_jawab', $search)
                ->orLike('pts.perguruan_tinggi', $search)
                ->groupEnd();
        }

        return $builder->paginate($limit, 'default');
    }

    public function findWith($id)
    {
        return $this->select('userpts.*, pts.perguruan_tinggi')->join('pts', 'pts.id = userpts.id_pt')->where('userpts.id', $id)->first();
    }
}
