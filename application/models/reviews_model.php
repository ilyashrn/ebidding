<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews_model extends CI_Model {

	public function insert($data)
	{
		$this->db->insert('members_reviews', $data);
	}

	public function get_per_member($where)
	{
		$this->db->select('*');
		$this->db->from('members_reviews');
		$this->db->join('members', 'members_reviews.id_giver = members.id_member', 'left');
		$this->db->join('auctions', 'members_reviews.id_auction = auctions.id_auction', 'left');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->where('id_receiver', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_per_auction($where)
	{
		$this->db->select('*,
			g.username as giver_username,
			r.username as receiver_username,
			g.fullname as giver_fullname,
			r.fullname as receiver_fullname,
			g.id_member as giver_id,
			r.id_member as receiver_id');
		$this->db->from('members_reviews');
		$this->db->join('members as g', 'members_reviews.id_giver = g.id_member', 'left');
		$this->db->join('members as r', 'members_reviews.id_receiver = r.id_member', 'left');
		$this->db->join('auctions', 'members_reviews.id_auction = auctions.id_auction', 'left');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->where('members_reviews.id_auction', $where);

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
		$this->db->from('members_reviews');
		$this->db->join('members', 'members_reviews.id_giver = members.id_member', 'left');
		$this->db->join('auctions', 'members_reviews.id_auction = auctions.id_auction', 'left');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->where('members_reviews.id_auction', $where);

		$query = $this->db->get();
		return $query->num_rows();
	}	

	public function get_per_type_per_member($where,$type)
	{
		$this->db->select('*');
		$this->db->from('members_reviews');
		$this->db->join('members', 'members_reviews.id_giver = members.id_member', 'left');
		$this->db->join('auctions', 'members_reviews.id_auction = auctions.id_auction', 'left');
		$this->db->join('products', 'auctions.id_product = products.id_product', 'left');
		$this->db->where('id_receiver', $where);
		$this->db->where('review_type', $type);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}		
	}

	public function delete($where_what,$where)
	{
		$this->db->where($where_what, $where);
		$this->db->delete('members_reviews');
	}

	public function check_entry($id_auction,$id_giver,$id_receiver)
	{
		$this->db->select('*');
		$this->db->from('members_reviews');
		$this->db->where('id_auction', $id_auction);
		$this->db->where('id_giver', $id_giver);
		$this->db->where('id_receiver', $id_receiver);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

}

/* End of file reviews_model.php */
/* Location: ./application/models/reviews_model.php */