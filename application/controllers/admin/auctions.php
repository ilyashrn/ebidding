<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auctions extends CI_Controller {

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
		$arr = array('name' => '', 
			'price_from' => '', 
			'price_to' => '', 
			'product_category' => '', 
			'status' => '', 
			'bids' => '', 
			'views' => ''
			);
		$this->session->unset_userdata( $arr );
		$auc_list = $this->auctions_model->get__all();

		$data = array(
			'title' => 'Auctions list | ',
			'auc_list' => $auc_list,
			'cat_list' => $this->categories_model->get_all_categories());
		$this->load->view('admin/plugins/css/products');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/auc-table2', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/products');
	}

	public function search()
	{
		if (!$this->input->post()) {
			redirect('admin/auctions','refresh');
		}

		$auc_list = $this->auctions_model->admin_refine_search(
			$this->input->post('name'),
			$this->input->post('product_category'),
			$this->input->post('price_from'),
			$this->input->post('price_to'),
			$this->input->post('status'),
			$this->input->post('bids'),
			$this->input->post('views'));
		
		$this->session->set_userdata('name', $this->input->post('name'));
		$this->session->set_userdata('price_from', $this->input->post('price_from'));
		$this->session->set_userdata('price_to', $this->input->post('price_to'));
		$this->session->set_userdata('product_category', $this->input->post('product_category'));
		$this->session->set_userdata('status', $this->input->post('status'));
		$this->session->set_userdata('bids', $this->input->post('bids'));
		$this->session->set_userdata('views', $this->input->post('views'));
		// $this->session->set_userdata('search', true);

		$data = array(
			'title' => 'Auctions list | ',
			'auc_list' => $auc_list,
			'cat_list' => $this->categories_model->get_all_categories());
		$this->load->view('admin/plugins/css/products');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/auc-table2', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/products');

	}

	public function detail($id_auction)
	{
		$auc_detail = $this->auctions_model->get($id_auction);
		$data = array(
			'title' => $auc_detail->name.' | ',
			'auc_detail' => $auc_detail,
			'cat_list' => $this->categories_model->get_all_categories(),
			'bids' => $this->bids_model->get_per_auction($id_auction),
			'bids_count' => $this->bids_model->get_per_auction_rows($id_auction),
			'imgs' => $this->products_picts_model->get_per_product($auc_detail->id_product),
			'imgs_count' => $this->products_picts_model->get_per_product_rows($auc_detail->id_product),
			'reviews' => $this->reviews_model->get_per_auction($id_auction),
			'reviews_count' => $this->reviews_model->get_per_auction_rows($id_auction)

		);

		$this->load->view('admin/plugins/css/bootstrap-file');
		$this->load->view('admin/plugins/css/product-edit');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/auc-detail', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/product-edit');
		$this->load->view('admin/plugins/bootstrap-file');
	}

	public function edit_process()
	{
		$datestring = '%Y-%m-%d %h:%i:%s';
  		$now = mdate($datestring,now('Asia/Jakarta'));
		$upd_product = array(
			'name' => $this->input->post('name'),
			'condition' => $this->input->post('condition'), 
			'description' => $this->input->post('description'),
			'id_category' => $this->input->post('sub_category')
		);	

		if ($this->input->post('current_stat')!==$this->input->post('is_clossed')) {
			if ($this->input->post('is_clossed') == '1') {
				$upd_auction = array(
					'id_auctioneer' => $this->input->post('id_auctioneer'),
					'id_product' => $this->input->post('id_product'), 
					'start_price' => $this->input->post('start_price'),
					'lower_limit' => $this->input->post('lower_limit'),
					'bid_interval' => $this->input->post('bid_interval'),
					'is_clossed' => true,
					'closed_timestamp' => $now,
					'last_updated' => $now
				); 	
			} else {
				$upd_auction = array(
					'id_auctioneer' => $this->input->post('id_auctioneer'),
					'id_product' => $this->input->post('id_product'), 
					'start_price' => $this->input->post('start_price'),
					'lower_limit' => $this->input->post('lower_limit'),
					'bid_interval' => $this->input->post('bid_interval'),
					'is_clossed' => false,
					'closed_timestamp' => '0000-00-00 00:00:00',
					'last_updated' => $now
				); 
			}
		} else {
			$upd_auction = array(
				'id_auctioneer' => $this->input->post('id_auctioneer'),
				'id_product' => $this->input->post('id_product'), 
				'start_price' => $this->input->post('start_price'),
				'lower_limit' => $this->input->post('lower_limit'),
				'bid_interval' => $this->input->post('bid_interval'),
				'last_updated' => $now
			); 
		}
		$this->products_model->update($upd_product,$this->input->post('id_product'));
		$this->auctions_model->update($upd_auction,$this->input->post('id_auction'));
		$this->session->set_flashdata('msg', 'Auction\'s data has been updated.');
		redirect('admin/auctions/detail/'.$this->input->post('id_auction'),'refresh');
	}

	public function add_picts()
	{
		$this->upload_picts_process($this->input->post('id_product'));
		$this->session->set_flashdata('msg', 'Photos has been added.');
		redirect('admin/auctions/detail/'.$this->input->post('id_auction'),'refresh');
	}

	public function upload_picts_process($id_product)
	{
		if ($_FILES['images']['size'] !== 0) {
			$config['upload_path'] = './assets/img/posts/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			$config['overwrite'] = FALSE;

			$attachName = 'images';
			$files = $_FILES;
            $count = count($_FILES[$attachName]['name']);

            for ($i = 0; $i < $count; $i++) {

                $_FILES[$attachName]['name'] = $files[$attachName]['name'][$i];
                $_FILES[$attachName]['type'] = $files[$attachName]['type'][$i];
                $_FILES[$attachName]['tmp_name'] = $files[$attachName]['tmp_name'][$i];
                $_FILES[$attachName]['error'] = $files[$attachName]['error'][$i];
                $_FILES[$attachName]['size'] = $files[$attachName]['size'][$i];

                $this->upload->initialize($config);
                $upload = $this->upload->do_upload($attachName);
                $upload_data = $this->upload->data();
                if ($upload) {
                	$file_name = $upload_data['file_name']; //RETRIEVING FILE NAME
					$img = array('id_product' => $id_product, 'img_file' => $file_name);
					$this->products_picts_model->insert($img);			
                } 
        	}
        }
    }

    public function delete($id_auction,$id_product)
    {
    	$this->auctions_model->delete($id_auction);
    	$this->products_model->delete($id_product);
    	$this->session->set_flashdata('msg', 'One auction has been deleted.');
    	redirect('admin/auctions','refresh');
    }

    public function delete_all_picts($id_product,$id_auction)
    {
    	$img = $this->products_picts_model->get_per_product($id_product);
    	$this->products_picts_model->delete_per_product($id_product);
    	
    	if ($img) {
    		foreach ($img as $key) { //remove from directory
	    		unlink("./assets/img/posts/".$key->img_file);
	    	}		
    	}
    
    	$this->session->set_flashdata('msg', 'All photo has been deleted.');
		redirect('admin/auctions/detail/'.$id_auction,'refresh');
    }

    public function delete_pict($id_auction,$filename,$id)
    {
    	$this->products_picts_model->delete($id);
		unlink("./assets/img/posts/".$filename); //remove from directory
		$this->session->set_flashdata('msg', 'Photo has been deleted.');
		redirect('admin/auctions/detail/'.$id_auction,'refresh');
    }

    public function delete_bid($id_auction,$id_bid)
    {
    	$this->bids_model->delete($id_bid);
    	$this->session->set_flashdata('msg','Bid has been deleted.');
    	redirect('admin/auctions/detail/'.$id_auction,'refresh');
    }

    public function delete_review($id_rev,$id_auction)
    {
    	$this->reviews_model->delete($id_rev);
    	$this->session->set_flashdata('msg', 'Review has been deleted.');
    	redirect('admin/auctions/detail/'.$id_auction,'refresh');
    }

}

/* End of file auctions.php */
/* Location: ./application/controllers/admin/auctions.php */