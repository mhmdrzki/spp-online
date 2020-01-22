<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * jns_byr controllers class
 *
 * @package     CMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */
class Laporanpdf extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Siswa_model', 'Pengeluaran_model', 'Pembangunan_model', 'Spp_model'));
        $this->load->library('pdf');
    }

    public function index($id = NULL) {
    
             
            $data['main'] = 'admin/laporanpdf/cetak_laporan';
            $this->load->view('admin/layout', $data);
        
    }

    function cetak(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('date_start', 'Dari Tanggal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_end', 'Sampai Tanggal', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis', 'Jenis Laporan', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        
        $status = null;
        $jenis = null;
        $dari =$this->input->post('date_start');

       
         // $pecah = explode("-", $dari);
         // //mencari element array 0
         // $hasil = $pecah[0];

        $sampai = $this->input->post('date_end');

        if ($_POST AND $this->form_validation->run() == TRUE) {

            
            $params['date_start'] = $this->input->post('date_start');
            $params['date_end'] = $this->input->post('date_end');
            $jenis = $this->input->post('jenis');
            
            
            $status = $this->$jenis->get($params);


            // $this->session->set_flashdata('success', $data['operation'] . ' posting berhasil');
            // redirect('admin/laporanpdf');
        }

        $pdf = new FPDF('l','mm','A5');
        // membuat halaman baru
        $pdf->AddPage('P', 'A5');

        $logo = media_url().'/images/tut-wuri.png';
        $pdf->Image($logo,10,10,20,25);  

        $pdf->Cell(25);
        $pdf->SetFont('Times','B','12');
        $pdf->Cell(0,5,'PEMERINTAH KOTA PEKANBARU',0,1,'C');
        $pdf->Cell(25);
        $pdf->Cell(0,5,'DINAS PENDIDIKAN',0,1,'C');
        $pdf->Cell(25);
        $pdf->SetFont('Times','B','15');
        $pdf->Cell(0,5,'SEKOLAH MENENGAH ATAS NEGERI 4',0,1,'C');
        $pdf->Cell(25);
        $pdf->SetFont('Times','I','8');
        $pdf->Cell(0,5,'Jambat Balo Pagar Alam Selatan Kota Pagar Alam Telp. (0730)622442',0,1,'C');
        $pdf->Cell(25);
        $pdf->Cell(0,2,'Website: http://sman4pagaralam.sch.id | E-Mail: smanegeri4pagaralam@gmail.com',0,1,'C');


        

        $pdf->SetLineWidth(1);
        $pdf->Line(10,36,138,36);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,37,138,37);

         $siswa = null;
        if($jenis == 'Spp_model'){

            $total_spp      = $this->Spp_model->get();
            $ttl_msk = null;
                    foreach ($total_spp as $row) {
                        $ttl_msk = $ttl_msk+$row['total_biaya'];
                    }


            $pdf->Cell(10,5,'',0,1);

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,10,'Laporan Pembayaran Uang SPP',0,1,'C');
            
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(5,6,'No',1,0);
            $pdf->Cell(15,6,'Kode Bayar',1,0);
            $pdf->Cell(22,6,'Nama Siswa',1,0);
            $pdf->Cell(14,6,'NISN',1,0,'C');
            $pdf->Cell(19,6,'Tanggal Bayar',1,0);
            $pdf->Cell(14,6,'Bulan SPP',1,0);
            $pdf->Cell(20,6,'Bendahara',1,0);
            $pdf->Cell(20,6,'Total Bayar',1,1);
            $pdf->SetFont('Arial','',6);
            $i=1;
            // 129

            foreach ($status as $row){

            $siswa = $this->Siswa_model->get(array('kode_siswa' => $row['kode_siswa']));          
            
                $pdf->Cell(5,6,$i,1,0);
                $pdf->Cell(15,6,$row['kode_bayar'],1,0);
                $pdf->Cell(22,6,$siswa['siswa_nama'],1,0);
                $pdf->Cell(14,6,$siswa['siswa_nisn'],1,0);
                $pdf->Cell(19,6,$row['tgl_byr'],1,0);

            $detail = $this->Spp_model->getdetail(array('kode_bayar' => $row['kode_bayar']));
            $bulan=count($detail);
            
                $pdf->Cell(14,6,$bulan.' Bulan',1,0);
                $pdf->Cell(20,6,$row['bendahara'],1,0);
                $pdf->Cell(20,6,'Rp. '.$row['total_biaya'],1,1);
                $i++;
            }
                $pdf->Cell(109,6,'TOTAL',1,0,'C');
                
                $pdf->Cell(20,6,'Rp. '.$ttl_msk,1,1);

        }
        elseif ($jenis == 'Pembangunan_model') {
            
            $total_bangun   = $this->Pembangunan_model->get();
            $ttl_msk = null;
                    foreach ($total_bangun as $row) {
                        $ttl_msk = $ttl_msk+$row['jmlh_byr'];
                    }

            $pdf->Cell(10,7,'',0,1);

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,10,'Laporan Pembayaran Uang Pembangunan',0,1,'C');

            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(8,6,'No',1,0);
            $pdf->Cell(20,6,'Kode Bayar',1,0);
            $pdf->Cell(25,6,'Nama Siswa',1,0);
            $pdf->Cell(16,6,'NISN',1,0,'C');
            $pdf->Cell(21,6,'Tanggal Bayar',1,0);
            $pdf->Cell(21,6,'Bendahara',1,0);
            $pdf->Cell(18,6,'Jumlah Bayar',1,1);
            $pdf->SetFont('Arial','',6);
            $i=1;

            foreach ($status as $row){

            $siswa = $this->Siswa_model->get(array('siswa_nisn' => $row['siswa_nisn']));
                $pdf->Cell(8,6,$i,1,0);
                $pdf->Cell(20,6,$row['kode_bayar'],1,0);
                $pdf->Cell(25,6,$siswa['siswa_nama'],1,0);
                $pdf->Cell(16,6,$siswa['siswa_nisn'],1,0);
                $pdf->Cell(21,6,$row['tgl_byr'],1,0);
                $pdf->Cell(21,6,$row['bendahara'],1,0);
                $pdf->Cell(18,6,'Rp. '.$row['jmlh_byr'],1,1);
                $i++;
            }

            $pdf->Cell(111,6,'TOTAL',1,0,'C');
                
            $pdf->Cell(18,6,'Rp. '.$ttl_msk,1,1); 
        }
        elseif ($jenis == 'Pengeluaran_model') {
            
            $total_keluar   = $this->Pengeluaran_model->get();
            $ttl_keluar = null;
                    foreach ($total_keluar as $row) {
                        $ttl_keluar = $ttl_keluar+$row['biaya'];
                    }
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10,7,'',0,1);

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,10,'Laporan Pengeluaran',0,1,'C');

            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(8,6,'No',1,0);
            $pdf->Cell(27,6,'No. Pengeluaran',1,0);
            $pdf->Cell(18,6,'Tanggal',1,0);
            $pdf->Cell(37,6,'Keterangan',1,0);
            $pdf->Cell(21,6,'Bendahara',1,0);
            $pdf->Cell(18,6,'Biaya',1,1);
            $pdf->SetFont('Arial','',7);
            $i=1;


            foreach ($status as $row){
                $pdf->Cell(8,6,$i,1,0);
                $pdf->Cell(27,6,$row['kode_keluar'],1,0);
                $pdf->Cell(18,6,$row['tgl_pengeluaran'],1,0);
                $pdf->Cell(37,6,$row['ket'],1,0);
                $pdf->Cell(21,6,$row['bendahara'],1,0);
                $pdf->Cell(18,6,'Rp. '.$row['biaya'],1,1);
                $i++;
            }

            $pdf->Cell(111,6,'TOTAL',1,0,'C');
                
            $pdf->Cell(18,6,'Rp. '.$ttl_keluar,1,1);
        }        
        
        $pdf->Output();
    }

    
   
}
