<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Mahasiswa extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getMhs()
    {
        $query = "SELECT tb_mhs.*, tb_user.nama,tb_user.email, tb_user.gender,tb_user.telp, tb_prodi.prodi 
        FROM tb_mhs 
        JOIN tb_user ON tb_mhs.user_id = tb_user.id 
        JOIN tb_prodi ON tb_mhs.prodi_id = tb_prodi.id";
        return $this->db->query($query)->result_array();
    }


    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($data, $table)
    {
        $this->db->where('nim_mhs', $data['nim_mhs']);
        $this->db->update($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_jumlah_point()
    {
        $this->db->select('SUM(point) AS jumlah_point');
        $this->db->from('tb_mhs');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_point;
        } else {
            return 0;
        }
    }
}
