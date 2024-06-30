<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('dashboard/template/header', $data);
        $this->load->view('dashboard/page');
        $this->load->view('dashboard/template/footer');
    }
}
