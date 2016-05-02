<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

	public $header_categories;

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->header_categories = $this->categories_model->get_all_categories();
	}

	public function index($username)
	{
		$id_member = $this->members_model->get_id($username);
		$data = array(
			'title' => 'Notifikasi | ',
			'subtitle' => 'Notifikasi '.$username,
			'mem_detail' => $this->members_model->get('username',$username),
			'notifications' => $this->notifications_model->get_per_member($id_member),
			'sold_rec' => $this->auctions_model->get_sold_rows($id_member),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($id_member),
			'bids_out' => $this->bids_model->get_per_bidder_rows($id_member),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($id_member),
			'header_categories' => $this->header_categories
		);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-notifications', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);	
	}

	public function mark_all_read()
	{
		$upd = array('is_read' => 1);
		$this->notifications_model->update($upd,$this->input->post('id_receiver'));
		redirect($this->input->post('current_uri'),'refresh');
	}

	public function delete_all()
	{
		$this->notifications_model->delete($this->input->post('id_receiver'));
		redirect($this->input->post('current_uri'),'refresh');
	}

}

/* End of file notifications.php */
/* Location: ./application/controllers/notifications.php */