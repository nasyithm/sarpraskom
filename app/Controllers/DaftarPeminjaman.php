<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\SaranaModel;
use App\Models\PrasaranaModel;
use App\Models\AnggotaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        if ($peminjamanOld['idpeminjaman'] == $this->request->getVar('idpeminjaman')) {
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

    public function export()
    {
        $daftarpeminjaman = $this->peminjamanModel->getPeminjaman();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Peminjaman');
        $sheet->setCellValue('C1', 'Peminjam');
        $sheet->setCellValue('D1', 'Sarpras');
        $sheet->setCellValue('E1', 'Tanggal Pinjam');
        $sheet->setCellValue('F1', 'Tanggal Kembali');
        $sheet->setCellValue('G1', 'Status');

        $column = 2;
        foreach ($daftarpeminjaman as $value) {
            $sheet->setCellValue('A'.$column, ($column-1));
            $sheet->setCellValue('B'.$column, $value['idpeminjaman']);
            $sheet->setCellValue('C'.$column, $value['peminjam']);
            $sheet->setCellValue('D'.$column, $value['sarpras']);
            $sheet->setCellValue('E'.$column, $value['tglpinjam']);
            $sheet->setCellValue('F'.$column, $value['tglkembali']);
            $sheet->setCellValue('G'.$column, $value['status']);
            $column++;
        }

        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000']
                ],
            ],
        ];
        $sheet->getStyle('A1:G'.($column-1))->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=daftarpeminjaman.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
