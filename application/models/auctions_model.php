<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auctions_model extends CI_Model {

	public function insert($data)
	{
		$this->db->insert('auctions', $data);
		return $this->db->insert_id();
	}	

	public function update($data,$where)
	{
		$this->db->where('id_auction', $where);
		$this->db->update('auctions', $data);
	}

	public function search($keyword,$limit,$start_from,$price_from,$price_to,$baru,$bekas,$is_clossed,$on_going)
	{
		if ($keyword == "NIL") {
			$keyword = '';
		}
		$this->db->select('*, products.id_category as id_cat, auctions.last_updated as auct_last_updated');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		
		$this->db->like('name',$keyword);
		$this->db->or_like('city',$keyword);
		$this->db->or_like('province',$keyword);
		$this->db->or_like('category_name',$keyword);
		$this->db->or_like('sub_name',$keyword);
		$this->db->or_like('username',$keyword);

		if ($price_from) {
			$this->db->where('start_price >=', $price_from);	
		}
		if ($price_to) {
			$this->db->where('start_price <=', $price_to);
		}
		if ($baru=='1') {
			$this->db->where('condition', 'Baru');
		}
		if ($bekas=='1') {
			$this->db->where('condition', 'Bekas');
		}
		if ($is_clossed=='1') {
			$this->db->where('is_clossed', true);
		}
		if ($on_going=='1') {
			$this->db->where('is_clossed', false);
		}

		$this->db->order_by('id_auction', 'desc');

		$this->db->limit($limit,$start_from);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function refine_search($keyword,$limit,$start_from,$price_from,$price_to,$baru,$bekas,$is_clossed,$on_going)
	{
		if ($keyword == "NIL") {
			$keyword = '';
		}

		$this->db->select('*, products.id_category as id_cat, auctions.last_updated as auct_last_updated');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');

		if ($price_from) {
			$this->db->where('start_price >=', $price_from);	
		}
		if ($price_to) {
			$this->db->where('start_price <=', $price_to);
		}
		if ($baru=='1') {
			$this->db->where('condition', 'Baru');
		}
		if ($bekas=='1') {
			$this->db->where('condition', 'Bekas');
		}
		if ($is_clossed=='1') {
			$this->db->where('is_clossed', 1);
		}
		if ($on_going=='1') {
			$this->db->where('is_clossed', 0);
		}

		if ($keyword) {
			$this->db->like('name',$keyword);
			$this->db->or_like('city',$keyword);
			$this->db->or_like('province',$keyword);
			$this->db->or_like('category_name',$keyword);
			$this->db->or_like('sub_name',$keyword);
			$this->db->or_like('username',$keyword);	
		}

		$this->db->order_by('id_auction', 'desc');

		$this->db->limit($limit,$start_from);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function admin_refine_search($name,$category,$price_from,$price_to,$status,$bids,$views)
	{
		if ($name == "NIL") {
			$name = '';
		}
		
		$this->db->select('*,
			products.id_category as id_cat,
			auctions.last_updated as auct_last_updated
		');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		
		if ($name) {
			$this->db->like('name',$name);	
		}
		if ($category) {
			$this->db->where('products.id_category',$category);
		}
		if ($price_from) {
			$this->db->where('start_price >= ', $price_from);
		}
		if ($price_to) {
			$this->db->where('start_price <=', $price_to);
		}
		if ($status!=='-99') {
			$this->db->where('is_clossed', $status);
		}
		if ($bids!=='0') {
			$this->db->where('(select count(id_bid) 
				from bids 
				where auctions.id_auction = bids.id_auction)  <=', $bids);
		}
		if ($views!=='0') {
			$this->db->where('views_count <=', $views);
		}
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function search_result_rows($keyword,$price_from,$price_to,$baru,$bekas,$is_clossed,$on_going)
	{
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		
		$this->db->like('name',$keyword);
		$this->db->or_like('city',$keyword);
		$this->db->or_like('province',$keyword);
		$this->db->or_like('category_name',$keyword);
		$this->db->or_like('sub_name',$keyword);
		$this->db->or_like('username',$keyword);

		if ($price_from!=='') {
			$this->db->where('start_price >=', $price_from);	
		}
		if ($price_to!=='') {
			$this->db->where('start_price <=', $price_to);
		}
		if ($baru!=='') {
			$this->db->where('condition', 'Baru');
		}
		if ($bekas!=='') {
			$this->db->where('condition', 'Bekas');
		}
		if ($is_clossed!=='') {
			$this->db->where('is_clossed', true);
		}
		if ($on_going) {
			$this->db->where('is_clossed', false);
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_per_category($category_name,$sub_name,$limit,$start_from)
	{
		$this->db->select('*, products.id_category as id_cat, auctions.last_updated as auct_last_updated');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('category_name', $category_name);
		$this->db->order_by('id_auction', 'desc');
		
		if ($sub_name !== 'all') {
			$this->db->where('sub_name', $sub_name);	
		}

		$this->db->limit($limit,$start_from);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function get_per_category_rows($category_name,$sub_name)
	{
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('category_name', $category_name);
		
		if ($sub_name !== 'all') {
			$this->db->where('sub_name', $sub_name);	
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get__all()
	{
		$this->db->select('*, products.id_category as id_cat, auctions.last_updated as auct_last_updated');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->order_by('id_auction', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function get_all($limit,$start_from)
	{
		$this->db->select('*, products.id_category as id_cat, auctions.last_updated as auct_last_updated');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->order_by('id_auction', 'desc');

		$this->db->limit($limit,$start_from);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function get_all_rows()
	{
		$this->db->select('*, products.id_category as id_cat, auctions.last_updated as auct_last_updated');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get($where)
	{
		$this->db->select('*, 
			products.id_category as id_cat, 
			auctions.last_updated as auct_last_updated,
			(SELECT COUNT(*) 
				FROM BIDS
					WHERE AUCTIONS.ID_AUCTION = BIDS.ID_AUCTION) as bids_count');
		$this->db->from('auctions');
		$this->db->where('id_auction', $where);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}	
	}

	public function get_id_auctioneer($id_auction)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->where('id_auction', $id_auction);

		$query = $this->db->get();
		return $query->row()->id_auctioneer;
	}

	public function get_forsale($where)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->where('id_auctioneer', $where);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 0);
		$this->db->order_by('id_auction', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_forsale_rows($where)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->where('id_auctioneer', $where);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 0);

		$query = $this->db->get();	
		return $query->num_rows();
	}

	public function get_sold($where)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->where('id_auctioneer', $where);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 1);
		$this->db->order_by('id_auction', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function get_winner($id_auction)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->join('bids', 'auctions.id_winner = bids.id_bid', 'left');
		$this->db->join('members', 'bids.id_bidder = members.id_member', 'left');
		$this->db->where('auctions.id_auction', $id_auction);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_sold_rows($where)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->where('id_auctioneer', $where);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 1);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_per_auctioneer($id_auctioneer)
	{
		$this->db->select('*');
		$this->db->from('auctions');
		$this->db->where('id_auctioneer', $id_auctioneer);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('categories_subcategories', 'products_subcategories.id_subcategory = categories_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function delete($id_auction)
	{
		$this->db->where('id_auction', $id_auction);
		$this->db->delete('auctions');
	}

}

/* End of file auctions_model.php */
/* Location: ./application/models/auctions_model.php */