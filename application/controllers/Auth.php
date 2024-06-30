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

	public function page(){
		$data['title'] = 'Login';
		$this->load->view('auth/template/header', $data);
		$this->load->view('auth/page');
		$this->load->view('auth/template/footer');
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

			// $email = $this->input->post('email');
			// $token = base64_encode(random_bytes(32));
			// $user_token = [
			// 	'email' => $email,
			// 	'token' => $token,
			// 	'date_created' => time()
			// ];

			// $this->db->insert('tb_user_token', $user_token);

			// $this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat!</div>');
			redirect('auth');
		}
	}

	// private function _sendEmail($token, $type)
	// {
	// 	$config = [
	// 		'protocol' => 'smtp',
	// 		'smtp_host' => 'ssl://smtp.googlemail.com',
	// 		'smtp_user' => 'engiscore@gmail.com',
	// 		'smtp_pass' => 'Coba_12345',
	// 		'smtp_port' => 456,
	// 		'mailtype' => 'html',
	// 		'charset' => 'utf-8',
	// 		'newline' => "\r\n"

	// 	];

	// 	$this->load->library('email', $config);
	// 	$this->email->from('engiscore@gmail.com', 'Engine Score');
	// 	$this->email->to($this->input->post('email'));

	// 	if ($type == 'verify') {
	// 		$this->email->subject('Account Verification');
	// 		$this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
	// 	} else if ($type == 'forgot') {
	// 		$this->email->subject('Reset Password');
	// 		$this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
	// 	}

	// 	if ($this->email->send()) {
	// 		return true;
	// 	} else {
	// 		echo $this->email->print_debugger();
	// 		die;
	// 	}
	// }

	// public function verify()
	// {
	// 	$email = $this->input->get('email');
	// 	$token = $this->input->get('token');

	// 	$user = $this->db->get_where('tb_user', ['email' => $email, 'is_active' => 1])->row_array();
	// 	if ($user) {
	// 		$user_token = $this->db->get_where('tb_user_token', ['token' => $token])->row_array();

	// 		if ($user_token) {
	// 			if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
	// 				$this->db->set('is_active', 1);
	// 				$this->db->where('email', $email);
	// 				$this->db->update('tb_user');

	// 				$this->db->delete('tb_user_token', ['email' => $email]);

	// 				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
	// 				redirect('auth');
	// 			} else {
	// 				// $this->db->delete('tb_user', ['email' => $email]);
	// 				$this->db->delete('tb_user_token', ['email' => $email]);

	// 				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
	// 			Account acctivation failed! Token expired.</div>');
	// 				redirect('auth');
	// 			}
	// 		} else {
	// 			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
	// 			Account acctivation failed! Wrong token.</div>');
	// 			redirect('auth');
	// 		}
	// 	} else {
	// 		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
	//         Account acctivation failed! Wrong email.</div>');
	// 		redirect('auth');
	// 	}
	// }

	// public function forgotpassword()
	// {
	// 	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	// 	if ($this->form_validation->run() == false) {
	// 		$data['title'] = 'Forgot Password';
	// 		$this->load->view('templates/auth_header', $data);
	// 		$this->load->view('auth/forgot-password');
	// 		$this->load->view('templates/auth_footer');
	// 	} else {
	// 		$email = $this->input->post('email');
	// 		$user = $this->db->get_where('tb_user', ['email' => $email, 'is_active' => 1])->row_array();
	// 		if ($user) {
	// 			$token = base64_encode(random_bytes(32));
	// 			$user_token = [
	// 				'email' => $email,
	// 				'token' => $token,
	// 				'date_created' => time()
	// 			];

	// 			$this->db->indert('user_token', $user_token);
	// 			$this->_sendEmail($token, 'forgot');
	// 			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
	// 			Please check your email to reset your password!</div>');
	// 			redirect('auth/forgotpassword');
	// 		} else {
	// 			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
	//         Email is not registered or activated!</div>');
	// 			redirect('auth/forgotpassword');
	// 		}
	// 	}
	// }

	// public function resetPassword()
	// {
	// 	$email = $this->input->get('email');
	// 	$token = $this->input->get('token');

	// 	$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

	// 	if ($user) {
	// 		$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

	// 		if ($user_token) {
	// 			$this->session->set_userdata('reset_email', $email);
	// 			$this->changePassword();
	// 		} else {
	// 			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
	//         Reset password failed! Wrong email.</div>');
	// 			redirect('auth');
	// 		}
	// 	} else {
	// 		$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
	//         Reset password failed! Wrong email.</div>');
	// 		redirect('auth');
	// 	}
	// }

	// public function changePassword()
	// {
	// 	if (!$this->session->userdata('reser_email')) {
	// 		redirect('auth');
	// 	}

	// 	$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|callback_valid_password|matches[password2]', [
	// 		'matches' => 'Password is not the same!',
	// 		'min_length' => 'The password is too short!'
	// 	]);
	// 	$this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
	// 	if ($this->form_validation->run() == false) {
	// 		$data['title'] = 'Change Password';
	// 		$this->load->view('templates/auth_header', $data);
	// 		$this->load->view('auth/change-password');
	// 		$this->load->view('templates/auth_footer');
	// 	} else {
	// 		$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
	// 		$email = $this->session->userdata('reset_email');

	// 		$this->db->set('pass', $password);
	// 		$this->db->where('email', $email);
	// 		$this->db->update('tb_user');

	// 		$this->session->unset_userdata('reset_email');
	// 		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
	//        Password has been changed! Please login.</div>');
	// 		redirect('auth');
	// 	}
	// }

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            You successfully logged out!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}
