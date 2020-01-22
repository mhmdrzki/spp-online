<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User controllers class
 *
 * @package     SYSCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));
        }
        $this->load->model('Profile_model');
        $this->load->helper(array('form', 'url'));
    }

    // User_customer view in list
    public function index($offset = NULL) {
        $id = $this->session->userdata('id_admin');
        if ($this->Profile_model->get(array('id' => $id)) == NULL) {
            redirect('admin/user');
        }
        $data['user'] = $this->Profile_model->get(array('id' => $id));
        $data['title'] = 'Detail Profil';
        $data['main'] = 'admin/profile/profile_detail';
        $this->load->view('admin/layout', $data);
    }

    // Add User_customer and Update
    public function edit($id = NULL) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_lengkap', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'User Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $data['operation'] = 'Sunting';

        if ($_POST AND $this->form_validation->run() == TRUE) {

            $params['id_admin'] = $this->input->post('id_admin');
            $params['user_last_update'] = date('Y-m-d H:i:s');
            $params['nama_lengkap'] = $this->input->post('nama_lengkap');
            $params['description'] = $this->input->post('description');
            $params['email'] = $this->input->post('email');
            $status = $this->Profile_model->add($params);

            

            $this->session->set_flashdata('success', $data['operation'] . ' Profil Berhasil');
            redirect('admin/profile');
        } else {

            // Edit mode
            $data['user'] = $this->Profile_model->get(array('id' => $this->session->userdata('id_admin')));
            $data['button'] = ($id == $this->session->userdata('id_admin')) ? 'Ubah' : 'Reset';
            $data['title'] = $data['operation'] . ' Profil';
            $data['main'] = 'admin/profile/profile_edit';
            $this->load->view('admin/layout', $data);
        }
    }

    function cpw($id = NULL) {
        $this->load->library('form_validation'); 
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|xss_clean|min_length[6]|matches[password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        if ($_POST AND $this->form_validation->run() == TRUE) {
            $id = $this->input->post('id_admin');
            $params['password'] = sha1($this->input->post('password'));
            $status = $this->Profile_model->change_password($id, $params);

            
            $this->session->set_flashdata('success', 'Ubah Password Berhasil');
            redirect('admin/profile');
        } else {
            if ($this->Profile_model->get(array('id' => $id)) == NULL) {
                redirect('admin/profile');
            }
            $data['user'] = $this->Profile_model->get(array('id' => $id));
            $data['title'] = 'Ubah Password';
            $data['main'] = 'admin/profile/change_pass';
            $this->load->view('admin/layout', $data);
        }
    }

}

/* End of file user.php */
/* Location: ./application/controllers/ccp/user.php */
