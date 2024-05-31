<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Mahasiswa extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($table)
    {
        return $this->db->get($table);
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

    public function get_jumlah_point() {
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
?>
