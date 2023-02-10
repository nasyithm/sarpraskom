<?php 

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $useTimestamps = true;
    protected $allowedFields = ['idpeminjaman','peminjam','sarpras','tglpinjam','tglkembali','status'];

    public function getPeminjaman($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}