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
class Pengeluaran extends CI_Controller {

    public function __construct() {
        parent::__construct(TRUE);
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model(array('Pengeluaran_model'));
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
            $params['kode_keluar'] = $f['n'];
        }

        $paramsPage = $params;
        $params['limit'] = 10;
        $params['offset'] = $offset;
        $data['pengeluaran'] = $this->Pengeluaran_model->get($params);

        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['base_url'] = site_url('admin/pengeluaran/index');
        $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config['total_rows'] = count($this->Pengeluaran_model->get($paramsPage));
        $this->pagination->initialize($config);

        $data['title'] = 'Pengeluaran';
        $data['main'] = 'admin/pengeluaran/pengeluaran_list';
        $this->load->view('admin/layout', $data);
    }

    function detail($id = NULL) {
        if ($this->Pengeluaran_model->get(array('kode_keluar' => $id)) == NULL) {
            redirect('admin/pengeluaran');
        }
        $data['pengeluaran'] = $this->Pengeluaran_model->get(array('kode_keluar' => $id));
        $data['title'] = 'Detail Pengeluaran';
        $data['main'] = 'admin/pengeluaran/pengeluaran_detail';
        $this->load->view('admin/layout', $data);
    }

    // Add siswa and Update
    public function add($id = NULL) {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('tgl_pengeluaran', 'Tanggal Pengeluaran', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ket', 'Keterangan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('biaya', 'Biaya', 'trim|required|xss_clean');
        $this->form_validation->set_rules('bendahara', 'Nama Bendahara', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = is_null($id) ? 'Tambah' : 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            
            $params['id_pengeluaran']   = $this->input->post('id_pengeluaran');
            $params['kode_keluar']      = $this->input->post('kode_keluar');
            $params['tgl_pengeluaran']  = $this->input->post('tgl_pengeluaran');
            $params['ket']              = $this->input->post('ket');
            $params['biaya']            = $this->input->post('biaya');
            $params['bendahara']        = $this->input->post('bendahara');
            
            $config['upload_path']          = './img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']        = $this->input->post('kode_keluar');
            $config['max_size']             = 1024;
            $config['max_width']             = 1024;
            $config['max_height']             = 768;
 
            $this->load->library('upload', $config);
            $this->upload->do_upload('berkas');
                $data = array('upload_data' => $this->upload->data());
                $file = $this->upload->data();
                $params['bukti_bayar'] = $file['file_name'];

                $status = $this->Pengeluaran_model->add($params);


                $this->session->set_flashdata('success', $data['operation'] . ' posting berhasil');
                redirect('admin/pengeluaran');
            
        } else {

            // Edit mode
            if (!is_null($id)) {
                $data['pengeluaran'] = $this->Pengeluaran_model->get(array('kode_keluar' => $id));
            }
             
            $cek_kode = $this->Pengeluaran_model->cek_kode();
            $kodeBarang = $cek_kode['maxKode'];
            $noUrut = (int) substr($kodeBarang, 3, 3);
            $noUrut++;

            $char = "KLR";
            $kodeBarang = $char . sprintf("%03s", $noUrut);
            


            $data['kode_keluar'] =  $kodeBarang; 
            $data['title'] = $data['operation'] . ' Pengeluaran';
            $data['main'] = 'admin/pengeluaran/pengeluaran_add';
            $this->load->view('admin/layout', $data);
        }
    }

    
    

    // Delete siswa
    public function delete($id = NULL) {
        if (isset($id)) {
            $this->Pengeluaran_model->delete($id);
            
            $this->session->set_flashdata('success', 'Hapus posting berhasil');
            redirect('admin/pengeluaran');
        } else  {
            $this->session->set_flashdata('delete', 'Delete');
            redirect('admin/pengeluaran');
        }
    }


   
}

/* End of file siswa.php */
/* Location: ./application/controllers/admin/pengeluaran.php */
