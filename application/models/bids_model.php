<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bids_model extends CI_Model {

	public function insert($input)
	{
		$this->db->insert('bids', $input);
	}	

	public function get_per_auction($where)
	{
		$this->db->select('*');
		$this->db->from('bids');
		$this->db->join('members', 'bids.id_bidder = members.id_member', 'left');
		$this->db->where('id_auction', $where);
		$this->db->order_by('bid_timestamp', 'desc');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_bidders_per_auction($where)
	{
		$this->db->distinct();
		$this->db->select('id_bidder');
		$this->db->from('bids');
		$this->db->where('id_auction', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_per_auction_rows($where)
	{
		$this->db->select('*');
		$this->db->from('bids');
		$this->db->where('id_auction', $where);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function delete($where)
	{
		$this->db->where('id_bid', $where);
		$this->db->delete('bids');
	}

	public function get_per_bidder($where)
	{
		$this->db->select('*, 
			ma.username as auct_username, 
			mb.username as bidder_username,
			ma.fullname as auct_fullname,
			mb.fullname as bidder_fullname,
			ma.avatar as auct_avatar, 
			mb.avatar as bidder_avatar');
		$this->db->from('bids');
		$this->db->join('members as mb', 'bids.id_bidder = mb.id_member', 'left');
		$this->db->join('auctions', 'bids.id_auction = auctions.id_auction', 'left');
		$this->db->join('members as ma', 'auctions.id_auctioneer = ma.id_member', 'left');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->where('id_bidder', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_per_bidder_rows($where)
	{
		$this->db->select('*');
		$this->db->from('bids');
		$this->db->where('id_bidder', $where);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_per_auctioneer($where)
	{
		$this->db->select('*, 
			ma.username as auct_username, 
			mb.username as bidder_username, 
			ma.fullname as auct_fullname,
			mb.fullname as bidder_fullname,
			ma.avatar as auct_avatar, 
			mb.avatar as bidder_avatar');
		$this->db->from('bids');
		$this->db->join('members as mb', 'bids.id_bidder = mb.id_member', 'left');
		$this->db->join('auctions', 'bids.id_auction = auctions.id_auction', 'left');
		$this->db->join('members as ma', 'auctions.id_auctioneer = ma.id_member', 'left');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->join('products_subcategories', 'products.id_category = products_subcategories.id_subcategory', 'left');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->where('id_auctioneer', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}	
	}

	public function get_per_auctioneer_rows($where)
	{
		$this->db->select('*');
		$this->db->from('bids');
		$this->db->join('auctions', 'bids.id_auction = auctions.id_auction', 'left');
		$this->db->where('id_auctioneer', $where);

		$query = $this->db->get();
		return $query->num_rows();

	}
}

/* End of file bids_model.php */
/* Location: ./application/models/bids_model.php */