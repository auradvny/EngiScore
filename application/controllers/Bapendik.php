<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bapendik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mahasiswa');
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

        $data['mahasiswa'] = $this->db->get('tb_user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function verifikasi()
    {
        $data['title'] = 'Verifikasi';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['mahasiswa'] = $this->db->get('tb_user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/verifikasi', $data);
        $this->load->view('templates/footer');
    }


    public function sertifikat()
    {
        $data['title'] = 'Sertifikat';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['sertifikat'] = $this->db->get('tb_sertif')->result_array();

        $this->form_validation->set_rules('bidang', 'Bidang', 'required', array('required' => 'Bidang harus diisi.'));
        $this->form_validation->set_rules('capaian', 'Capaian', 'required', array('required' => 'Capaian harus diisi.'));
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));
        $this->form_validation->set_rules('skor', 'Skor', 'required', array('required' => 'Skor harus diisi.'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/sertifikat', $data);
            $this->load->view('templates/footer');
        } else {
            $sertif_data = [
                'bidang' => $this->input->post('bidang'),
                'capaian' => $this->input->post('capaian'),
                'kategori' => $this->input->post('kategori'),
                'skor' => $this->input->post('skor')
            ];
            $this->db->insert('tb_sertif', $sertif_data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data sertifikat berhasil ditambahkan!</div>');
            redirect('bapendik/sertifikat');
        }
    }

    public function tambah_mhs()
    {
        $data['title'] = 'Tambah Mahasiswa';

        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/tambah_mhs', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_user', ['mahasiswa' => $this->input->post('mahasiswa')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('bapendik/mahasiswa');
        }
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_mhs();
        } else {
            $data = array(

                'id' => $this->input->post('id'),
                'nim_mhs' => $this->input->post('nim_mhs'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'pass_mhs' => $this->input->post('pass_mhs'),
                'prodi' => $this->input->post('prodi'),
                'gender' => $this->input->post('gender'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
            );

            $this->Model_Mahasiswa->insert_data($data, 'tb_user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil di _mhskan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('bapendik/mahasiswa');
        }
    }

    public function edit_mhs($id)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'id' => $id,
                //'nim_mhs' => $nim_mhs,
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                // 'pass_mhs' => $this->input->post('pass_mhs'),
                'gender' => $this->input->post('gender'),
                'prodi' => $this->input->post('prodi'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
            );

            $this->Model_Mahasiswa->update_data($data, 'tb_user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('mahasiswa');
        }
    }

    public function print_mhs()
    {
        $data['mahasiswa'] = $this->Model_Mahasiswa->get_data('tb_user')->result();
        $this->load->view('print_mahasiswa', $data);
    }

    public function pdf_mhs()
    {
        $this->load->library('dompdf_gen');

        $data['mahasiswa'] = $this->Model_Mahasiswa->get_data('tb_user')->result();
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
        $this->form_validation->set_rules('nama', 'Nama Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('email', 'Email Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        // $this->form_validation->set_rules('pass_mhs', 'Password Mahasiswa', 'required', array(
        //     'required' => '%s harus diisi!'
        // ));
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('prodi', 'Prodi Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('telp', 'No Telp Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
        $this->form_validation->set_rules('alamat', 'Alamat Mahasiswa', 'required', array(
            'required' => '%s harus diisi!'
        ));
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->Model_Mahasiswa->delete($where, 'tb_user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Berhasil Di Hapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
        redirect('bapendik/mahasiswa');
    }
}
