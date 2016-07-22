<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

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
			'title' => 'Members list | ',
			'users_list' => $this->members_model->get_all() );
		$this->load->view('admin/plugins/css/datatable');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/users-table', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/datatable');
	}

	public function delete($id_member)
	{
		$this->members_model->delete($id_member);
		$auctions = $this->auctions_model->get_per_auctioneer($id_member);
		if ($auctions) {
			foreach ($auctions as $auc) {
				$this->products_model->delete($auc->id_product);
			}
		}
		$this->session->set_flashdata('msg', 'One member has been deleted.');
		redirect('admin/members','refresh');
	}

	public function add_new()
	{
		$data = array(
			'title' => 'New Member | ');
		$this->load->view('admin/plugins/css/select2');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/add-user', $data);
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
				'address' => $this->input->post('address'),
				'postal_code' => $this->input->post('postal_code'), 
				'city' => $this->input->post('city'),
				'province' => $this->input->post('province'),
				'phone_number' =>$this->input->post('phone_number'),
				'join_date' => date('Y-m-d')
			);	
			$this->members_model->insert($input);
			$this->session->set_flashdata('msg', 'A member has been created successfully.');
			redirect('admin/members/','refresh');
		} else {
			$this->session->set_flashdata('warn', validation_errors());
			redirect('admin/members/add_new','refresh');
		}
	}

	public function is_username_exist($username)
	{
		if ($this->members_model->check_entry('username',$username)) {
			$this->form_validation->set_message('is_username_exist','Username is unavailable, please select another name.');
			return false;
		} else {
			return true;
		}
	}

	public function is_email_exist($email)
	{
		if ($this->members_model->check_entry('email',$email)) {
			$this->form_validation->set_message('is_email_exist','E-mail is unavailable, please select another e-mail.');
			return false;
		} else {
			return true;
		}
	}

	public function edit($id_member,$username)
	{
		$data = array(
			'title' => 'Members list | ',
			'user_detail' => $this->members_model->get('username',$username),
			'auc_count1' => $this->auctions_model->get_sold_rows($id_member),
			'auc_count2' => $this->auctions_model->get_forsale_rows($id_member),
			'bid_count' => $this->bids_model->get_per_bidder_rows($id_member),
			'bid_out' => $this->bids_model->get_per_bidder($id_member),
			'auctions' => $this->auctions_model->get_per_auctioneer($id_member),
			'reviews1' => $this->reviews_model->get_per_type_per_member($id_member,1),
			'reviews2' => $this->reviews_model->get_per_type_per_member($id_member,0)
			 );
		// $this->load->view('admin/plugins/css/profile');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/user-edit', $data);
		// $this->load->view('admin/content/tes', $data);
		$this->load->view('admin/footer', $data);	
		$this->load->view('admin/plugins/profile');	
	}

	public function edit_avatar()
	{
		// print_r($this->input->post());
		$config['upload_path'] = './assets/img/avatar/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name'] = TRUE;
		$config['overwrite'] = FALSE;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$upload = $this->upload->do_upload('avatar');	
		$upload_data = $this->upload->data(); //UPLOAD DATA AFTER UPLOADING
		$file_name = $upload_data['file_name']; //RETRIEVING FILE NAME

		if ($upload) {
			$update = array('avatar' => $file_name, 'last_updated' => mdate('%Y-%m-%d %h:%i:%s',now('Asia/Jakarta')));
			$this->members_model->update($update, $this->input->post('id_member'));	
			$this->session->set_flashdata('msg', 'Avatar has been changed succesfully.');
			redirect('admin/members/edit/'.$this->input->post('id_member').'/'.$this->input->post('username'),'refresh');
		} else {
			$this->session->set_flashdata('warn', $this->upload->display_errors());
			redirect('admin/members/edit/'.$this->input->post('id_member').'/'.$this->input->post('username'),'refresh');
		}
	}

	public function edit_password()
	{
		$this->form_validation->set_rules('pass_conf', 'password confirmation', 'required');
		$this->form_validation->set_rules('password', 'password', 'required|matches[pass_conf]');
		$update = array(
			'password' => md5($this->input->post('password')));		
		if ($this->form_validation->run()) {
			$this->members_model->update($update,$this->input->post('id_member'));
			$this->session->set_flashdata('msg', 'Password has been changed.');
			redirect($this->input->post('current_uri'),'refresh');
		} else {
			$this->session->set_flashdata('warn', validation_errors());
			redirect($this->input->post('current_uri'),'refresh');
		}
	}

	public function edit_process()
	{
		$update = array(
			'fullname' => $this->input->post('fullname'),
			'address' => $this->input->post('address'),
			'postal_code' => $this->input->post('postal_code'), 
			'city' => $this->input->post('city'),
			'province' => $this->input->post('province'),
			'phone_number' =>$this->input->post('phone_number'),
			'last_updated' => mdate('%Y-%m-%d %h:%i:%s',now('Asia/Jakarta'))
		);

		$this->members_model->update($update, $this->input->post('current_id'));

		if ($this->input->post('username') !== $this->input->post('current_username')) {
			$this->form_validation->set_rules('username', 'Username', 'required|callback_is_username_exist');	
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('warn', validation_errors());
				redirect('admin/members/edit/'.$this->input->post('current_id').'/'.$this->input->post('current_username'),'refresh');
			} else {
				$new_username = array('username' => $this->input->post('username'));
				$this->members_model->update($new_username, $this->input->post('current_id'));
			}
		}

		if ($this->input->post('email') !== $this->input->post('current_email')) {
			$this->form_validation->set_rules('email', 'E-mail', 'required|callback_is_email_exist');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('warn', validation_errors());
				redirect('admin/members/edit/'.$this->input->post('current_id').'/'.$this->input->post('current_username'),'refresh');
			} else {
				$new_email = array('email' => $this->input->post('email'));
				$this->members_model->update($new_email, $this->input->post('current_id'));
			}
		}
		$this->session->set_flashdata('msg', 'Profile has been updated.');
		redirect('admin/members/edit/'.$this->input->post('current_id').'/'.$this->input->post('username'),'refresh');
	}

}

/* End of file members.php */
/* Location: ./application/controllers/admin/members.php */