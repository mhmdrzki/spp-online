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
class Pembangunan extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Siswa_model', 'Pembangunan_model'));
        $this->load->helper(array('form', 'url'));

    }

    // Pembangunan view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
        $f = $this->input->get(NULL, TRUE);

        $data['f'] = $f;

        $params = array();
        // nis
        if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
            $params['siswa_nama'] = $f['n'];
        }

        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['siswa'] = $this->Siswa_model->get($params);
        

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/pembangunan/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Siswa_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Pembangunan';
        $data['main'] = 'admin/pembangunan/pembangunan_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($nisn = NULL) {
        if ($this->Pembangunan_model->get(array('siswa_nisn' => $nisn)) == NULL) {
            redirect('admin/pembangunan');
        }
        $data['siswa'] = $this->Siswa_model->get(array('siswa_nisn' => $nisn));
        $data['pembangunan'] = $this->Pembangunan_model->get(array('siswa_nisn' => $nisn));
        $data['title'] = 'Detail Pembangunan';
        $data['main'] = 'admin/pembangunan/pembangunan_detail';
        $this->load->view('admin/layout', $data);
    }

    // Pembayaran Uang Pembangunan


    public function add($nisn = NULL) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nisn', 'NISN', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_byr', 'Tanggal Pembayaran', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jml_byr', 'Jumlah Bayar', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bendahara', 'Nama Bendahara', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
       
        
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $params['kode_bayar'] = $this->input->post('kode_bayar');
            $params['siswa_nisn'] = $this->input->post('nisn');
            $params['tgl_byr'] = $this->input->post('tgl_byr');
            $params['jmlh_byr'] = $this->input->post('jml_byr');
            $params['bendahara'] = $this->input->post('bendahara');
            $params['id_pembangunan'] = $this->input->post('id_pembangunan');
            
            $config['upload_path']          = './img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['file_name']             = $this->input->post('kode_bayar');
            $config['max_width']             = 1024;
            $config['max_height']             = 768;
 
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $params['bukti_bayar'] = $file['file_name'];

            $status = $this->Pembangunan_model->add($params);


           

            $this->session->set_flashdata('success', ' Pembayaran berhasil');
            redirect('admin/pembangunan');
        } else {

            

            if($this->Pembangunan_model->get(array('siswa_nisn' => $nisn))){
                $data['pembangunan'] = $this->Pembangunan_model->get(array('siswa_nisn' => $nisn));               
            }
            $cek_kode = $this->Pembangunan_model->cek_kode();
            $kodeBarang = $cek_kode['maxKode'];
            $noUrut = (int) substr($kodeBarang, 3, 3);
            $noUrut++;

            $char = "BGN";
            $kodeBarang = $char . sprintf("%03s", $noUrut);
            


            $data['kode_bayar'] =  $kodeBarang;
            $data['siswa'] = $this->Siswa_model->get(array('siswa_nisn' => $nisn));
            $data['title']  =' Pembayaran Uang Pembangunan';
            $data['main']   = 'admin/Pembangunan/bayar';
            $this->load->view('admin/layout', $data);
        }
    }

    // Delete jns_byr
    public function delete($nisn = NULL) {
        if (isset($nisn)) {
            $this->Pembangunan_model->delete($nisn);
            
            $this->session->set_flashdata('success', 'Hapus posting berhasil');
            redirect('admin/pembangunan');
        } else{
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/pembangunan/edit/' . $nisn);
        }
    }
   
}

/* End of file jns_byr.php */
/* Location: ./application/controllers/admin/pembangunan.php */
