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
        $this->db->from('tb_user');
        $this->db->where('role_id', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_mhs;
        } else {
            return 0;
        }
    }
    public function get_jumlah_permohonan()
    {
        $this->db->select('COUNT(*) AS jumlah_permo');
        $this->db->from('tb_permo');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_permo;
        } else {
            return 0;
        }
    }
}
