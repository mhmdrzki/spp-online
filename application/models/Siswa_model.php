<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Siswa_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        
        if(isset($params['kode_siswa']))
        {
            $this->db->where('siswa.kode_siswa', $params['kode_siswa']);
        }

        if(isset($params['siswa_nisn']))
        {
            $this->db->where('siswa_nisn', $params['siswa_nisn']);
        }
        
        if(isset($params['siswa_nama']))
        {
            $this->db->where('siswa_nama', $params['siswa_nama']);
        }

        if(isset($params['siswa_tmpt_lhr'])) {
        $this->db->where('siswa_tmpt_lhr', $params['siswa_tmpt_lhr']);
        }

        if(isset($params['siswa_tgl_lhr'])) {
            $this->db->where('siswa_tgl_lhr', $params['siswa_tgl_lhr']);
        }

        if(isset($params['siswa_jk']))
        {
            $this->db->where('siswa_jk', $params['siswa_jk']);
        }

        if(isset($params['siswa_tgl_masuk']))
        {
            $this->db->where('siswa_tgl_masuk', $params['siswa_tgl_masuk']);
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
        

        $this->db->select('siswa.kode_siswa, siswa_nisn,  siswa_nama,
            siswa_tmpt_lhr, siswa_tgl_lhr, siswa_jk, siswa_tgl_masuk');
        $res = $this->db->get('siswa');

        if(isset($params['kode_siswa']) OR (isset($params['limit']) AND $params['limit'] == 1) OR (isset($params['siswa_nisn'])))
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

    

    if(isset($data['kode_siswa'])) {
        $this->db->set('kode_siswa', $data['kode_siswa']);
    }

    if(isset($data['siswa_nisn'])) {
        $this->db->set('siswa_nisn', $data['siswa_nisn']);
    }

    if(isset($data['siswa_nama'])) {
        $this->db->set('siswa_nama', $data['siswa_nama']);
    }

    if(isset($data['siswa_tmpt_lhr'])) {
        $this->db->set('siswa_tmpt_lhr', $data['siswa_tmpt_lhr']);
    }

    if(isset($data['siswa_tgl_lhr'])) {
        $this->db->set('siswa_tgl_lhr', $data['siswa_tgl_lhr']);
    }

    if(isset($data['siswa_jk'])) {
        $this->db->set('siswa_jk', $data['siswa_jk']);
    }

    if(isset($data['siswa_tgl_masuk'])) {
        $this->db->set('siswa_tgl_masuk', $data['siswa_tgl_masuk']);
    }
    

    if (isset($data['id_siswa'])) {
        $this->db->where('kode_siswa', $data['kode_siswa']);
        $this->db->update('siswa');
    } else {
        $this->db->insert('siswa');
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

    // Delete to database
function delete($kode) {
    $this->db->where('kode_siswa', $kode);
    $this->db->delete('siswa');
}

function cek_kode()
    {
        $query=$this->db->query("SELECT max(kode_siswa) as maxKode FROM siswa");
        return $query->row_array();
    }

}
