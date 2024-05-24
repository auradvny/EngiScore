<?php
<<<<<<< HEAD
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('email_mhs', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('pass_mhs', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';

            $this->load->view('login');
        } else {
            //validasi sukses
            $this->proses_login();
        }
=======
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('login');
>>>>>>> 8542ac644ce54786091aeb05d7d3aa1c37d5e217
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
<<<<<<< HEAD

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Anda Telah Keluar!</div>');
        redirect('auth');
    }
=======
>>>>>>> 8542ac644ce54786091aeb05d7d3aa1c37d5e217
}
