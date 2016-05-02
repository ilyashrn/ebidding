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

	public function search($keyword,$limit,$start_from)
	{
		if ($keyword == "NIL") {
			$keyword = '';
		}
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		
		$this->db->like('name',$keyword);
		$this->db->or_like('city',$keyword);
		$this->db->or_like('province',$keyword);
		$this->db->or_like('category_name',$keyword);
		$this->db->or_like('sub_name',$keyword);
		$this->db->or_like('username',$keyword);

		$this->db->limit($limit,$start_from);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function search_result_rows($keyword)
	{
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		
		$this->db->like('name',$keyword);
		$this->db->or_like('city',$keyword);
		$this->db->or_like('province',$keyword);
		$this->db->or_like('category_name',$keyword);
		$this->db->or_like('sub_name',$keyword);
		$this->db->or_like('username',$keyword);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_per_category($category_name,$sub_name,$limit,$start_from)
	{
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('category_name', $category_name);
		
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
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('category_name', $category_name);
		
		if ($sub_name !== 'all') {
			$this->db->where('sub_name', $sub_name);	
		}

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all($limit,$start_from)
	{
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');

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
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get($where)
	{
		$this->db->select('*, products.id_category as id_cat');
		$this->db->from('auctions');
		$this->db->where('id_auction', $where);
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
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
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 0);

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
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
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
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 1);

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
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('members', 'auctions.id_auctioneer = members.id_member', 'left');
		$this->db->where('is_clossed', 1);

		$query = $this->db->get();
		return $query->num_rows();
	}

}

/* End of file auctions_model.php */
/* Location: ./application/models/auctions_model.php */