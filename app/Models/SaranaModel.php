<?php 

namespace App\Models;

use CodeIgniter\Model;

class SaranaModel extends Model
{
    protected $table = 'sarana';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode','nama','spesifikasi','jumlah'];

    public function getSarana($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}