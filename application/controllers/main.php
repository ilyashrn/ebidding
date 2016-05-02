<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public $header_categories;

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->header_categories = $this->categories_model->get_all_categories();
	}

	public function index()
	{
		$data = array(
			'title' => '',
			'header_categories' => $this->header_categories);
		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/home', $data);
		$this->load->view('footer', $data);
		$this->load->view('slider-script');
	}

	public function login()
	{
		if ($this->session->userdata('username')) { //LOGIN-ED
			redirect('main','refresh');
		} else {
			$data = array('title' => 'Login atau daftar | ','header_categories' => $this->header_categories);
			$this->load->view('html_head', $data);
			$this->load->view('header', $data);
			$this->load->view('content/login', $data);
			$this->load->view('footer', $data);	
		}
		
	}

	public function login_process()
	{
		$login_check = $this->members_model->login(
			$this->input->post('login_id'),
			md5($this->input->post('password'))
		);

		if ($login_check) {
			$sess_array = array(
				'id' => $login_check->id_member,
				'username' => $login_check->username,
				'email' => $login_check->email,
				'fullname' => $login_check->fullname
			);
			$this->session->set_userdata($sess_array);
			redirect('main','refresh');
		} else {
			$this->session->set_flashdata('warn', 'Username/email atau password yang kamu masukkan salah.');
			redirect('main/login','refresh');
		}
	}

	public function create_account()
	{
		$data = array('title' => 'Daftar baru | ','header_categories' => $this->header_categories);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/register', $data);
		$this->load->view('footer', $data);

	}

	public function register_succesfull()
	{
		if ($this->session->flashdata('success')) {
			$data = array('title' => 'Registration successfull | ','header_categories' => $this->header_categories);
			
			$this->load->view('html_head', $data);
			$this->load->view('header', $data);
			$this->load->view('content/register-success', $data);
			$this->load->view('footer', $data);	
		} else {
			redirect('main','refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main','refresh');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */