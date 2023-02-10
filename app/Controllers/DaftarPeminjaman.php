<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\SaranaModel;
use App\Models\PrasaranaModel;
use App\Models\AnggotaModel;

class DaftarPeminjaman extends BaseController
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
        // $peminjaman = $this->peminjamanModel->findAll();
        
        $data = [
            'title' => 'Daftar Peminjaman | SARPRASKOM',
            'peminjaman' => $this->peminjamanModel->getPeminjaman(),
            'nama' => session()->get('nama')
        ];

        return view('home/daftarpeminjaman', $data);
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah Peminjaman | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'peminjaman' => $this->peminjamanModel->getPeminjaman($id),
            'sarana' => $this->saranaModel->getSarana(),
            'prasarana' => $this->prasaranaModel->getPrasarana(),
            'anggota' => $this->anggotaModel->getAnggota(),
            'nama' => session()->get('nama')
        ];
        return view('data/ubahpeminjaman', $data);
    }

    public function update($id)
    {
        $peminjamanOld = $this->peminjamanModel->getPeminjaman($id);
        if($peminjamanOld['idpeminjaman'] == $this->request->getVar('idpeminjaman')) {
            $rule_idpeminjaman = 'required';
        } else {
            $rule_idpeminjaman = 'required|is_unique[peminjaman.idpeminjaman]';
        }

        if (!$this->validate([
            'idpeminjaman' => [
                'rules' => $rule_idpeminjaman,
                'errors' => [
                    'required' => 'ID Peminjaman harus diisi.',
                    'is_unique' => 'ID Peminjaman sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('daftarpeminjaman/ubah') . '/' . $id)->withInput()->with('validation', $validation);
        }

        $this->peminjamanModel->save([
            'id' => $id,
            'peminjam' => $this->request->getVar('peminjam'),
            'sarpras' => $this->request->getVar('sarpras'),
            'tglpinjam' => $this->request->getVar('tglpinjam'),
            'tglkembali' => $this->request->getVar('tglkembali'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to(base_url('daftarpeminjaman'));
    }

    public function hapus($id)
    {
        $this->peminjamanModel->delete($id);
        $this->peminjamanModel->query('ALTER TABLE peminjaman AUTO_INCREMENT = 1');
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('daftarpeminjaman'));
    }
}