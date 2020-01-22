<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
* Posts Model Class
 *
 * @package     CMS
 * @subpackage  Models
 * @category    Models
 * @author      Achyar Anshorie
 */

class Pengeluaran_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array())
    {
        

        if(isset($params['kode_keluar']))
        {
            $this->db->where('kode_keluar', $params['kode_keluar']);
        }
        
        if(isset($params['ket']))
        {
            $this->db->where('ket', $params['ket']);
        }
        if(isset($params['biaya']))
        {
            $this->db->where('biaya', $params['biaya']);
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
            $this->db->where('tgl_pengeluaran >=', $params['date_start'] . ' 00:00:00');
            $this->db->where('tgl_pengeluaran <=', $params['date_end'] . ' 23:59:59');
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
        

        $this->db->select('kode_keluar, tgl_pengeluaran,  ket,
            biaya, bendahara, bukti_bayar');
        $res = $this->db->get('pengeluaran');

        if(isset($params['kode_keluar']) OR (isset($params['limit']) AND $params['limit'] == 1) )
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

    if(isset($data['kode_keluar'])) {
        $this->db->set('kode_keluar', $data['kode_keluar']);
    }

    if(isset($data['tgl_pengeluaran'])) {
        $this->db->set('tgl_pengeluaran', $data['tgl_pengeluaran']);
    }


    if(isset($data['ket'])) {
        $this->db->set('ket', $data['ket']);
    }


    if(isset($data['biaya'])) {
        $this->db->set('biaya', $data['biaya']);
    }

    if(isset($data['bendahara'])) {
        $this->db->set('bendahara', $data['bendahara']);
    }

    if(isset($data['bukti_bayar'])) {
        $this->db->set('bukti_bayar', $data['bukti_bayar']);
    }


    if (isset($data['id_pengeluaran'])) {
        $this->db->where('kode_keluar', $data['kode_keluar']);
        $this->db->update('pengeluaran');
        
    } else {
        $this->db->insert('pengeluaran');
        
    }

    $status = $this->db->affected_rows();
    return ($status == 0) ? FALSE : $id;
}

function cek_kode()
    {
        $query=$this->db->query("SELECT max(kode_keluar) as maxKode FROM pengeluaran");
        return $query->row_array();
    }

    // Delete to database
function delete($id) {
    $this->db->where('kode_keluar', $id);
    $this->db->delete('pengeluaran');
}



}
