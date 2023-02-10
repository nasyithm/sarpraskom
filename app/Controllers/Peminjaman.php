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

        $sarpras = $this->request->getVar('sarpras');
        $sarana = $this->saranaModel->getSarana();
        $prasarana = $this->prasaranaModel->getPrasarana();
        foreach ($sarana as $s) {
            foreach ($prasarana as $p) {
                if ($sarpras == $p['nama']) {
                    $jml_prasarana = intval($p['jumlah']) - 1;

                    $this->prasaranaModel->save([
                        'id' => $p['id'],
                        'kode' => $p['kode'],
                        'nama' => $p['nama'],
                        'spesifikasi' => $p['spesifikasi'],
                        'jumlah' => $jml_prasarana
                    ]);
                }
            }

            if ($sarpras == $s['nama']) {
                $jml_sarana = intval($s['jumlah']) - 1;

                $this->saranaModel->save([
                    'id' => $s['id'],
                    'kode' => $s['kode'],
                    'nama' => $s['nama'],
                    'spesifikasi' => $s['spesifikasi'],
                    'jumlah' => $jml_sarana
                ]);
            }
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to(base_url('peminjaman'));
    }
}
