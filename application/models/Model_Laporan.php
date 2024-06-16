<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Laporan extends CI_Model {
    public function get_laporan() {
        $this->db->select('tb_user.nama, tb_user.email, tb_user.telp, tb_mhs.nim_mhs, tb_mhs.point');
        $this->db->from('tb_user');
        $this->db->join('tb_mhs', 'tb_user.id = tb_mhs.user_id'); // asumsikan ada kolom 'user_id' di tb_mhs yang merupakan foreign key
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>
