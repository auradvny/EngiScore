<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Verifikasi';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('verifikasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function verifikasi()
    {
        $data['title'] = 'Verifikasi';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/verifikasi', $data);
        $this->load->view('templates/footer');
    }
}
