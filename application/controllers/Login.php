<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('login');
    }

    public function proses_login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Memuat model untuk mahasiswa
        $this->load->model('Model_Mahasiswa');
        $mahasiswa = $this->Model_Mahasiswa->get_user_by_email($email);

        if ($mahasiswa && password_verify($password, $mahasiswa->pass_mhs)) {
            // Set session data untuk mahasiswa
            $this->session->set_userdata('mahasiswa_id', $mahasiswa->nim_mhs);
            redirect('dashboard'); // Asumsi ada controller untuk dashboard mahasiswa
        } else {
            // Handle login failure
            $this->session->set_flashdata('login_error', 'Email atau password salah');
            redirect('login');
        }
    }
}
