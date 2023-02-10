<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Profil extends BaseController
{
    protected $authModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profil | SARPRASKOM',
            'id' => session()->get('id'),
            'userid' => session()->get('userid'),
            'nama' => session()->get('nama')
        ];

        return view('home/profil', $data);
    }

    public function ubah()
    {
        $data = [
            'title' => 'Ubah Profil | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'id' => session()->get('id'),
            'userid' => session()->get('userid'),
            'nama' => session()->get('nama')
        ];

        return view('data/ubahprofil', $data);
    }

    public function update($id)
    {
        $profilOld = session()->get('userid');
        if($profilOld == $this->request->getVar('userid')) {
            $rule_userid = 'required';
        } else {
            $rule_userid = 'required|is_unique[akun.userid]';
        }

        if (!$this->validate([
            'userid' => [
                'rules' => $rule_userid,
                'errors' => [
                    'required' => 'UserID harus diisi.',
                    'is_unique' => 'UserID sudah terdaftar.'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]|matches[ulangpass]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password minimal 6 karakter.',
                    'matches' => 'Password tidak sama.'
                ]
            ],
            'ulangpass' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Ulangi Password harus diisi.',
                    'matches' => 'Ulangi Password tidak sama.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('profil/ubah') . '/' . $id)->withInput()->with('validation', $validation);
        }

        $this->authModel->save([
            'id' => $id,
            'userid' => htmlspecialchars($this->request->getVar('userid')),
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        $userid = $this->request->getVar('userid');
        $session = session();

        $data = $this->authModel->where('userid', $userid)->first();
        $ses_data = [
            'id' => $data['id'],
            'userid' => $data['userid'],
            'nama' => $data['nama'],
            'logged_in' => TRUE
        ];
        $session->set($ses_data);
        $session->setFlashdata('pesan', 'Akun Anda berhasil diubah.');

        return redirect()->to(base_url('profil'));
    }

    public function hapus($id)
    {
        $this->authModel->delete($id);
        $this->authModel->query('ALTER TABLE akun AUTO_INCREMENT = 1');
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}