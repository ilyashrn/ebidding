<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrators extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');	
		if ($this->session->userdata('a_id') == '') {
			redirect('admin/login','refresh');
		}
	}

	public function index()
	{
		$data = array(
			'title' => 'Administrators list | ',
			'users_list' => $this->administrators_model->get_all());
		$this->load->view('admin/plugins/css/datatable2');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/admin-table', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/datatable2');
	}

	public function add_new()
	{
		$data = array(
			'title' => 'New Admin | ');
		$this->load->view('admin/plugins/css/select2');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/add-admin', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/form-wizard');
	}

	public function add_new_process()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|callback_is_username_exist');
		$this->form_validation->set_rules('email', 'E-mail', 'required|callback_is_email_exist');
		
		if ($this->form_validation->run()) {
			$input = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'fullname' => $this->input->post('fullname'),
				'created_date' => date('Y-m-d')
			);	
			$this->administrators_model->insert($input);
			$this->session->set_flashdata('msg', 'An administrator has been created successfully.');
			redirect('admin/administrators/','refresh');
		} else {
			$this->session->set_flashdata('warn', validation_errors());
			redirect('admin/administrators/add_new','refresh');
		}
	}

	public function is_username_exist($username)
	{
		if ($this->administrators_model->check_entry('username',$username)) {
			$this->form_validation->set_message('is_username_exist','Username is unavailable, please select another name.');
			return false;
		} else {
			return true;
		}
	}

	public function is_email_exist($email)
	{
		if ($this->administrators_model->check_entry('email',$email)) {
			$this->form_validation->set_message('is_email_exist','E-mail is unavailable, please select another e-mail.');
			return false;
		} else {
			return true;
		}
	}

	public function delete($id_administrator)
	{
		$this->administrators_model->delete($id_administrator);
		$this->session->set_flashdata('msg', 'Administrator has been deleted.');
		redirect('admin/administrators','refresh');
	}

	public function edit_process()
	{
		$update = array(
			'fullname' => $this->input->post('fullname'),
			'last_updated' => mdate('%Y-%m-%d %h:%i:%s',now('Asia/Jakarta'))
		);
		$this->administrators_model->update($update, $this->input->post('id_administrator'));

		if ($this->input->post('password') !== '') {
			$pass = array('password' => md5($this->input->post('password')));
			$this->administrators_model->update($pass,$this->input->post('id_administrator'));
		}

		if ($this->input->post('username') !== $this->input->post('current_username')) {
			$this->form_validation->set_rules('username', 'Username', 'required|callback_is_username_exist');	
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('warn', validation_errors());
				redirect('admin/administrators','refresh');
			} else {
				$new_username = array('username' => $this->input->post('username'));
				$this->administrators_model->update($new_username, $this->input->post('id_administrator'));
			}
		}

		if ($this->input->post('email') !== $this->input->post('current_email')) {
			$this->form_validation->set_rules('email', 'E-mail', 'required|callback_is_email_exist');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('warn', validation_errors());
				redirect('admin/administrators','refresh');
			} else {
				$new_email = array('email' => $this->input->post('email'));
				$this->administrators_model->update($new_email, $this->input->post('id_administrator'));
			}
		}
		$this->session->set_flashdata('msg', 'Profile has been updated.');
		redirect('admin/administrators','refresh');

	}

}

/* End of file administrators.php */
/* Location: ./application/controllers/admin/administrators.php */