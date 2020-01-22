<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Spp_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        
        if(isset($params['kode_bayar']))
        {
            $this->db->where('kode_bayar', $params['kode_bayar']);
        }
        
        if(isset($params['kode_siswa']))
        {
            $this->db->where('kode_siswa', $params['kode_siswa']);
        }
        if(isset($params['tgl_byr']))
        {
            $this->db->where('tgl_byr', $params['tgl_byr']);
        }
        
        if(isset($params['biaya_spp']))
        {
            $this->db->where('biaya_spp', $params['biaya_spp']);
        }

        if(isset($params['total_biaya']))
        {
            $this->db->where('total_biaya', $params['total_biaya']);
        }

        if(isset($params['bendahara']))
        {
            $this->db->where('bendahara', $params['bendahara']);
        }

        if(isset($params['bukti_bayar']))
        {
            $this->db->where('bukti_bayar', $params['bukti_bayar']);
        }
        if(isset($params['date_start']) AND isset($params['date_end']))
        {
            $this->db->where('tgl_byr >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('tgl_byr <=', $params['date_end'] . ' 23:59:59');
        }


        if(isset($params['limit']))
        { 
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'asc');
        }
        

        $this->db->select('spp.kode_bayar,  kode_siswa,
            tgl_byr, biaya_spp, total_biaya, bendahara, bukti_bayar');
        $res = $this->db->get('spp');

        if(isset($params['kode_bayar']) OR (isset($params['limit']) AND $params['limit'] == 1) OR (isset($params['tgl_byr'])))
        {
            return $res->row_array();
        }
        else
        {
            return $res->result_array();
        }
    }

    // Add and update to database
    function add($data = array()) {

   

    if(isset($data['kode_bayar'])) {
        $this->db->set('kode_bayar', $data['kode_bayar']);
    }

    

    if(isset($data['kode_siswa'])) {
        $this->db->set('kode_siswa', $data['kode_siswa']);
    }

    

    if(isset($data['tgl_byr'])) {
        $this->db->set('tgl_byr', $data['tgl_byr']);
    }


    if(isset($data['biaya_spp'])) {
            $this->db->set('biaya_spp', $data['biaya_spp']);
        }

    if(isset($data['total_biaya'])) {
            $this->db->set('total_biaya', $data['total_biaya']);
        }

    if(isset($data['bendahara'])) {
            $this->db->set('bendahara', $data['bendahara']);
        }

    if(isset($data['bukti_bayar'])) {
            $this->db->set('bukti_bayar', $data['bukti_bayar']);
        }


    if (isset($data['id_spp'])) {
        $this->db->where('kode_bayar', $data['kode_bayar']);
        $this->db->update('spp');
    } else {
        $this->db->insert('spp');
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

function getdetail($params = array())
    {
        
        if(isset($params['kode_bayar']))
        {
            $this->db->where('kode_bayar', $params['kode_bayar']);
        }

        if(isset($params['kode_siswa']))
        {
            $this->db->where('kode_siswa', $params['kode_siswa']);
        }
        
        if(isset($params['bulan']))
        {
            $this->db->where('bulan', $params['bulan']);
        }
        if(isset($params['tahun']))
        {
            $this->db->where('tahun', $params['tahun']);
        }
        

        if(isset($params['limit']))
        { 
            if(!isset($params['offset']))
            {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if(isset($params['order_by']))
        {
            $this->db->order_by($params['order_by'], 'asc');
        }
        

        $this->db->select('spp_detail.kode_bayar, kode_siswa, bulan,
            tahun');
        $res = $this->db->get('spp_detail');

       
            return $res->result_array();
       
    }

    // Add and update to database
    function adddetail($data = array()) {

   

    if(isset($data['kode_bayar'])) {
        $this->db->set('kode_bayar', $data['kode_bayar']);
    }

    if(isset($data['kode_siswa'])) {
        $this->db->set('kode_siswa', $data['kode_siswa']);
    }

    if(isset($data['bulan'])) {
        $this->db->set('bulan', $data['bulan']);
    }

    

    if(isset($data['tahun'])) {
        $this->db->set('tahun', $data['tahun']);
    }


    if (isset($data['id_spp'])) {
        $this->db->where('kode_bayar', $data['kode_bayar']);
        $this->db->update('spp_detail');
    } else {
        $this->db->insert('spp_detail');
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

function cek_kode()
    {
        $query=$this->db->query("SELECT max(kode_bayar) as maxKode FROM spp");
        return $query->row_array();
    }

function get_tahun($kode)
{
    $query=$this->db->query("SELECT DISTINCT tahun FROM spp_detail WHERE kode_siswa = '$kode'");
    return $query->result_array();
}

function get_butun($kode, $tahun)
{
    $query=$this->db->query("SELECT * FROM spp_detail WHERE kode_siswa = '$kode' and tahun = '$tahun' order by tahun asc");
    return $query->result_array();
}

    // Delete to database
function delete($kode) {
    $this->db->where('kode_bayar', $kode);
    $this->db->delete('spp');
}

function del_detail($kode) {
    $this->db->where('kode_bayar', $kode);
    $this->db->delete('spp_detail');
}



}
