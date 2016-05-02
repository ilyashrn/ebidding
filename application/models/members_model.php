<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_model extends CI_Model {

	public function insert($data)
	{
		$this->db->insert('members', $data);
	}

	public function delete($where)
	{
		$this->db->where('id_member', $where);
		$this->db->delete('members');
	}

	public function update($data, $where)
	{
		$this->db->where('id_member', $where);
		$this->db->update('members', $data);
	}

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from('members');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get($where_what,$where)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where($where_what, $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function get_id($username)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('username', $username);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->id_member;
		} else {
			return false;
		}
	}
	
	public function check_entry($where_what,$where)
	{
		$this->db->select('*');
		$this->db->from('members');
		$this->db->where($where_what, $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function login($user_id,$password)
	{
		$datestring = '%Y-%m-%d %h:%i:%s';

		$this->db->select('*');
		$this->db->from('members');
		$this->db->where('username', $user_id);
		$this->db->or_where('email', $user_id);
		$this->db->having('password', $password);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$update_time = array('last_login' => mdate($datestring,now()));
			
			$this->db->where('username', $user_id);
			$this->db->or_where('email', $user_id);
			$this->db->update('members',$update_time);

			return $query->row();
		} else {
			return false;
		}
	}

}

/* End of file members_model.php */
/* Location: ./application/models/members_model.php */