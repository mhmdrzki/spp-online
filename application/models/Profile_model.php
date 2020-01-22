<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * admin Model Class
 *
 * @package     SYSCMS
 * @subpackage  Models
 * @category    Models
 * @author      Sistiandy Syahbana nugraha <sistiandy.web.id>
 */
class Profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    // Get From Databases
    function get($params = array()) {
        $this->db->select('admin.id_admin, username, password, nama_lengkap, description,
            email, input_date, last_update');

        if (isset($params['id'])) {
            $this->db->where('admin.id_admin', $params['id']);
        }
        if (isset($params['id_admin'])) {
            $this->db->where('admin.id_admin', $params['id_admin']);
        }
        if (isset($params['name'])) {
            $this->db->like('username', $params['name']);
        }
        if (isset($params['date'])) {
            $this->db->where('input_date', $params['date']);
        }

        if (isset($params['limit'])) {
            if (!isset($params['offset'])) {
                $params['offset'] = NULL;
            }

            $this->db->limit($params['limit'], $params['offset']);
        }

        if (isset($params['order_by'])) {
            $this->db->order_by($params['order_by'], 'desc');
        } else {
            $this->db->order_by('last_update', 'desc');
        }

        // $this->db->join('admin_role', 'admin_role.role_id = admin.admin_role_role_id', 'left');
        $res = $this->db->get('admin');

        if (isset($params['id'])) {
            return $res->row_array();
        } else {
            return $res->result_array();
        }
    }

   

    function add($data = array()) {

        if (isset($data['id_admin'])) {
            $this->db->set('id_admin', $data['id_admin']);
        }

        if (isset($data['username'])) {
            $this->db->set('username', $data['username']);
        }

        if (isset($data['password'])) {
            $this->db->set('password', $data['password']);
        }

        if (isset($data['nama_lengkap'])) {
            $this->db->set('nama_lengkap', $data['nama_lengkap']);
        }

        if (isset($data['email'])) {
            $this->db->set('email', $data['email']);
        }

        if (isset($data['description'])) {
            $this->db->set('description', $data['description']);
        }

        if (isset($data['input_date'])) {
            $this->db->set('input_date', $data['input_date']);
        }

        if (isset($data['last_update'])) {
            $this->db->set('last_update', $data['last_update']);
        }

        

        if (isset($data['id_admin'])) {
            $this->db->where('id_admin', $data['id_admin']);
            $this->db->update('admin');
            $id = $data['id_admin'];
        } else {
            $this->db->insert('admin');
            $id = $this->db->insert_id();
        }

        $status = $this->db->affected_rows();
        return ($status == 0) ? FALSE : $id;
    }

    

    function delete($id) {
        $this->db->set('admin_is_deleted', 1);
        $this->db->where('id_admin', $id);
        $this->db->update('admin');
    }

    

    function change_password($id, $params) {
        $this->db->where('id_admin', $id);
        $this->db->update('admin', $params);
    }

}
