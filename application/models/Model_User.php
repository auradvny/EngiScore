<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_User extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_jumlah_mahasiswa()
    {
        $this->db->select('COUNT(*) AS jumlah_mhs');
        $this->db->from('tb_mhs');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_mhs;
        } else {
            return 0;
        }
    }
}
