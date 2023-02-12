<?php

namespace App\Controllers;

use App\Models\PrasaranaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Prasarana extends BaseController
{
    protected $prasaranaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->prasaranaModel = new PrasaranaModel();
    }

    protected $navbar = [
        'dashboard' => '',
        'sarana' => '',
        'prasarana' => 'active',
        'peminjaman' => '',
        'daftarpeminjaman' => '',
        'anggota' => ''
    ];

    public function index()
    { 
        $data = [
            'title' => 'Prasarana | SARPRASKOM',
            'prasarana' => $this->prasaranaModel->getPrasarana(),
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
        ];

        return view('home/prasarana', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Prasarana | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
        ];
        return view('data/tambahprasarana', $data);
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
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
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

    public function export()
    {
        $prasarana = $this->prasaranaModel->getPrasarana();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Spesifikasi');
        $sheet->setCellValue('E1', 'Jumlah');

        $column = 2;
        foreach ($prasarana as $value) {
            $sheet->setCellValue('A'.$column, ($column-1));
            $sheet->setCellValue('B'.$column, $value['kode']);
            $sheet->setCellValue('C'.$column, $value['nama']);
            $sheet->setCellValue('D'.$column, $value['spesifikasi']);
            $sheet->setCellValue('E'.$column, $value['jumlah']);
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
        header('Content-Disposition: attachment;filename=prasarana.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}