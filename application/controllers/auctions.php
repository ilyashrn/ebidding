<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auctions extends CI_Controller {

	public $header_categories;

	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->header_categories = $this->categories_model->get_all_categories();
	}

	public function index()
	{
		$this->pagination_setup(
			base_url().'auctions/',
			$this->auctions_model->get_all_rows()
			);
		$pagination_link = $this->pagination->create_links();
		$current_page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		$data = array(
			'title' => 'All Categories | ',
			'subtitle' => 'All Categories',
			'product_categories' => $this->categories_model->get_all_categories(),
			'header_categories' => $this->header_categories,
			'products' => $this->auctions_model->get_all(15,$current_page),
			'pagination_link' => $pagination_link
		);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/auctions-grid', $data);
		$this->load->view('content/auctions-aside-categories', $data);
		$this->load->view('footer', $data);		
	}

	public function category($name,$sub)
	{
		$this->pagination_setup(
			base_url().'auctions/category/'.$name.'/'.$sub,
			$this->auctions_model->get_per_category_rows(
				urldecode($name),
				urldecode($sub))
			);
		$pagination_link = $this->pagination->create_links();
		$current_page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data = array(
			'title' => urldecode($name).' | ',
			'subtitle' => urldecode($name).' // '.urldecode($sub),
			'product_categories' => $this->categories_model->get_all_categories(),
			'header_categories' => $this->header_categories,
			'products' => $this->auctions_model->get_per_category(
				urldecode($name),
				urldecode($sub),
				15,
				$current_page),
			'pagination_link' => $pagination_link);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/auctions-grid', $data);
		$this->load->view('content/auctions-aside-categories', $data);
		$this->load->view('footer', $data);				
	}

	public function search()
	{
		$this->pagination_setup(
			base_url().'auctions/search',
			$this->auctions_model->search_result_rows($this->input->post('search'))
			);
		$pagination_link = $this->pagination->create_links();
		$current_page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$keyword = ($this->input->post('search')) ? $this->input->post('search') : "NIL";
		$data = array(
			'title' => 'Hasil Pencarian | ',
			'subtitle' => 'Hasil pencarian kata kunci "'.$this->input->post('search').'"',
			'product_categories' => $this->categories_model->get_all_categories(),
			'header_categories' => $this->header_categories,
			'products' => $this->auctions_model->search($keyword,15,$current_page),
			'pagination_link' => $pagination_link
		);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/auctions-grid', $data);
		$this->load->view('content/auctions-aside-categories', $data);
		$this->load->view('footer', $data);		
	}

	public function start_new()
	{
		if ($this->session->userdata('username') == false) {
			redirect('main','refresh');
		}

		$data = array(
			'title' => 'Jual barang | ',
			'product_categories' => $this->categories_model->get_all_categories(),
			'header_categories' => $this->header_categories
		);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/auction-new', $data);
		$this->load->view('footer', $data);
	}

	public function start_new_process()
	{
		$datestring = '%Y-%m-%d %h:%i:%s';
  		$now = mdate($datestring,now('Asia/Jakarta'));
		$input_product = array(
			'name' => $this->input->post('name'),
			'condition' => $this->input->post('condition'), 
			'description' => nl2br($this->input->post('description')),
			'id_category' => $this->input->post('sub_category')
		);
		$ins_product = $this->products_model->insert($input_product);

		$input_auction = array(
			'id_auctioneer' => $this->session->userdata('id'),
			'id_product' => $ins_product, 
			'start_price' => $this->input->post('start_price'),
			'lower_limit' => $this->input->post('lower_limit'),
			'bid_interval' => $this->input->post('bid_interval'),
			'start_timestamp' => $now
		); 
		$ins_auction = $this->auctions_model->insert($input_auction);
		$upl_picts = $this->upload_picts_process($ins_product);

        $this->session->set_flashdata('success', $ins_auction);
    	redirect('auctions/start_successfull','refresh');
	}

	public function pagination_setup($base_url,$total_rows)
	{
		$config = array();
		$config["base_url"] = $base_url;
		$config["total_rows"] = $total_rows;
		$config["per_page"] = 15;
		$config['num_links'] = $config["total_rows"];
		$config["uri_segment"] = 5;

        //PAGINATION VIEW
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = false;
        $config['prev_link'] = false;
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
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

	public function start_successfull()
	{
		if ($this->session->flashdata('success')) {
			$data = array('title' => 'Create auction successfull | ', 'header_categories' => $this->header_categories);
			
			$this->load->view('html_head', $data);
			$this->load->view('header', $data);
			$this->load->view('content/auction-success', $data);
			$this->load->view('footer', $data);	
		} else {
			redirect('main','refresh');
		}
	}

	public function edit($id_auction,$id_product,$id_auctioneer)
	{
		if ($this->session->userdata('id') !== $id_auctioneer) {
			redirect('main','refresh');
		}

		$data = array(
			'title' => 'Edit iklan | ',
			'product_categories' => $this->categories_model->get_all_categories(),
			'auction_detail' => $this->auctions_model->get($id_auction),
			'product_picts' => $this->products_picts_model->get_per_product($id_product),
			'header_categories' => $this->header_categories
		);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/auction-edit', $data);
		$this->load->view('footer', $data);
	}

	public function edit_process()
	{
		$datestring = '%Y-%m-%d %h:%i:%s';
  		$now = mdate($datestring,now('Asia/Jakarta'));
		$upd_product = array(
			'name' => $this->input->post('name'),
			'condition' => $this->input->post('condition'), 
			'description' => nl2br($this->input->post('description')),
			'id_category' => $this->input->post('sub_category')
		);	

		$upd_auction = array(
			'id_auctioneer' => $this->session->userdata('id'),
			'id_product' => $this->input->post('id_product'), 
			'start_price' => $this->input->post('start_price'),
			'lower_limit' => $this->input->post('lower_limit'),
			'bid_interval' => $this->input->post('bid_interval'),
			'start_timestamp' => $now
		); 
		$this->products_model->update($upd_product,$this->input->post('id_product'));
		$this->auctions_model->update($upd_auction,$this->input->post('id_auction'));
		$this->upload_picts_process($this->input->post('id_product'));
		redirect('auctions/active/'.$this->session->userdata('id').'/'.$this->session->userdata('username'),'refresh');
	}

	public function view_count_increment($id_auction)
	{
		$auc_detail = $this->auctions_model->get($id_auction);

		if ($this->session->userdata('id') !== $auc_detail->id_auctioneer) {
			$view_count = $auc_detail->views_count;
			$view_count++;
			$upd = array('views_count' => $view_count);
			$this->auctions_model->update($upd,$id_auction);	
		}
	}

	public function detail($id_auction,$id_product)
	{
		$this->view_count_increment($id_auction);
		$auction_detail = $this->auctions_model->get($id_auction);
		$data = array(
			'title' => $this->products_model->get_name($id_product).' | ',
			'auction_detail' => $auction_detail,
			'product_picts' => $this->products_picts_model->get_per_product($id_product),
			'bid_list' => $this->bids_model->get_per_auction($id_auction),
			'auction_winner' => $this->auctions_model->get_winner($id_auction),
			'bids_count' => $this->bids_model->get_per_auction_rows($id_auction),
			'reviews' => $this->reviews_model->get_per_member($auction_detail->id_auctioneer),
			'header_categories' => $this->header_categories
		);

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/auction-detail-modal', $data);
		$this->load->view('content/auction-detail', $data);
		$this->load->view('footer', $data);
		// $this->load->view('slider-script');
	}

	public function sold($id,$username)
	{
		$data = array(
			'title' => 'Barang Terjual '.$username.' | ',
			'header_categories' => $this->header_categories,
			'subtitle' => 'Barang Terjual',
			'mem_detail' => $this->members_model->get('id_member',$id),
			'auctions' => $this->auctions_model->get_sold($id),
			'sold_rec' => $this->auctions_model->get_sold_rows($id),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($id),
			'bids_out' => $this->bids_model->get_per_bidder_rows($id),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($id)
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-for-sale', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);	
	}

	public function active($id,$username)
	{
		$data = array(
			'title' => 'Barang Dijual '.$username.' | ',
			'header_categories' => $this->header_categories,
			'subtitle' => 'Barang Dijual',
			'mem_detail' => $this->members_model->get('id_member',$id),
			'auctions' => $this->auctions_model->get_forsale($id),
			'sold_rec' => $this->auctions_model->get_sold_rows($id),
			'forsale_rec' => $this->auctions_model->get_forsale_rows($id),
			'bids_out' => $this->bids_model->get_per_bidder_rows($id),
			'bids_in' => $this->bids_model->get_per_auctioneer_rows($id)
		);	

		$this->load->view('html_head', $data);
		$this->load->view('header', $data);
		$this->load->view('content/mem-for-sale', $data);
		$this->load->view('content/mem-aside-summary', $data);
		$this->load->view('footer', $data);	
	}

	public function is_bid_valid($bid)
	{
		$interval = $this->input->post('bid_interval');
		$start_price = $this->input->post('start_price');
		$lower_limit = $this->input->post('lower_limit');

		if (($bid%$interval) == 0 && $bid<=$start_price && $bid>$lower_limit) {
			return true;
		} elseif ($bid<$lower_limit) {
			$this->form_validation->set_message('is_bid_valid','<b>Bid yang kamu masukkan</b> terlalu rendah.');
			return false;
		}
		else {
			$this->form_validation->set_message('is_bid_valid','<b>Bid yang kamu masukkan</b> harus di bawah harga awal dan sesuai kelipatan yang ditentukan penjual.');
			return false;
		}
	}

	public function set_bid()
	{
		$this->form_validation->set_rules('bid', 'Bid', 'required|callback_is_bid_valid');
		if ($this->form_validation->run()) {
			$input = array(
				'id_bidder' => $this->input->post('id_bid'), 
				'id_auction' => $this->input->post('id_auction'),
				'bid_value' => $this->input->post('bid')
			);
			$this->bids_model->insert($input);
			$this->set_notification(
				$this->input->post('id_auction'),
				$this->input->post('id_bid'),
				$this->auctions_model->get_id_auctioneer($this->input->post('id_auction')),
				'another bid',
				'bid in');
			$this->session->set_flashdata('msg', 'Bid berhasil! Pantau terus lapak ini atau silahkan tunggu konfirmasi dari penjual.');
		} else {
			$this->session->set_flashdata('warn', validation_errors());
		}

		redirect($this->input->post('current_uri'),'refresh');
	}

	public function unset_bid()
	{
		if ($this->input->post('id_winner') == $this->input->post('id_bid')) {
			$upd = array('id_winner' => null);
			$this->auctions_model->update($upd,$this->input->post('id_auction'));
		}

		$this->bids_model->delete($this->input->post('id_bid'));
		$this->session->set_flashdata('msg', '<b>Bid</b> berhasil dibatalkan.');
		redirect($this->input->post('current_uri'),'refresh');
	}

	public function set_winner()
	{
		$upd_winner = array('id_winner' => $this->input->post('winner'));
		$this->auctions_model->update($upd_winner,$this->input->post('id_auction'));

		$winner = $this->auctions_model->get_winner($this->input->post('id_auction'));
		$this->set_notification(
			$this->input->post('id_auction'),
			$this->input->post('id_auctioneer'),
			$winner->id_bidder,
			'winner is set',
			'you win');
		$this->session->set_flashdata('msg', 'Pemenang berhasil ditentukan. Silahkan tunggu pesan dari bidder.');
		redirect($this->input->post('current_uri'),'refresh');
	}

	public function reset_winner($id_auction,$id_product,$id_auctioneer)
	{
		$cur_winner = $this->auctions_model->get_winner($id_auction);

		$reset = array('id_winner' => null);
		$this->auctions_model->update($reset,$id_auction);
		$this->set_notification(
			$id_auction,
			$id_auctioneer,
			$cur_winner->id_bidder,
			'winner is reset',
			'you are canceled');
		$this->session->set_flashdata('msg', 'Pemenang berhasil digagalkan.');
		redirect('auctions/detail/'.$id_auction.'/'.$id_product,'refresh');
	}

	public function set_notification($id_auction,$id_giver,$id_receiver,$type,$type2)
	{
		$bidders = $this->bids_model->get_bidders_per_auction($id_auction);
		if ($bidders) {
			foreach ($bidders as $bid) {
				if ($bid->id_bidder !== $id_giver && $bid->id_bidder !== $id_receiver) {
					$input = array(
						'id_auction' => $id_auction,
						'notification_type' => $type,
						'id_giver' => $id_giver,
						'id_receiver' => $bid->id_bidder,
						'is_read' => false);		
					$this->notifications_model->insert($input); 
				}
			}
		}

		$input = array(
			'id_auction' => $id_auction,
			'notification_type' => $type2,
			'id_giver' => $id_giver,
			'id_receiver' => $id_receiver,
			'is_read' => false);
		$this->notifications_model->insert($input);		
	}

	public function remove_with_product_process($id_auction,$id_product)
	{
		$this->auctions_model->delete($id_auction);
		$this->products_model->delete($id_product);
		$this->products_picts_model->delete_per_product($id_product);
		redirect('auctions/active/'.$this->session->userdata('id').'/'.$this->session->userdata('username'),'refresh');
	}

	public function remove_img($img_file,$id_pict)
	{
		$this->products_picts_model->delete($id_pict);
		unlink("./assets/img/posts/".$img_file);
		redirect($this->session->flashdata('url'),'refresh');
	}

	public function close()
	{
		$close_upd = array('is_clossed' => true);
		$this->auctions_model->update($close_upd,$this->input->post('id_auction'));
		$this->session->set_flashdata('msg', 'Lapak berhasil ditutup.');
		redirect($this->input->post('current_uri'),'refresh');
	}
}

/* End of file products.php */
/* Location: ./application/controllers/products.php */