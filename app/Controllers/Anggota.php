<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    protected $anggotaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    public function index()
    {
        // $anggota = $this->anggotaModel->findAll();
        
        $data = [
            'title' => 'Anggota | SARPRASKOM',
            'anggota' => $this->anggotaModel->getAnggota(),
            'nama' => session()->get('nama')
        ];

        return view('home/anggota', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Anggota | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'nama' => session()->get('nama')
        ];
        return view('data/dataanggota', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nis' => [
                'rules' => 'required|is_unique[anggota.nis]',
                'errors' => [
                    'required' => 'NIS anggota harus diisi.',
                    'is_unique' => 'NIS anggota sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('anggota/tambah'))->withInput()->with('validation', $validation);
        }

        $this->anggotaModel->save([
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'nohp' => $this->request->getVar('nohp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to(base_url('anggota'));
    }

    public function ubah($id)
    {
        $data = [
            'title' => 'Ubah Anggota | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'anggota' => $this->anggotaModel->getAnggota($id),
            'nama' => session()->get('nama')
        ];
        return view('data/ubahanggota', $data);
    }

    public function update($id)
    {
        $anggotaOld = $this->anggotaModel->getAnggota($id);
        if($anggotaOld['nis'] == $this->request->getVar('nis')) {
            $rule_nis = 'required';
        } else {
            $rule_nis = 'required|is_unique[anggota.nis]';
        }

        if (!$this->validate([
            'nis' => [
                'rules' => $rule_nis,
                'errors' => [
                    'required' => 'NIS anggota harus diisi.',
                    'is_unique' => 'NIS anggota sudah ada.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('anggota/ubah') . '/' . $id)->withInput()->with('validation', $validation);
        }

        $this->anggotaModel->save([
            'id' => $id,
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'kelas' => $this->request->getVar('kelas'),
            'nohp' => $this->request->getVar('nohp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to(base_url('anggota'));
    }

    public function hapus($id)
    {
        $this->anggotaModel->delete($id);
        $this->anggotaModel->query('ALTER TABLE anggota AUTO_INCREMENT = 1');
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url('anggota'));
    }
}