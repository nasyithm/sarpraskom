<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
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
            'title' => 'SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'msg_user' => session()->getFlashdata('msg_user'),
            'msg_pass' => session()->getFlashdata('msg_pass')
        ];

        return view('auth/login', $data);
    }

    public function login()
    {
        if (!$this->validate([
            'userid' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'UserID harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/'))->withInput()->with('validation', $validation);
        }

        $session = session();
        $userid = $this->request->getVar('userid');
        $password = $this->request->getVar('password');
        $data = $this->authModel->where('userid', $userid)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'nama' => $data['nama'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('dashboard'));
            } else {
                $session->setFlashdata('msg_pass', 'Password salah');
                return redirect()->to(base_url('/'))->withInput();
            }
        } else {
            $session->setFlashdata('msg_user', 'Username tidak ditemukan');
            return redirect()->to(base_url('/'))->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }

    public function registrasi()
    {
        $data = [
            'title' => 'Registrasi | SARPRASKOM',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/registrasi', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'userid' => [
                'rules' => 'required|is_unique[akun.userid]',
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
                    'required' => 'Ulangi password harus diisi.',
                    'matches' => 'Ulangi password tidak sama.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('registrasi'))->withInput()->with('validation', $validation);
        }

        $this->authModel->save([
            'userid' => htmlspecialchars($this->request->getVar('userid')),
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('pesan', 'Selamat akun Anda berhasil dibuat. Silahkan Login!');

        return redirect()->to(base_url('/'));
    }
}
