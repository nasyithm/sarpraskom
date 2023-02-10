<?php 

namespace App\Models;

use CodeIgniter\Model;

class PrasaranaModel extends Model
{
    protected $table = 'prasarana';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode','nama','spesifikasi','jumlah'];

    public function getPrasarana($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}