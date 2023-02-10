<?php

namespace App\Controllers;

use App\Models\SaranaModel;
use App\Models\PrasaranaModel;
use App\Models\PeminjamanModel;
use App\Models\AnggotaModel;

class Dashboard extends BaseController
{
    protected $saranaModel;
    protected $prasaranaModel;
    protected $peminjamanModel;
    protected $anggotaModel;
    public function __construct()
    {
        $this->saranaModel = new SaranaModel();
        $this->prasaranaModel = new PrasaranaModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->anggotaModel = new AnggotaModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Dashboard | SARPRASKOM',
            'sarana' => $this->saranaModel->getSarana(),
            'prasarana' => $this->prasaranaModel->getPrasarana(),
            'peminjaman' => $this->peminjamanModel->getPeminjaman(),
            'anggota' => $this->anggotaModel->getAnggota(),
            'nama' => session()->get('nama')
        ];
        
        return view('home/dashboard', $data);
    }
}