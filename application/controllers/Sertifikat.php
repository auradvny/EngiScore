<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Sertifikat';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['sertif'] = $this->db->get('tb_sertif')->result_array();

        $this->form_validation->set_rules('bidang', 'Bidang', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('sertifikat/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_sertif', ['bidang' => $this->input->post('bidang')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-succes" role="alert">Sertifikat Berhasil di Tambahkan</div>');
            redirect('sertifikat');
        }
    }
}
