<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Pengajuan');
    }

    public function index()
    {
        $data['title'] = 'Pengajuan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('verifikasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pengajuan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        // Fetch options for dropdowns from tb_sertif_kategori, tb_sertif_bidang, and tb_sertif
        $data['kategori_options'] = $this->Model_Pengajuan->get_kategori_options();
        $data['bidang_options'] = $this->Model_Pengajuan->get_bidang_options();
        $data['capaian_options'] = $this->Model_Pengajuan->get_capaian_options();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tambah_pengajuan', $data);
        $this->load->view('templates/footer');
    }



    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(
                'kategori' => $this->input->post('kategori'),
                'bidang' => $this->input->post('bidang'),
                'capaian' => $this->input->post('capaian'),
                'file' => $this->input->post('file'),
            );

            $this->Model_Pengajuan->insert_data($data, 'tb_permo');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil di Tambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('pengajuan');
        }
    }

    private function _rules()
    {
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('bidang', 'Bidang', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('capaian', 'Capaian', 'required', array(
            'required' => '%s harus diisi!'
        ));
    }

    public function delete($id)
    {
        $where = array('id_permo' => $id);

        $this->Model_Pengajuan->delete($where, 'tb_permo');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Berhasil Di Hapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
        redirect('pengajuan');
    }
}
