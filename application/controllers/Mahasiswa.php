<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mahasiswa');
<<<<<<< HEAD
        $this->load->model('Model_Sertifikat');
=======
>>>>>>> a3616c864e405a4f956c8375cfb527e2c3412d48
        // is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
<<<<<<< HEAD
        $data['mahasiswa'] = $this->Model_Mahasiswa->getMhs();
=======
        //$data['mahasiswa'] = $this->Model_Mahasiswa->get_data('tb_mhs')->result();
>>>>>>> a3616c864e405a4f956c8375cfb527e2c3412d48
        $data['jumlah_point'] = $this->Model_Mahasiswa->get_jumlah_point();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'My Profil';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/profil', $data);
        $this->load->view('templates/footer');
    }

    public function pengajuan()
<<<<<<< HEAD
{
    $data['title'] = 'Pengajuan';
    $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

    // Load model Model_NIM dan ambil nim_mhs berdasarkan email pengguna yang login
    $this->load->model('Model_NIM');
    $nim_mhs = $this->Model_NIM->getNim($data['user']['email']);

    // Tambahkan pengecekan apakah nim_mhs berhasil diambil
    if ($nim_mhs === null) {
        show_error('NIM tidak ditemukan untuk pengguna yang sedang login.', 500, 'Kesalahan Data Pengguna');
    }

    $data['sertifikat'] = $this->Model_Sertifikat->getSertif();
    $data['bidang'] = $this->db->get('tb_sertif_bidang')->result_array();
    $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();

    $this->form_validation->set_rules('bidang', 'Bidang', 'required', array('required' => 'Bidang harus diisi.'));
    $this->form_validation->set_rules('capaian', 'Capaian', 'required', array('required' => 'Capaian harus diisi.'));
    $this->form_validation->set_rules('kategori', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));

    if ($this->form_validation->run() == FALSE) {
=======
    {
        $data['title'] = 'Pengajuan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

>>>>>>> a3616c864e405a4f956c8375cfb527e2c3412d48
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/pengajuan', $data);
        $this->load->view('templates/footer');
<<<<<<< HEAD
    } else {
        // Pastikan id_permo adalah auto-increment di database
        $sertif_data = [
            'nim_mhs' => $nim_mhs, // Gunakan nim_mhs yang telah diambil dari model
            'bidang' => $this->input->post('bidang'),
            'capaian' => $this->input->post('capaian'),
            'kategori' => $this->input->post('kategori'),
            'file' => $this->input->post('file'),
        ];
        $this->db->insert('tb_permo', $sertif_data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data sertifikat berhasil ditambahkan!</div>');
        redirect('mahasiswa/pengajuan');
    }
}

=======
    }
>>>>>>> a3616c864e405a4f956c8375cfb527e2c3412d48

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Mahasiswa';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this['mahasiswa'] = $this->db->get('tb_user')->result_array();

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
            redirect('bapendik/mahasiswa');
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
