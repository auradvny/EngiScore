<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mahasiswa');
    }

    public function index()
    {
        $data['title'] = 'Mahasiswa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mahasiswa'] = $this->Model_Mahasiswa->get_data('tb_mhs')->result();
        $data['jumlah_point'] = $this->Model_Mahasiswa->get_jumlah_point();
        //  $data['user'] = $this->Model_User->get_data('tb_user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Mahasiswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tambah_mahasiswa');
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = array(

                'nim_mhs' => $this->input->post('nim_mhs'),
                'nama_mhs' => $this->input->post('nama_mhs'),
                'email_mhs' => $this->input->post('email_mhs'),
                'pass_mhs' => $this->input->post('pass_mhs'),
                'prodi_mhs' => $this->input->post('prodi_mhs'),
                'jekel_mhs' => $this->input->post('jekel_mhs'),
                'telp_mhs' => $this->input->post('telp_mhs'),
                'alamat_mhs' => $this->input->post('alamat_mhs'),
            );

            $this->Model_Mahasiswa->insert_data($data, 'tb_mhs');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil di Tambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('mahasiswa');
        }
    }

    public function edit($nim_mhs)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'nim_mhs' => $nim_mhs,
                'nama_mhs' => $this->input->post('nama_mhs'),
                'email_mhs' => $this->input->post('email_mhs'),
                'pass_mhs' => $this->input->post('pass_mhs'),
                'prodi_mhs' => $this->input->post('prodi_mhs'),
                'jekel_mhs' => $this->input->post('jekel_mhs'),
                'telp_mhs' => $this->input->post('telp_mhs'),
                'alamat_mhs' => $this->input->post('alamat_mhs'),
            );

            $this->Model_Mahasiswa->update_data($data, 'tb_mhs');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('mahasiswa');
        }
    }

    public function print()
    {
        $data['mahasiswa'] = $this->Model_Mahasiswa->get_data('tb_mhs')->result();
        $this->load->view('print_mahasiswa', $data);
    }

    public function pdf()
    {
        $this->load->library('dompdf_gen');

        $data['mahasiswa'] = $this->Model_Mahasiswa->get_data('tb_mhs')->result();
        $this->load->view('laporan_mahasiswa', $data);

        $paper_size = 'A4';
        $orientation = "potrait";
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_mahasiswa.pdf', array('Attachment' => 0));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nim_mhs', 'NIM Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('nama_mhs', 'Nama Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('email_mhs', 'Email Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('pass_mhs', 'Password Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('prodi_mhs', 'Prodi Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('jekel_mhs', 'Jenis Kelamin', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('telp_mhs', 'No Telp Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('alamat_mhs', 'Alamat Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
    }

    public function delete($nim)
    {
        $where = array('nim_mhs' => $nim);

        $this->Model_Mahasiswa->delete($where, 'tb_mhs');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Berhasil Di Hapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
        redirect('mahasiswa');
    }
}
