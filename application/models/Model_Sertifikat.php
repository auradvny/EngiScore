<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Sertifikat extends CI_Model
{
    public function getSertif()
    {
        $query = "SELECT tb_sertif.*, tb_sertif_bidang.bidang, tb_sertif_kategori.kategori 
        FROM tb_sertif 
        JOIN tb_sertif_bidang ON tb_sertif.bidang_id = tb_sertif_bidang.id 
        JOIN tb_sertif_kategori ON tb_sertif.kategori_id = tb_sertif_kategori.id";
        return $this->db->query($query)->result_array();
    }
}
