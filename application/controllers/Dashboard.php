<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Model_User');
    }

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['jumlah_mhs'] = $this->Model_User->get_jumlah_mahasiswa();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('dashboard');
		$this->load->view('templates/footer');
	}
}
