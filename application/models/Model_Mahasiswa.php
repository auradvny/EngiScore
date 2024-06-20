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
        $this->db->where('persetujuan', 0);
        return $this->db->count_all_results();
    }

    public function get_jumlah_permohonansetuju($nim_mhs)
    {
        $this->db->where('nim_mhs', $nim_mhs);
        $this->db->where('persetujuan', 1); // Menambahkan kondisi untuk persetujuan = 1
        $this->db->from('tb_permo');
        return $this->db->count_all_results();
    }


    public function get_jumlah_permohonantolak($nim_mhs)
    {
        $this->db->where('nim_mhs', $nim_mhs);
        $this->db->where('persetujuan', 2); // Menambahkan kondisi untuk persetujuan = 2
        $this->db->from('tb_permo');
        return $this->db->count_all_results();
    }


    public function getDataMhs($email)
    {
        $this->db->select('tb_mhs.nim_mhs, tb_prodi.prodi, tb_prodi.fakultas, tb_mhs.pembiayaan, tb_mhs.cuti, tb_mhs.pa');
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

    public function get_mahasiswa($id)
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

    public function deleteMhs($id)
    {
        // Start transaction
        $this->db->trans_start();

        // Delete from tb_mhs where user_id is the given id
        $this->db->where('user_id', $id);
        $this->db->delete('tb_mhs');

        // Delete from tb_user where id is the given id
        $this->db->where('id', $id);
        $this->db->delete('tb_user');

        // Complete transaction
        $this->db->trans_complete();

        // Check if transaction status is true or false
        return $this->db->trans_status();
    }

    public function getMhsById($user_id)
    {
        $this->db->select('tb_mhs.*, tb_user.nama, tb_user.email, tb_user.gender, tb_user.telp, tb_user.image');
        $this->db->join('tb_user', 'tb_user.id = tb_mhs.user_id');
        $this->db->where('tb_mhs.user_id', $user_id);
        return $this->db->get('tb_mhs')->row_array();
    }

    public function updateMhs($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_mhs', $data);
        return $this->db->affected_rows();
    }
}    