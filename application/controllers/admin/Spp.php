<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * siswa controllers class
 *
 * @package     CMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */
class Spp extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Spp_model', 'Siswa_model', 'Spp_model'));
        $this->load->helper(array('form', 'url'));
    }

    // siswa view in list
    public function index($offset = NULL) {
        $this->load->library('pagination');
        // Apply Filter
        // Get $_GET variable
        $f = $this->input->get(NULL, TRUE);

        $data['f'] = $f;

        $params = array();
        // nis
        if (isset($f['n']) && !empty($f['n']) && $f['n'] != '') {
            

            $siswa = $this->Siswa_model->get(array('siswa_nisn' => $f['n']));
                                        
            $params['kode_siswa'] = $siswa['kode_siswa'];
        }

        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['spp'] = $this->Spp_model->get($params);

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/spp/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Spp_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Spp';
        $data['main'] = 'admin/spp/spp_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($kode = NULL) {
        if ($this->Spp_model->get(array('kode_bayar' => $kode)) == NULL) {
            redirect('admin/spp');
        }
        $data['spp'] = $this->Spp_model->get(array('kode_bayar' => $kode));
        $data['title'] = 'Detail spp';
        $data['main'] = 'admin/spp/spp_detail';
        $this->load->view('admin/layout', $data);
    }

    // Add siswa and Update
    public function add($kode = NULL) {
        $this->load->library('form_validation');
        
        
       
        $this->form_validation->set_rules('kode_siswa', 'Kode Siswa', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tgl_byr', 'Tanggal Pembayaran', 'trim|required|xss_clean');
        $this->form_validation->set_rules('tahun_spp', 'Tahun Ajaran', 'trim|required|xss_clean');
        $this->form_validation->set_rules('biaya_spp', 'Biaya SPP', 'trim|required|xss_clean');
        $this->form_validation->set_rules('total_biaya', 'Total Biaya', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bendahara', 'Nama Bendahara', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($kode) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            
            $params['kode_bayar'] = $this->input->post('kode_bayar');
            $params['kode_siswa'] = $this->input->post('kode_siswa');
            $params['tgl_byr'] = $this->input->post('tgl_byr');
            $params['biaya_spp'] = $this->input->post('biaya_spp');
            $params['total_biaya'] = $this->input->post('total_biaya');
            $params['bendahara'] = $this->input->post('bendahara');
            $params['id_spp'] = $this->input->post('id_spp');
            
            $config['upload_path']          = './img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']        = $this->input->post('kode_bayar');
            $config['max_size']             = 1024;
            $config['max_width']             = 1024;
            $config['max_height']             = 768;
 
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
            $data = array('upload_data' => $this->upload->data());
            $file = $this->upload->data();
            $params['bukti_bayar'] = $file['file_name'];
            

            $status = $this->Spp_model->add($params);
            $this->Spp_model->del_detail($this->input->post('kode_bayar'));

            $bulan_spp = $this->input->post('bulan_spp');
            $detail['kode_bayar'] = $this->input->post('kode_bayar');
            $detail['kode_siswa'] = $this->input->post('kode_siswa');
            $detail['tahun'] = $this->input->post('tahun_spp');
            foreach ($bulan_spp as $row) {
                    $detail['bulan'] = $row;
                    $this->Spp_model->adddetail($detail);
            }


            $this->session->set_flashdata('success', $data['operation'] . ' posting berhasil');
            redirect('admin/spp');
        } else {

            // Edit mode
            if (!is_null($kode)) {
                $data['spp'] = $this->Spp_model->get(array('kode_bayar' => $kode));
            }
           

            $kode = 'BGN'.date('Ymd');
            $cek_kode = $this->Spp_model->cek_kode();
            $kodeBarang = $cek_kode['maxKode'];
            $noUrut = (int) substr($kodeBarang, 3, 3);
            $noUrut++;

            $char = "SPP";
            $kodeBarang = $char . sprintf("%03s", $noUrut);
            
            $data['bulan_select'] = array(
                                        'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember');

            $data['kode_trans'] =  $kodeBarang;
             
            $data['title'] = $data['operation'] . ' Pembayaran SPP';
            $data['main'] = 'admin/spp/spp_add';
            $this->load->view('admin/layout', $data);
        }
    }

    
    

    // Delete siswa
    public function delete($kode = NULL) {
        if (isset($kode)) {
            $this->Spp_model->delete($kode);
            $this->Spp_model->del_detail($kode);
            $this->session->set_flashdata('success', 'Hapus posting berhasil');
            redirect('admin/spp');
        } else  {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/spp');
        }
    }


   
}

/* End of file siswa.php */
/* Location: ./application/controllers/admin/spp.php */
