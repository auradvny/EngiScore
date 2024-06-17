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
        $this->db->where('is_active', 1);
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
        $this->db->where('persetujuan', 0);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_permo;
        } else {
            return 0;
        }
    }
    public function get_jumlah_permohonansetuju()
    {
        $this->db->select('COUNT(*) AS jumlah_permo');
        $this->db->from('tb_permo');
        $this->db->where('persetujuan', 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_permo;
        } else {
            return 0;
        }
    }
    public function get_jumlah_permohonantolak()
    {
        $this->db->select('COUNT(*) AS jumlah_permo');
        $this->db->from('tb_permo');
        $this->db->where('persetujuan', 2);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_permo;
        } else {
            return 0;
        }
    }

    public function get_bapendik($id)
    {
        $this->db->select('tb_user.*, tb_agama.agama, tb_goldar.goldar');
        $this->db->from('tb_user');
        $this->db->join('tb_agama', 'tb_user.agama_id = tb_agama.id');
        $this->db->join('tb_goldar', 'tb_user.goldar_id = tb_goldar.id');
        $this->db->where('tb_user.id', $id);
        return $this->db->get()->row_array();
    }

    public function update_biodata($user_id, $data)
    {
        $this->db->where('id', $user_id);
        $this->db->update('tb_user', $data);
    }
}
