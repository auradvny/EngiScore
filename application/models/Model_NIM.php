<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_NIM extends CI_Model {

    public function getNim($email) {
        // Join tb_user dan tb_mhs berdasarkan email pengguna yang login dan user_id
        $this->db->select('tb_mhs.nim_mhs');
        $this->db->from('tb_user');
        $this->db->join('tb_mhs', 'tb_user.id = tb_mhs.user_id');
        $this->db->where('tb_user.email', $email);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            if (isset($result->nim_mhs)) {
                return $result->nim_mhs;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}
