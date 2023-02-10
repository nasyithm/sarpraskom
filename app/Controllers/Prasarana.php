<?php

namespace App\Controllers;

use App\Models\PrasaranaModel;

class Prasarana extends BaseController
{
    protected $prasaranaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->prasaranaModel = new PrasaranaModel();
    }

    public function index()
    {
        // $prasarana = $this->prasaranaModel->findAll();
        
        $data = [
            'title' => 'Prasarana | SARPRASKOM',
            'prasarana' => $this->prasaranaModel->getPrasarana(),
            'nama' => session()->get('nama')
        ];

        return view('home/prasarana', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Prasarana | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'nama' => session()->get('nama')
        ];
        return view('data/dataprasarana', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'kode' => [
                'rules' => 'required|is_unique[prasarana.kode]',
                'errors' => [
                    'required' => 'Kode prasarana harus diisi.',
                    'is_unique' => 'Kode prasarana sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('prasarana/tambah'))->withInput()->with('validation', $validation);
        }

        $this->prasaranaModel->save([
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'spesifikasi' => $this->request->getVar('spesifikasi'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to(base_url('prasarana'));
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah Prasarana | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'prasarana' => $this->prasaranaModel->getPrasarana($id),
            'nama' => session()->get('nama')
        ];
        return view('data/ubahprasarana', $data);
    }

    public function update($id)
    {
        $prasaranaOld = $this->prasaranaModel->getPrasarana($id);
        if($prasaranaOld['kode'] == $this->request->getVar('kode')) {
            $rule_kode = 'required';
        } else {
            $rule_kode = 'required|is_unique[prasarana.kode]';
        }

        if (!$this->validate([
            'kode' => [
                'rules' => $rule_kode,
                'errors' => [
                    'required' => 'Kode prasarana harus diisi.',
                    'is_unique' => 'Kode prasarana sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('prasarana/ubah') . '/' . $id)->withInput()->with('validation', $validation);
        }

        $this->prasaranaModel->save([
            'id' => $id,
            'kode' => $this->request->getVar('kode'),
            'nama' => $this->request->getVar('nama'),
            'spesifikasi' => $this->request->getVar('spesifikasi'),
            'jumlah' => $this->request->getVar('jumlah')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to(base_url('prasarana'));
    }

    public function hapus($id)
    {
        $this->prasaranaModel->delete($id);
        $this->prasaranaModel->query('ALTER TABLE prasarana AUTO_INCREMENT = 1');
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('prasarana'));
    }
}