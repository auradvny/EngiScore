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
        $query = "SELECT tb_mhs.*, tb_user.nama, tb_user.email, tb_user.gender, tb_user.telp, tb_user.is_active, tb_prodi.prodi         FROM tb_mhs 
        JOIN tb_user ON tb_mhs.user_id = tb_user.id 
        JOIN tb_prodi ON tb_mhs.prodi_id = tb_prodi.id
        WHERE tb_user.role_id = 1";
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

    public function getPoin($email)
    {
        $this->db->select('tb_mhs.point');
        $this->db->from('tb_user');
        $this->db->join('tb_mhs', 'tb_user.id = tb_mhs.user_id');
        $this->db->where('tb_user.email', $email);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            if (isset($result->point)) {
                return $result->point;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function countPengajuan($nim_mhs)
    {
        $this->db->where('nim_mhs', $nim_mhs);
        $this->db->from('tb_permo');
        return $this->db->count_all_results();
    }

    public function getDataMhs($email)
    {
        $this->db->select('tb_mhs.nim_mhs, tb_prodi.prodi, tb_mhs.pembiayaan, tb_mhs.cuti, tb_mhs.pa');
        $this->db->from('tb_user');
        $this->db->join('tb_mhs', 'tb_user.id = tb_mhs.user_id');
        $this->db->join('tb_prodi', 'tb_mhs.prodi_id = tb_prodi.id');
        $this->db->where('tb_user.email', $email);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
    }
}
