<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Verifikasi extends CI_Model
{

    public function getVerifikasi()
    {
        $query = "SELECT tb_user.nama, tb_mhs.prodi_mhs 
        FROM tb_user JOIN tb_mhs
        ON tb_user.id = tb_mhs.nim_mhs
        ";
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
}
