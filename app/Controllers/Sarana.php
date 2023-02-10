<?php

namespace App\Controllers;

use App\Models\SaranaModel;

class Sarana extends BaseController
{
    protected $saranaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->saranaModel = new SaranaModel();
    }

    public function index()
    {
        // $sarana = $this->saranaModel->findAll();
        
        $data = [
            'title' => 'Sarana | SARPRASKOM',
            'sarana' => $this->saranaModel->getSarana(),
            'nama' => session()->get('nama')
        ];

        return view('home/sarana', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Sarana | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'nama' => session()->get('nama')
        ];
        return view('data/datasarana', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kode' => [
                'rules' => 'required|is_unique[sarana.kode]',
                'errors' => [
                    'required' => 'Kode sarana harus diisi.',
                    'is_unique' => 'Kode sarana sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('sarana/tambah'))->withInput()->with('validation', $validation);
        }

        $this->saranaModel->save([
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'spesifikasi' => $this->request->getVar('spesifikasi'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to(base_url('sarana'));
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah Sarana | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'sarana' => $this->saranaModel->getSarana($id),
            'nama' => session()->get('nama')
        ];
        return view('data/ubahsarana', $data);
    }

    public function update($id)
    {
        $saranaOld = $this->saranaModel->getSarana($id);
        if($saranaOld['kode'] == $this->request->getVar('kode')) {
            $rule_kode = 'required';
        } else {
            $rule_kode = 'required|is_unique[sarana.kode]';
        }

        if (!$this->validate([
            'kode' => [
                'rules' => $rule_kode,
                'errors' => [
                    'required' => 'Kode sarana harus diisi.',
                    'is_unique' => 'Kode sarana sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('sarana/ubah') . '/' . $id)->withInput()->with('validation', $validation);
        }

        $this->saranaModel->save([
            'id' => $id,
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'spesifikasi' => $this->request->getVar('spesifikasi'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to(base_url('sarana'));
    }

    public function hapus($id)
    {
        $this->saranaModel->delete($id);
        $this->saranaModel->query('ALTER TABLE sarana AUTO_INCREMENT = 1');
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('sarana'));
    }
}