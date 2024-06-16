<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Verifikasi extends CI_Model
{

    public function getVerifikasi()
    {
        $query = "SELECT tb_permo.nim_mhs,tb_permo.file, tb_sertif_kategori.kategori, tb_sertif_bidang.bidang, tb_sertif_capaian.capaian 
        FROM tb_permo 
        JOIN tb_sertif_kategori ON tb_permo.kategori_id = tb_sertif_kategori.id 
        JOIN tb_sertif_bidang ON tb_permo.bidang_id = tb_sertif_bidang.id 
        JOIN tb_sertif_capaian ON tb_permo.capaian_id= tb_sertif_capaian.id 
        JOIN tb_mhs ON tb_permo.nim_mhs = tb_mhs.nim_mhs
        ";

        return $this->db->query($query)->result_array();
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
