<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$data = array('title' => 'Dashboard', );
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/dashboard', $data);
		$this->load->view('admin/footer', $data);
	}

}

/* End of file index.php */
/* Location: ./application/controllers/admin/index.php */