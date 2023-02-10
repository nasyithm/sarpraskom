<?php 

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'akun';
    protected $useTimestamps = true;
    protected $allowedFields = ['userid','nama','password'];

    public function getAuth($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}