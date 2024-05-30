<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Mahasiswa extends CI_Model
{
	// public function getMhs()
	// {
	// 	$query = "SELECT '' "
	// }

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

	public function get_user_by_email($email)
    {
        $this->db->where('email_mhs', $email);
        $query = $this->db->get('tb_mhs');
        return $query->row();
    }

    function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}

    public function login($username, $password)
    {
        $this->db->where('email_mhs', $username);
        $this->db->where('pass_mhs', $password);
        $query = $this->db->get('tb_mhs');

        if ($query->num_rows() > 0)
        {
            $user = $query->row();
            $this->session->set_userdata('nim_mhs', $user->id);
            $this->session->set_userdata('email_mhs', $user->username);
            return true;
        }
        else
        {
            return false;
        }
    }
}