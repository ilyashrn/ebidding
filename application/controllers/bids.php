<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bids extends CI_Controller {

	public $header_categories;

	public function __construct() {
		parent::__construct();
		$this->header_categories = $this->categories_model->get_all_categories();
	}

	public function sent($id,$username)
	{
		$data = array(
			'title' => 'Bid Keluar '.$username.' | ',
			'subtitle' => 'Bid Keluar',
			'mem_detail' => $this->members_model->get('id_member',$id),
			'bids' => $this->bids_model->get_per_bidder($id), 
			'sold_rec' => $this->auctions_model->get_sold_rows($id),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($id),
			'bids_out' => $this->bids_model->get_per_bidder_rows($id),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($id),
			'header_categories' => $this->header_categories
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-auc-sent', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);	
	}

	public function incoming($id,$username)
	{
		$data = array(
			'title' => 'Bid Masuk '.$username.' | ',
			'subtitle' => 'Bid masuk',
			'mem_detail' => $this->members_model->get('id_member',$id),
			'bids' => $this->bids_model->get_per_auctioneer($id), 
			'sold_rec' => $this->auctions_model->get_sold_rows($id),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($id),
			'bids_out' => $this->bids_model->get_per_bidder_rows($id),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($id),
			'header_categories' => $this->header_categories
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-auc-sent', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);
	}
}

/* End of file bid.php */
/* Location: ./application/controllers/bid.php */