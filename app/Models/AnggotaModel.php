<?php 

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';
    protected $useTimestamps = true;
    protected $allowedFields = ['nis','nama','kelas', 'nohp'];

    public function getAnggota($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}