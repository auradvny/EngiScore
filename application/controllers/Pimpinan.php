<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_User');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['jumlah_mhs'] = $this->Model_User->get_jumlah_mahasiswa();
        $data['jumlah_permo'] = $this->Model_User->get_jumlah_permohonan();
        $data['jumlah_permosetuju'] = $this->Model_User->get_jumlah_permohonansetuju();
        $data['jumlah_permotolak'] = $this->Model_User->get_jumlah_permohonantolak();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pimpinan/index', $data);
        $this->load->view('templates/footer');
    }

    public function profil()
    {
        $data['title'] = 'My Profil';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Model_User');
        // Get the user's detailed profile including agama and goldar
        $user_id = $data['user']['id'];
        $data['user'] = $this->Model_User->get_pimpinan($user_id);

        // Mendapatkan data agama dan golongan darah dari tabel terkait
        $data['agama'] = $this->db->get('tb_agama')->result_array();
        $data['goldar'] = $this->db->get('tb_goldar')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pimpinan/profil', $data);
        $this->load->view('templates/footer');
    }

    public function updatebiodata()
    {
        // UPDATE GAMBAR BELUM SELESAI

        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        // Get user ID from session data
        $user_id = $data['user']['id'];
        $data['user'] = $this->Model_User->get_pimpinan($user_id);

        // Form validation rules
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
            $this->load->view('pimpinan/updatebiodata', $data);
            $this->load->view('templates/footer');
        } else {
            // Menangani unggahan file gambar baru jika ada
            if (!empty($_FILES['image']['name'])) {
                // Konfigurasi upload
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '2048'; // Maksimal 2MB
                $config['file_name'] = 'profile_' . $user_id; // Penamaan file

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // Berhasil mengupload gambar baru
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];

                    // Menghapus gambar lama jika bukan gambar default
                    $old_image = $this->input->post('old_image');
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                } else {
                    // Menangani error upload
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('pimpinan/profil');
                }
            } else {
                // Jika tidak ada gambar baru diunggah, gunakan gambar lama
                $image = $this->input->post('old_image');
            }

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

            $this->Model_User->update_biodata($user_id, $updateData);

            $this->session->set_flashdata('message', 'Biodata updated successfully!');
            redirect('pimpinan/profil');
        }
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

    public function bapendik()
    {
        $data['title'] = 'Bapendik';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik', $data);
        $this->load->view('templates/footer');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Model_Laporan');
        $data['laporan'] = $this->Model_Laporan->get_laporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('bapendik/laporan', $data);
        $this->load->view('templates/footer');
    }
}
