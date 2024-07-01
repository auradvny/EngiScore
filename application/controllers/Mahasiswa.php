<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Model_Mahasiswa');
        $this->load->model('Model_Sertifikat');
        $this->load->model('Model_NIM');
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

        // Mengambil data user dari database
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user'] === NULL) {
            // Tangani jika user tidak ditemukan
            $data['user'] = [
                'id' => 0,
                'nama' => 'Nama tidak tersedia',
                'email' => '',
                'image' => 'default.png',
                'agama_id' => 0,
                'goldar_id' => 0,
                'tgl_lahir' => '',
                'gender' => '',
                'telp' => '',
                'alamat' => ''
            ];
        }

        // Memuat model yang diperlukan
        $this->load->model('Model_NIM');
        $this->load->model('Model_Mahasiswa');

        // Mendapatkan NIM mahasiswa berdasarkan email
        $nim_mhs = $this->Model_NIM->getNim($data['user']['email']);
        if ($nim_mhs === NULL) {
            $nim_mhs = 'NIM tidak tersedia';
        }
        $data['nim_mhs'] = $nim_mhs;

        // Mendapatkan data mahasiswa berdasarkan email
        $mhs_data = $this->Model_Mahasiswa->getDataMhs($data['user']['email']);
        if ($mhs_data === NULL) {
            $mhs_data = [
                'nim_mhs' => 'NIM tidak tersedia',
            ];
        }
        $data['mhs_data'] = $mhs_data;

        // Get the user's detailed profile including agama and goldar
        $user_id = $data['user']['id'];
        $user_data = $this->Model_Mahasiswa->get_mahasiswa($user_id);
        if ($user_data === NULL) {
            $user_data = $data['user'];
        }
        $data['user'] = $user_data;

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
            // Upload gambar jika ada yang diunggah
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
                    if ($old_image != 'default.png') {
                        $old_image_path = './assets/img/profile/' . $old_image;
                        if (file_exists($old_image_path)) {
                            unlink($old_image_path);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('mahasiswa/profil');
                    return;
                }
            } else {
                // Jika tidak ada gambar yang diunggah, gunakan gambar lama
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

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Biodata Berhasil Diubah!');
            redirect('mahasiswa/profil');
        }
    }

    public function updatepassword()
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Password Saat Ini', 'required|trim', [
            'required' => 'Password Baru harus diisi'
        ]);
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim|min_length[8]|callback_valid_password|matches[confirm_password]', [
            'required' => 'Password Baru harus diisi',
            'matches' => 'Password tidak sesuai',
            'min_length' => 'Password terlalu pendek'
        ]);
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|trim|matches[new_password]', [
            'required' => 'Konfirmasi Password harus diisi',
            'matches' => 'Password tidak sesuai',
            'min_length' => 'Password terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->profil();
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password');

            // Memeriksa apakah password saat ini sesuai
            if (!password_verify($current_password, $data['user']['pass'])) {
                $this->session->set_flashdata('pesan', 'Password Salah');
            } else {
                // Memeriksa apakah password baru sama dengan password lama
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password baru tidak boleh sama dengan password lama');
                } else {
                    // Hash password baru
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    // Simpan password baru ke dalam basis data
                    $this->db->set('pass', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('tb_user');

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Password Berhasil Diubah!</div>');
                }
            }

            // Setelah proses selesai, redirect ke halaman profil
            redirect('mahasiswa/profil');
        }
    }

    public function valid_password($password)
    {
        $password = trim($password);
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/';

        if (preg_match($regex, $password)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_password', 'The password must be at least 8 characters long, containing at least one capital letter, one lowercase letter, one number, and one symbol.');
            return FALSE;
        }
    }

    public function pengajuan()
    {
        $data['title'] = 'Pengajuan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        date_default_timezone_set('Asia/Jakarta');

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


        // Ambil nim mahasiswa
        $this->load->model('Model_NIM');
        $nim_mhs = $this->Model_NIM->getNim($data['user']['email']);

        $data['permohonan'] = $this->Model_Mahasiswa->getPermohonan($nim_mhs);

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
                    'tgl_permo' => time(),
                    'file' => $file_data['file_name'],
                ];

                $this->db->insert('tb_permo', $sertif_data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data pengajuan sertifikat berhasil ditambahkan!</div>');
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

    public function getCapaianByBidang($bidang_id)
    {
        $this->load->model('Model_Sertifikat');
        $capaian = $this->Model_Sertifikat->getCapaianByBidang($bidang_id);
        echo json_encode($capaian);
    }

    public function getKategoriByBidangAndCapaian($bidang_id, $capaian_id)
    {
        $this->load->model('Model_Sertifikat');
        $kategori = $this->Model_Sertifikat->getKategoriByBidangAndCapaian($bidang_id, $capaian_id);
        echo json_encode($kategori);
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        // Memastikan Model_Mahasiswa dimuat
        $this->load->model('Model_Mahasiswa');

        // Mendapatkan data mahasiswa termasuk nim_mhs berdasarkan email
        $mahasiswa = $this->Model_Mahasiswa->getDataMhs($data['user']['email']);

        if ($mahasiswa) {
            $data['nim_mhs'] = $mahasiswa['nim_mhs'];
            $data['points'] = $this->Model_Mahasiswa->getPoin($data['user']['email']);

            // Mendapatkan data permohonan berdasarkan nim_mhs
            $data['permohonan'] = $this->Model_Mahasiswa->getPermohonanByNim($data['nim_mhs']);
            // Mendapatkan data sertifikat
            $data['sertif'] = $this->Model_Sertifikat->getSertif();
        } else {
            $data['nim_mhs'] = null;
            $data['points'] = [];
            $data['permohonan'] = [];
            $data['sertif'] = [];
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('mahasiswa/laporan', $data);
        $this->load->view('templates/footer');
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
}
