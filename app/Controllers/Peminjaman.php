<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\SaranaModel;
use App\Models\PrasaranaModel;
use App\Models\AnggotaModel;

class Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $saranaModel;
    protected $prasaranaModel;
    protected $anggotaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->saranaModel = new SaranaModel();
        $this->prasaranaModel = new PrasaranaModel();
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Peminjaman | SARPRASKOM',
            'peminjaman' => $this->peminjamanModel->getPeminjaman(),
            'sarana' => $this->saranaModel->getSarana(),
            'prasarana' => $this->prasaranaModel->getPrasarana(),
            'anggota' => $this->anggotaModel->getAnggota(),
            'nama' => session()->get('nama')
        ];

        return view('home/peminjaman', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'idpeminjaman' => [
                'rules' => 'required|is_unique[peminjaman.idpeminjaman]',
                'errors' => [
                    'required' => 'ID Peminjaman harus diisi.',
                    'is_unique' => 'ID Peminjaman sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('peminjaman'))->withInput()->with('validation', $validation);
        }

        $this->peminjamanModel->save([
            'idpeminjaman' => $this->request->getVar('idpeminjaman'),
            'peminjam' => $this->request->getVar('peminjam'),
            'sarpras' => $this->request->getVar('sarpras'),
            'tglpinjam' => $this->request->getVar('tglpinjam'),
            'tglkembali' => $this->request->getVar('tglkembali'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to(base_url('peminjaman'));
    }
}
