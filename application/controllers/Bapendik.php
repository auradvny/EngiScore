<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bapendik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mahasiswa');
        $this->load->model('Model_User');
        $this->load->model('Model_Sertifikat');

        // is_logged_in();
        //check_admin();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jumlah_mhs'] = $this->Model_User->get_jumlah_mahasiswa();
        $data['jumlah_permo'] = $this->Model_User->get_jumlah_permohonan();

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

        $data['mahasiswa'] = $this->Model_Mahasiswa->getMhs();
        $this->db->where('role_id', 1);
        $data['user'] = $this->db->get('tb_user')->result_array();
        $data['prodi'] = $this->db->get('tb_prodi')->result_array();

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

        $data['sertifikat'] = $this->Model_Sertifikat->getSertif();
        $data['bidang'] = $this->db->get('tb_sertif_bidang')->result_array();
        $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();

        $this->form_validation->set_rules('bidang_id', 'Bidang', 'required', array('required' => 'Bidang harus diisi.'));
        $this->form_validation->set_rules('capaian', 'Capaian', 'required', array('required' => 'Capaian harus diisi.'));
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));
        $this->form_validation->set_rules('skor', 'Skor', 'required', array('required' => 'Skor harus diisi.'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/sertifikat', $data);
            $this->load->view('templates/footer');
        } else {
            $sertif_data = [
                'bidang_id' => $this->input->post('bidang_id'),
                'capaian' => $this->input->post('capaian'),
                'kategori_id' => $this->input->post('kategori_id'),
                'skor' => $this->input->post('skor')
            ];
            $this->db->insert('tb_sertif', $sertif_data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data sertifikat berhasil ditambahkan!</div>');
            redirect('bapendik/sertifikat');
        }
    }

    public function tambah_bidang()
    {
        $nama_bidang = $this->input->post('nama_bidang');
        if ($nama_bidang) {
            $this->db->insert('tb_sertif_bidang', ['bidang' => $nama_bidang]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bidang berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama bidang harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function delete_bidang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_sertif_bidang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bidang berhasil dihapus!</div>');
        redirect('bapendik/sertifikat');
    }

    public function tambah_kategori()
    {
        $nama_kategori = $this->input->post('nama_kategori');
        if ($nama_kategori) {
            $this->db->insert('tb_sertif_kategori', ['kategori' => $nama_kategori]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil ditambahkan!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama kategori harus diisi!</div>');
        }
        redirect('bapendik/sertifikat');
    }

    public function edit_kategori($id)
    {
        $kategori_lama = $this->db->get_where('tb_sertif_kategori', ['id' => $id])->row_array();
        $data['kategori_lama'] = $kategori_lama;

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');

        if ($this->form_validation->run() === TRUE) {
            $data_update = ['kategori' => $this->input->post('nama_kategori')];
            $this->db->where('id', $id);
            $this->db->update('tb_sertif_kategori', $data_update);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil diperbarui!</div>');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Nama kategori harus diisi!</div>');
        }
        $this->load->view('bapendik/edit_kategori', $data);
        redirect('bapendik/sertifikat');
    }

    public function delete_kategori($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_sertif_kategori');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil dihapus!</div>');
        redirect('bapendik/sertifikat');
    }

    public function sertif_kategori()
    {
        $data['title'] = 'Kategori Sertifikat';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->db->get('tb_sertif_kategori')->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/kategori_sertif', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tb_sertif_kategori', ['kategori' => $this->input->post('kategori')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Kategori berhasil ditambahkan!</div>');
            redirect('bapendik/sertifikat');
        }
    }

    public function tambah_mhs()
    {
        $data['title'] = 'Tambah Mahasiswa';

        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        //$this->_rules();
        $this->form_validation->set_rules('nim_mhs', 'NIM', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique' => 'Email ini sudah terdaftar'
        ]);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('prodi_id', 'Prodi', 'required|trim');
        $this->form_validation->set_rules('telp', 'No Telp', 'required|trim');
        // $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[3]|matches[pass2]', ['matches' => 'Password tidak sama', 'min_length' => 'Password terlalu pendek!']);
        // $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]');

        $data['prodi'] = $this->db->get('tb_prodi')->result_array();


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('bapendik/tambah_mhs', $data);
            $this->load->view('templates/footer');
        } else {
            $nim = $this->input->post('nim_mhs');
            $data_user = array(
                'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'image' => 'default.jpg',
                'pass' => password_hash($nim, PASSWORD_DEFAULT),
                'gender' => $this->input->post('gender'),
                'telp' => $this->input->post('telp'),
                'role_id' => 1,
                'is_active' => 1,
                'tgl_dibuat' => time(),
            );

            $this->db->insert('tb_user', $data_user);
            $user_id = $this->db->insert_id();

            $data_mhs = array(
                'nim_mhs' => $nim,
                'prodi_id' => $this->input->post('prodi_id'),
                'user_id' => $user_id
                // 'alamat_mhs' => $this->input->post('alamat_mhs'),
            );

            $this->Model_Mahasiswa->insert_data($data_mhs, 'tb_mhs');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Berhasil di Tambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

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
