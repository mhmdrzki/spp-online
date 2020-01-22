<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Pembangunan_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        
        if(isset($params['kode_bayar']))
        {
            $this->db->where('pembangunan.kode_bayar', $params['kode_bayar']);
        }


        if(isset($params['siswa_nisn']))
        {
            $this->db->where('siswa_nisn', $params['siswa_nisn']);
        }

        if(isset($params['tgl_byr']))
        {
            $this->db->where('tgl_byr', $params['tgl_byr']);
        }
        if(isset($params['jmlh_byr']))
        {
            $this->db->where('jmlh_byr', $params['jmlh_byr']);
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
        else
        {
            $this->db->order_by('kode_bayar', 'asc');
        }

        $this->db->select('pembangunan.kode_bayar, siswa_nisn, tgl_byr, jmlh_byr, bendahara,bukti_bayar');
        $res = $this->db->get('pembangunan');

        if(isset($params['kode_bayar']) OR (isset($params['limit']) AND $params['limit'] == 1) OR (isset($params['siswa_nisn'])))
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

     if(isset($data['siswa_nisn'])) {
        $this->db->set('siswa_nisn', $data['siswa_nisn']);
    }


    if(isset($data['tgl_byr'])) {
        $this->db->set('tgl_byr', $data['tgl_byr']);
    }

    if(isset($data['jmlh_byr'])) {
        $this->db->set('jmlh_byr', $data['jmlh_byr']);
    } 

    if(isset($data['bendahara'])) {
        $this->db->set('bendahara', $data['bendahara']);
    }  

    if(isset($data['bukti_bayar'])) {
        $this->db->set('bukti_bayar', $data['bukti_bayar']);
    }  

    if (isset($data['id_pembangunan'])) {
        $this->db->where('siswa_nisn', $data['siswa_nisn']);
        $this->db->update('pembangunan');
        
    } else {
        $this->db->insert('pembangunan');
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

function cek_kode()
    {
        $query=$this->db->query("SELECT max(kode_bayar) as maxKode FROM pembangunan");
        return $query->row_array();
    }

    // Delete to database
    function delete($nisn) {
        $this->db->where('siswa_nisn', $nisn);
        $this->db->delete('pembangunan');
    }
        
}
