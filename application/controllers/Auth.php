<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_NIM');
		$this->load->model('Model_Mahasiswa');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Login';

			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			//validasi sukses
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

		//jika user ada
		if ($user) {
			//jika user aktif
			if ($user['is_active'] == 1) {
				//cek password
				if (password_verify($pass, $user['pass'])) {
					$nim_mhs = $this->Model_NIM->getNim($email);
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'nim_mhs' => $nim_mhs
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('mahasiswa');
					} elseif ($user['role_id'] == 2) {
						redirect('bapendik');
					} else {
						redirect('pimpinan');
					}
					//redirect('mahasiswa');
				} else {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Incorrect password</div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">This email has not been activated</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email not registered</div>');
			redirect('auth');
		}
	}

	public function registrasi()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
			'is_unique' => 'Email ini sudah terdaftar'
		]);
		$this->form_validation->set_rules('nip', 'NIP', 'required|trim');
		$this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[8]|callback_valid_password|matches[pass2]', [
			'matches' => 'Password is not the same!',
			'min_length' => 'The password is too short!'
		]);
		$this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Registrasi User';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasi');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama', TRUE)),
				'email' => htmlspecialchars($this->input->post('email', TRUE)),
				'nip' => htmlspecialchars($this->input->post('nip', TRUE)),
				'image' => 'admin.jpg',
				'pass' => password_hash($this->input->post('pass1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'agama_id' => 8,
				'goldar_id' => 5,
				'role_id' => 2,
				'is_active' => 1,
				'tgl_dibuat' => time(),
			];

			$this->db->insert('tb_user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Anda Berhasil Keluar!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
