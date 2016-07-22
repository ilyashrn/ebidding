<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends CI_Model {

	public function get_per_member($id_member)
	{
		$this->db->select('*');
		$this->db->from('members_notifications as n');
		$this->db->join('members as mg', 'n.id_giver = mg.id_member', 'left');
		$this->db->join('auctions as a', 'n.id_auction = a.id_auction', 'left');
		$this->db->join('products as p', 'a.id_product = p.id_product', 'left');
		$this->db->where('id_receiver', $id_member);
		$this->db->order_by('notification_timestamp', 'desc');

		$this->db->limit(25);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_per_member_rows($id_member)
	{
		$this->db->select('*');
		$this->db->from('members_notifications');
		$this->db->where('id_receiver', $id_member);
		$this->db->where('is_read', false);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function insert($data)
	{
		$this->db->insert('members_notifications', $data);
	}

	public function update($data,$where)
	{
		$this->db->where('id_receiver', $where);
		$this->db->update('members_notifications', $data);
	}

	public function delete($where)
	{
		$this->db->where('id_receiver', $where);
		$this->db->delete('members_notifications');
	}

	public function delete_per_member($where)
	{
		$this->db->where('id_receiver', $where);
		$this->db->or_where('id_giver', $where);
		$this->db->delete('members_notifications');
	}

}

/* End of file notifications_model.php */
/* Location: ./application/models/notifications_model.php */