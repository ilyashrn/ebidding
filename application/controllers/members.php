<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public $header_categories;

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->header_categories = $this->categories_model->get_all_categories();
	}

	public function create_process()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|callback_is_username_exist');
		$this->form_validation->set_rules('email', 'E-mail', 'required|callback_is_email_exist');
		
		if ($this->form_validation->run()) {
			$input = array(
				'fullname' => $this->input->post('fullname'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'join_date' => date('Y-m-d')
			);	
			$this->members_model->insert($input);
			$this->session->set_flashdata('success', $this->input->post('username'));
			redirect('main/register_succesfull','refresh');
		} else {
			$this->session->set_flashdata('username', $this->input->post('username'));
			$this->session->set_flashdata('fullname', $this->input->post('fullname'));
			$this->session->set_flashdata('email', $this->input->post('email'));
			$this->session->set_flashdata('warn', validation_errors());
			redirect('main/create_account','refresh');
		}
	}

	public function is_username_exist($username)
	{
		if ($this->members_model->check_entry('username',$username)) {
			$this->form_validation->set_message('is_username_exist','Username tidak tersedia, silahkan pilih username lain.');
			return false;
		} else {
			return true;
		}
	}

	public function is_email_exist($email)
	{
		if ($this->members_model->check_entry('email',$email)) {
			$this->form_validation->set_message('is_email_exist','E-mail yang kamu masukkan sudah terdaftar.');
			return false;
		} else {
			return true;
		}
	}

	public function detail($username)
	{
		$mem_detail = $this->members_model->get('username',$username);
		$data = array(
			'title' => $mem_detail->fullname.' | ',
			'mem_detail' => $mem_detail,
			'sold_rec' => $this->auctions_model->get_sold_rows($mem_detail->id_member),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($mem_detail->id_member),
			'bids_out' => $this->bids_model->get_per_bidder_rows($mem_detail->id_member),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($mem_detail->id_member),
			'header_categories' => $this->header_categories
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-detail', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);	
	}

	public function edit_profile($id,$username)
	{
		$mem_detail = $this->members_model->get('id_member',$id);
		$data = array(
			'title' => 'Ubah '.$mem_detail->fullname.' | ',
			'mem_detail' => $mem_detail,
			'sold_rec' => $this->auctions_model->get_sold_rows($mem_detail->id_member),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($mem_detail->id_member),
			'bids_out' => $this->bids_model->get_per_bidder_rows($mem_detail->id_member),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($mem_detail->id_member),
			'header_categories' => $this->header_categories
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-edit', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);		
	}

	public function edit_process()
	{
		if ($_FILES['avatar']['size'] == 0) {
			$file_name = $this->input->post('cur_avatar');	
		} else {
			$config['upload_path'] = './assets/img/avatar/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$upload = $this->upload->do_upload('avatar');	
			$upload_data = $this->upload->data(); //UPLOAD DATA AFTER UPLOADING
			$file_name = $upload_data['file_name']; //RETRIEVING FILE NAME
		}	
		print_r($this->input->post());
		print_r($file_name);

		$update = array(
			'fullname' => $this->input->post('fullname'),
			'address' => $this->input->post('address'),
			'postal_code' => $this->input->post('postal_code'), 
			'city' => $this->input->post('city'),
			'province' => $this->input->post('province'),
			'phone_number' =>$this->input->post('phone_number'),
			'avatar' => $file_name,
			'last_updated' => mdate('%Y-%m-%d %h:%i:%s',now('Asia/Jakarta'))
		);

		$this->members_model->update($update, $this->input->post('current_id'));

		if ($this->input->post('username') !== $this->input->post('current_username')) {
			$this->form_validation->set_rules('username', 'Username', 'required|callback_is_username_exist');	
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('warn', validation_errors());
				redirect('members/edit_profile/'.$this->input->post('current_id').'/'.$this->input->post('current_username'),'refresh');
			} else {
				$new_username = array('username' => $this->input->post('username'));
				$this->members_model->update($new_username, $this->input->post('current_id'));
			}
		}

		if ($this->input->post('email') !== $this->input->post('current_email')) {
			$this->form_validation->set_rules('email', 'E-mail', 'required|callback_is_email_exist');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('warn', validation_errors());
				redirect('members/edit_profile/'.$this->input->post('current_id').'/'.$this->input->post('current_username'),'refresh');
			} else {
				$new_email = array('email' => $this->input->post('email'));
				$this->members_model->update($new_email, $this->input->post('current_id'));
			}
		}
		$this->session->set_flashdata('msg', 'Profil berhasil diperbarui.');
		redirect('members/detail/'.$this->input->post('current_username'),'refresh');
	}

	public function reviews($username)
	{
		$mem_detail = $this->members_model->get('username',$username);
		$data = array(
			'title' => $mem_detail->fullname.' | ',
			'subtitle' => 'Review '.$mem_detail->username,
			'mem_detail' => $mem_detail,
			'reviews' => $this->reviews_model->get_per_member($mem_detail->id_member),
			'sold_rec' => $this->auctions_model->get_sold_rows($mem_detail->id_member),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($mem_detail->id_member),
			'bids_out' => $this->bids_model->get_per_bidder_rows($mem_detail->id_member),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($mem_detail->id_member),
			'header_categories' => $this->header_categories
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-review', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);	
	}

	public function set_review()
	{
		$input = array(
			'id_auction' => $this->input->post('id_auction'),
			'id_giver' => $this->session->userdata('id'),
			'id_receiver' => $this->input->post('id_receiver'),
			'review_type' => $this->input->post('review_type'),
			'review_content' => $this->input->post('review_content'),
			'review_subject' => $this->input->post('review_subject')
		);
		$this->reviews_model->insert($input);

		$this->set_notification_for_review(
			$this->input->post('id_auction'),
			$this->session->userdata('id'),
			$this->input->post('id_receiver')
			);
		$this->session->set_flashdata('msg', 'Review berhasil diberikan.');
		redirect($this->input->post('current_uri'),'refresh');
	}

	public function set_notification_for_review($id_auction,$id_giver,$id_receiver)
	{
		$input = array(
			'id_auction' => $id_auction,
			'notification_type' => 'review',
			'id_giver' => $id_giver,
			'id_receiver' => $id_receiver,
			'is_read' => false);		
		$this->notifications_model->insert($input); 
	}
	
}

/* End of file member.php */
/* Location: ./application/controllers/member.php */