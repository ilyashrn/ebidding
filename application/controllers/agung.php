<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agung extends CI_Controller {

	public function index()
	{
		
	}

	public function login_process()
	{
		$this->form_validation->set_rules('passwd', 'password', 'trim|required|min_length[5]|max_length[12]');
	}

}

/* End of file agung.php */
/* Location: ./application/controllers/agung.php */