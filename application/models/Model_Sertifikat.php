<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Sertifikat extends CI_Model
{
    public function getSertif()
    {
        $query = "SELECT tb_sertif.*, tb_sertif_bidang.bidang, tb_sertif_capaian.capaian, tb_sertif_kategori.kategori 
        FROM tb_sertif 
        JOIN tb_sertif_bidang ON tb_sertif.bidang_id = tb_sertif_bidang.id 
        JOIN tb_sertif_capaian ON tb_sertif.capaian_id = tb_sertif_capaian.id 
        JOIN tb_sertif_kategori ON tb_sertif.kategori_id = tb_sertif_kategori.id";
        return $this->db->query($query)->result_array();
    }

    public function getBidangById($id)
    {
        return $this->db->get_where('tb_sertif_bidang', ['id' => $id])->row_array();
    }

    public function updateBidang($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_sertif_bidang', $data);
    }

    public function updateKategori($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_sertif_kategori', $data);
    }

    public function updateCapaian($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_sertif_capaian', $data);
    }

    public function updateSertifikat($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_sertif', $data);
    }
}
