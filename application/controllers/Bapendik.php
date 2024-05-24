<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bapendik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // is_logged_in();
        //check_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/index', $data);
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'My Profil';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/profil', $data);
        $this->load->view('templates/footer');
    }

    public function mahasiswa()
    {
        $data['title'] = 'Mahasiswa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function sertifikat()
    {
        $data['title'] = 'Sertifikat';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('sertifikat/index', $data);
        $this->load->view('templates/footer');
    }

    public function verifikasi()
    {
        $data['title'] = 'Verifikasi';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        // $this->sload->model('Model_Verifikasi', 'verif');

        // $data['verifikasi'] = $this->verif->getVerifikasi();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/verifikasi', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/laporan', $data);
        $this->load->view('templates/footer');
    }
}
