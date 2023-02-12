<?php

namespace App\Controllers;

use App\Models\SaranaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sarana extends BaseController
{
    protected $saranaModel;
    protected $helpers = ['form'];
    public function __construct()
    {
        $this->saranaModel = new SaranaModel();
    }

    protected $navbar = [
        'dashboard' => '',
        'sarana' => 'active',
        'prasarana' => '',
        'peminjaman' => '',
        'daftarpeminjaman' => '',
        'anggota' => ''
    ];

    public function index()
    {
        $data = [
            'title' => 'Sarana | SARPRASKOM',
            'sarana' => $this->saranaModel->getSarana(),
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
        ];

        return view('home/sarana', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Sarana | SARPRASKOM',
            'validation' => \Config\Services::validation(),
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
        ];
        return view('data/tambahsarana', $data);
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
            'nama' => session()->get('nama'),
            'navbar' => $this->navbar
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

    public function export()
    {
        $sarana = $this->saranaModel->getSarana();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Spesifikasi');
        $sheet->setCellValue('E1', 'Jumlah');

        $column = 2;
        foreach ($sarana as $value) {
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
        header('Content-Disposition: attachment;filename=sarana.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}