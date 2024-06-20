<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mahasiswa');
        $this->load->model('Model_Sertifikat');
        $this->load->model('Model_NIM');
        // is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mahasiswa'] = $this->Model_Mahasiswa->getMhs();
        $data['nim_mhs'] = $this->session->userdata('nim_mhs');

        $data['points'] = $this->Model_Mahasiswa->getPoin($data['user']['email']);
        if ($data['points'] === null) {
            show_error('Poin tidak ditemukan untuk pengguna yang sedang login.', 500, 'Kesalahan Data Pengguna');
        }

        // Ambil nim mahasiswa
        $this->load->model('Model_NIM');
        $nim_mhs = $this->Model_NIM->getNim($data['user']['email']);

        // Ambil jumlah pengajuan berdasarkan nim mahasiswa
        $data['jumlah_pengajuan'] = $this->Model_Mahasiswa->countPengajuan($nim_mhs);
        $data['jumlah_permosetuju'] = $this->Model_Mahasiswa->get_jumlah_permohonansetuju($nim_mhs);
        $data['jumlah_permotolak'] = $this->Model_Mahasiswa->get_jumlah_permohonantolak($nim_mhs);


        // Ambil data mahasiswa berdasarkan email pengguna yang sedang login
        $mhs_data = $this->Model_Mahasiswa->getDataMhs($data['user']['email']);
        $data['mhs_data'] = $mhs_data;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'My Profil';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nim_mhs'] = $this->session->userdata('nim_mhs');

        // Memuat model yang diperlukan
        $this->load->model('Model_NIM');
        $this->load->model('Model_Mahasiswa');

        // Mendapatkan NIM mahasiswa berdasarkan email
        $nim_mhs = $this->Model_NIM->getNim($data['user']['email']);
        $data['nim_mhs'] = $nim_mhs;

        // Mendapatkan data mahasiswa berdasarkan email
        $mhs_data = $this->Model_Mahasiswa->getDataMhs($data['user']['email']);
        $data['mhs_data'] = $mhs_data;

        // Get the user's detailed profile including agama and goldar
        $user_id = $data['user']['id'];
        $data['user'] = $this->Model_Mahasiswa->get_mahasiswa($user_id);


        // Mendapatkan data agama dan golongan darah dari tabel terkait
        $data['agama'] = $this->db->get('tb_agama')->result_array();
        $data['goldar'] = $this->db->get('tb_goldar')->result_array();

        // Memuat view dengan data yang diperlukan
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/profil', $data);
        $this->load->view('templates/footer');
    }

    
    public function updatebiodata()
    {
        // Dapatkan data user
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
    
        $user_id = $data['user']['id'];
        $data['user'] = $this->Model_Mahasiswa->get_mahasiswa($user_id);
    
        // Validasi form
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'valid_email' => 'Format email tidak benar'
        ]);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin');
        $this->form_validation->set_rules('telp', 'No Telp');
        $this->form_validation->set_rules('alamat', 'Alamat');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir');
        $this->form_validation->set_rules('agama', 'Agama');
        $this->form_validation->set_rules('goldar', 'Golongan Darah');
    
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Biodata';
            $data['agama_list'] = $this->db->get('tb_agama')->result_array();
            $data['goldar_list'] = $this->db->get('tb_goldar')->result_array();
    
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('mahasiswa/updatebiodata', $data);
            $this->load->view('templates/footer');
        } else {
            // Upload gambar
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048';
                $config['file_name'] = 'profile_' . $user_id;
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
    
                    // Hapus gambar lama jika bukan default
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        if (file_exists(FCPATH . 'assets/img/profile/' . $old_image)) {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('mahasiswa/profil');
                    return;
                }
            } else {
                $image = $data['user']['image'];
            }
    
            // Data yang akan diupdate
            $updateData = [
                'agama_id' => $this->input->post('agama'),
                'goldar_id' => $this->input->post('goldar'),
                'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', TRUE)),
                'gender' => $this->input->post('gender'),
                'telp' => htmlspecialchars($this->input->post('telp', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'alamat' => htmlspecialchars($this->input->post('alamat', TRUE)),
                'image' => $image
            ];
    
            // Update biodata
            $this->Model_Mahasiswa->update_biodata($user_id, $updateData);
    
            $this->session->set_flashdata('message', 'Biodata updated successfully!');
            redirect('mahasiswa/profil');
        }
    }

    public function pengajuan()
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
        $data['capaian'] = $this->db->get('tb_sertif_capaian')->result_array();

        $this->form_validation->set_rules('bidang_id', 'Bidang', 'required', array('required' => 'Bidang harus diisi.'));
        $this->form_validation->set_rules('capaian_id', 'Capaian', 'required', array('required' => 'Capaian harus diisi.'));
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required', array('required' => 'Kategori harus diisi.'));
        // $this->form_validation->set_rules('file', 'File', 'required', array('required' => 'File harus diisi.'));
        if (empty($_FILES['file']['name'])) {
            $this->form_validation->set_rules('file', 'File', 'required', array('required' => 'File harus diisi.'));
        }

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('mahasiswa/pengajuan', $data);
            $this->load->view('templates/footer');
        } else {
            // Konfigurasi pengunggahan file
            $config['upload_path'] = './assets/img/sertifikat/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['max_size'] = 2048; // 2MB
            $config['file_name'] = time() . '_' . $_FILES['file']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file')) {
                $file_data = $this->upload->data();
                $sertif_data = [
                    'nim_mhs' => $nim_mhs, // Gunakan nim_mhs yang telah diambil dari model
                    'bidang_id' => $this->input->post('bidang_id'),
                    'capaian_id' => $this->input->post('capaian_id'),
                    'kategori_id' => $this->input->post('kategori_id'),
                    'file' => $file_data['file_name'],
                ];

                $this->db->insert('tb_permo', $sertif_data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data sertifikat berhasil ditambahkan!</div>');
                redirect('mahasiswa/pengajuan');
            } else {
                $data['error'] = $this->upload->display_errors();
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('mahasiswa/pengajuan', $data);
                $this->load->view('templates/footer');
            }
        }
    }


    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nim_mhs'] = $this->Model_NIM->getNim($data['user']['email']);
        $data['points'] = $this->Model_Mahasiswa->getPoin($data['user']['email']);

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
