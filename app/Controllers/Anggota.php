<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends BaseController
{
    protected $anggotaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
    }

    protected $navbar = [
        'dashboard' => '',
        'sarana' => '',
        'prasarana' => '',
        'peminjaman' => '',
        'daftarpeminjaman' => '',
        'anggota' => 'active'
    ];

    public function index()
    {
        $data = [
            'title' => 'Anggota | SARPRASKOM',
            'anggota' => $this->anggotaModel->getAnggota(),
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
        ];

        return view('home/anggota', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Anggota | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
        ];
        return view('data/tambahanggota', $data);
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
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
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

    public function export()
    {
        $anggota = $this->anggotaModel->getAnggota();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIS');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Kelas');
        $sheet->setCellValue('E1', 'No Handphone');

        $column = 2;
        foreach ($anggota as $value) {
            $sheet->setCellValue('A'.$column, ($column-1));
            $sheet->setCellValue('B'.$column, $value['nis']);
            $sheet->setCellValue('C'.$column, $value['nama']);
            $sheet->setCellValue('D'.$column, $value['kelas']);
            $sheet->setCellValue('E'.$column, $value['nohp']);
            $column++;
        }

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000']
                ],
            ],
        ];
        $sheet->getStyle('A1:E'.($column-1))->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=anggota.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}