<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapPresensi extends BaseController
{
    public function rekap_harian()
    {
        $presensi_model = new PresensiModel();
        $filter_tanggal = $this->request->getVar('filter_tanggal');

        if ($filter_tanggal) {
            if(isset($_GET['excel'])){
                $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);

                $spreadsheet = new Spreadsheet();
                $activeWorksheet = $spreadsheet->getActiveSheet();
                
                $activeWorksheet->getColumnDimension('A')->setWidth(5);
                $activeWorksheet->getColumnDimension('B')->setWidth(30);
                $activeWorksheet->getColumnDimension('C')->setWidth(15);
                $activeWorksheet->getColumnDimension('D')->setWidth(12);
                $activeWorksheet->getColumnDimension('E')->setWidth(15);
                $activeWorksheet->getColumnDimension('F')->setWidth(12);
                $activeWorksheet->getColumnDimension('G')->setWidth(20);
                $activeWorksheet->getColumnDimension('H')->setWidth(20);
                
                $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
                $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
                $spreadsheet->getActiveSheet()->mergeCells('C3:E3');
                
                $titleStyle = [
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ],
                ];
                $activeWorksheet->getStyle('A1:H1')->applyFromArray($titleStyle);
                $activeWorksheet->getRowDimension(1)->setRowHeight(30);
                
                $activeWorksheet->setCellValue('A1', 'REKAP PRESENSI HARIAN');
                $activeWorksheet->setCellValue('A3', 'TANGGAL');
                $activeWorksheet->setCellValue('C3', $filter_tanggal);
                
                $headers = ['NO', 'NAMA PEGAWAI', 'TANGGAL MASUK', 'JAM MASUK', 'TANGGAL KELUAR', 'JAM KELUAR', 'TOTAL JAM KERJA', 'TOTAL TERLAMBAT'];
                $col = 'A';
                foreach ($headers as $header) {
                    $activeWorksheet->setCellValue($col . '4', $header);
                    $col++;
                }
                
                $headerStyle = [
                    'font' => ['bold' => true],
                ];
                $activeWorksheet->getStyle('A4:H4')->applyFromArray($headerStyle);
                $activeWorksheet->getRowDimension(4)->setRowHeight(20);

                $rows = 5;
                $no = 1;
                
                foreach ($rekap_harian as $rekap) {
                    $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'] . $rekap['jam_masuk']);
                    $timestamp_jam_keluar = strtotime($rekap['tanggal_keluar'] . $rekap['jam_keluar']);
                    $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
                    $jam = floor($selisih / 3600);
                    $selisih -= $jam * 3600;
                    $menit = floor($selisih / 60);

                    $jam_masuk_real = strtotime($rekap['jam_masuk']);
                    $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                    $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
                    $jam_terlambat = floor($selisih_terlambat / 3600);
                    $selisih_terlambat -= $jam_terlambat * 3600;
                    $menit_terlambat = floor($selisih_terlambat / 60);

                    $activeWorksheet->setCellValue('A' . $rows, $no);
                    $activeWorksheet->setCellValue('B' . $rows, $rekap['nama']);
                    $activeWorksheet->setCellValue('C' . $rows, $rekap['tanggal_masuk']);
                    $activeWorksheet->setCellValue('D' . $rows, $rekap['jam_masuk']);
                    $activeWorksheet->setCellValue('E' . $rows, $rekap['tanggal_keluar']);
                    $activeWorksheet->setCellValue('F' . $rows, $rekap['jam_keluar']);
                    $activeWorksheet->setCellValue('G' . $rows, $jam . ' Jam ' . $menit . ' Menit ');
                    $activeWorksheet->setCellValue('H' . $rows, $jam_terlambat . ' Jam ' . $menit_terlambat . ' Menit ');
                    
                    
                    $rows++;
                    $no++;
                }

                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Rekap_Presensi_Harian_' . $filter_tanggal . '.xlsx"');
                header('Cache-Control: max-age=0');
                
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save('php://output');

            } else{
                $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
            }
        } else {
            $rekap_harian = $presensi_model->rekap_harian();
        }

        $data = [
            'title' => 'Rekap Harian',
            'tanggal' => $filter_tanggal,
            'rekap_harian' => $rekap_harian
        ];

        return view('admin/rekap_presensi/rekap_harian', $data);
    }

    public function rekap_bulanan()
    {
        $presensi_model = new PresensiModel();
        $filter_bulan = $this->request->getVar('filter_bulan');
        $filter_tahun = $this->request->getVar('filter_tahun');

        if ($filter_bulan && $filter_tahun) {
            if(isset($_GET['excel'])){
                $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
    
                $spreadsheet = new Spreadsheet();
                $activeWorksheet = $spreadsheet->getActiveSheet();
                
                $activeWorksheet->getColumnDimension('A')->setWidth(5);
                $activeWorksheet->getColumnDimension('B')->setWidth(30);
                $activeWorksheet->getColumnDimension('C')->setWidth(15);
                $activeWorksheet->getColumnDimension('D')->setWidth(12);
                $activeWorksheet->getColumnDimension('E')->setWidth(15);
                $activeWorksheet->getColumnDimension('F')->setWidth(12);
                $activeWorksheet->getColumnDimension('G')->setWidth(20);
                $activeWorksheet->getColumnDimension('H')->setWidth(20);
                
                $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
                $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
                $spreadsheet->getActiveSheet()->mergeCells('C3:E3');
                
                $titleStyle = [
                    'font' => [
                        'bold' => true,
                        'size' => 14
                    ]
                ];
                $activeWorksheet->getStyle('A1:H1')->applyFromArray($titleStyle);
                $activeWorksheet->getRowDimension(1)->setRowHeight(30);
    
                $bulan_array = [
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
                    '04' => 'April', '05' => 'Mei', '06' => 'Juni',
                    '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
                    '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                ];
                $nama_bulan = $bulan_array[$filter_bulan];
                
                $activeWorksheet->setCellValue('A1', 'REKAP PRESENSI BULANAN');
                $activeWorksheet->setCellValue('A3', 'PERIODE');
                $activeWorksheet->setCellValue('C3', $nama_bulan . ' ' . $filter_tahun);
                
                $headers = ['NO', 'NAMA PEGAWAI', 'TANGGAL MASUK', 'JAM MASUK', 'TANGGAL KELUAR', 'JAM KELUAR', 'TOTAL JAM KERJA', 'TOTAL TERLAMBAT'];
                $col = 'A';
                foreach ($headers as $header) {
                    $activeWorksheet->setCellValue($col . '4', $header);
                    $col++;
                }
                
                $headerStyle = [
                    'font' => ['bold' => true]
                ];
                $activeWorksheet->getStyle('A4:H4')->applyFromArray($headerStyle);
                $activeWorksheet->getRowDimension(4)->setRowHeight(20);
    
                $rows = 5;
                $no = 1;
                
                foreach ($rekap_bulanan as $rekap) {
                    $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                    $timestamp_jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                    $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
                    $jam = floor($selisih / 3600);
                    $selisih -= $jam * 3600;
                    $menit = floor($selisih / 60);
    
                    $jam_masuk_real = strtotime($rekap['jam_masuk']);
                    $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                    $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
                    $jam_terlambat = floor($selisih_terlambat / 3600);
                    $selisih_terlambat -= $jam_terlambat * 3600;
                    $menit_terlambat = floor($selisih_terlambat / 60);
    
                    $activeWorksheet->setCellValue('A' . $rows, $no);
                    $activeWorksheet->setCellValue('B' . $rows, $rekap['nama']);
                    $activeWorksheet->setCellValue('C' . $rows, $rekap['tanggal_masuk']);
                    $activeWorksheet->setCellValue('D' . $rows, $rekap['jam_masuk']);
                    $activeWorksheet->setCellValue('E' . $rows, $rekap['tanggal_keluar']);
                    $activeWorksheet->setCellValue('F' . $rows, $rekap['jam_keluar']);
                    $activeWorksheet->setCellValue('G' . $rows, $jam . ' Jam ' . $menit . ' Menit');
                    $activeWorksheet->setCellValue('H' . $rows, $jam_terlambat . ' Jam ' . $menit_terlambat . ' Menit');
                    
                    if ($rows == (count($rekap_bulanan) + 4)) {
                        $rows += 2;
                        $activeWorksheet->setCellValue('A' . $rows, 'SUMMARY:');
                        $activeWorksheet->mergeCells('A' . $rows . ':B' . $rows);
                        $activeWorksheet->getStyle('A' . $rows)->getFont()->setBold(true);
                        
                        $rows++;
                        $activeWorksheet->setCellValue('A' . $rows, 'Total Hari Kerja:');
                        $activeWorksheet->setCellValue('C' . $rows, count($rekap_bulanan) . ' Hari');
                        $activeWorksheet->mergeCells('A' . $rows . ':B' . $rows);
                    }
                    
                    $rows++;
                    $no++;
                }
    
                $activeWorksheet->getPageSetup()->setPrintArea('A1:H' . ($rows - 1));
                
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="Rekap_Presensi_Bulanan_' . $nama_bulan . '_' . $filter_tahun . '.xlsx"');
                header('Cache-Control: max-age=0');
                
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save('php://output');
    
            } else {
                $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
            }
        } else {
            $rekap_bulanan = $presensi_model->rekap_bulanan();
        }

        $data = [
            'title' => 'Rekap Bulanan',
            'bulan' => $filter_bulan,
            'tahun' => $filter_tahun,
            'rekap_bulanan' => $rekap_bulanan
        ];

        return view('admin/rekap_presensi/rekap_bulanan', $data);
    }
}
