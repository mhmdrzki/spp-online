<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Dashboard controllers class
 *
 * @package     HCA CMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Achyar Anshorie
 */

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged') == NULL) {
            header("Location:" . site_url('admin/auth/login') . "?location=" . urlencode($_SERVER['REQUEST_URI']));            
        }

        $this->load->model(array('Siswa_model','Pembangunan_model','Pengeluaran_model' ,'Spp_model'));
    }

    // Dashboard View
    public function index()
    {
        $data['total_spp']      = $this->Spp_model->get();
        $data['total_bangun']   = $this->Pembangunan_model->get();
        $data['total_keluar']   = $this->Pengeluaran_model->get();

        $data['title']  = 'Dashboard';
        $data['main']   = 'admin/dashboard/dashboard';
        $this->load->view('admin/layout', $data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
