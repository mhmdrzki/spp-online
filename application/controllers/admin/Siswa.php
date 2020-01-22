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
class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Siswa_model'));
        $this->load->library('upload');
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
            $params['siswa_nama'] = $f['n'];
        }

        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['siswa'] = $this->Siswa_model->get($params);
        $data['siswas'] = $this->Siswa_model->get();

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/siswa/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Siswa_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Siswa';
        $data['main'] = 'admin/siswa/siswa_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($kode = NULL) {
        if ($this->Siswa_model->get(array('kode_siswa' => $kode)) == NULL) {
            redirect('admin/siswa');
        }
        $data['siswa'] = $this->Siswa_model->get(array('kode_siswa' => $kode));
        $data['title'] = 'Detail Siswa';
        $data['main'] = 'admin/siswa/siswa_detail';
        $this->load->view('admin/layout', $data);
    }

    // Add siswa and Update
    public function add($kode = NULL) {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('siswa_nama', 'Nama Lengkap', 'trim|required|xss_clean');
        $this->form_validation->set_rules('siswa_tmpt_lhr', 'Tempat Lahir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('siswa_tgl_lhr', 'Tanggal Lahir', 'trim|required|xss_clean');
        $this->form_validation->set_rules('siswa_jk', 'Jenis Kelamin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('siswa_tgl_masuk', 'Tanggal Masuk', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($kode) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            $params['kode_siswa'] = $this->input->post('kode_siswa');
            $params['siswa_nisn'] = $this->input->post('siswa_nisn');
            $params['siswa_nama'] = $this->input->post('siswa_nama');
            $params['siswa_tmpt_lhr'] = $this->input->post('siswa_tmpt_lhr');
            $params['siswa_tgl_lhr'] = $this->input->post('siswa_tgl_lhr');
            $params['siswa_jk'] = $this->input->post('siswa_jk');
            $params['siswa_tgl_masuk'] = $this->input->post('siswa_tgl_masuk');
            $params['id_siswa'] = $this->input->post('id_siswa');
            
            $status = $this->Siswa_model->add($params);


           

            $this->session->set_flashdata('success', $data['operation'] . ' posting berhasil');
            redirect('admin/siswa');
        } else {

            // Edit mode
            if (!is_null($kode)) {
                $data['siswa'] = $this->Siswa_model->get(array('kode_siswa' => $kode));
            }
            
            $cek_kode = $this->Siswa_model->cek_kode();
            $kodeBarang = $cek_kode['maxKode'];
            $noUrut = (int) substr($kodeBarang, 3, 3);
            $noUrut++;

            $char = "SSW";
            $kodeBarang = $char . sprintf("%03s", $noUrut);
            


            $data['kode_siswa'] =  $kodeBarang;

            $data['title'] = $data['operation'] . ' Siswa';
            $data['main'] = 'admin/siswa/siswa_add';
            $this->load->view('admin/layout', $data);
        }
    }

    
    

    // Delete siswa
    public function delete($kode = NULL) {
        if (isset($kode)) {
            $this->Siswa_model->delete($kode);
           
            $this->session->set_flashdata('success', 'Hapus posting berhasil');
            redirect('admin/siswa');
        } else{
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/siswa/edit/' . $nisn);
        }
    }


   
}

/* End of file siswa.php */
/* Location: ./application/controllers/admin/siswa.php */
