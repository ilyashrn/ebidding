<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrators_model extends CI_Model {

	public function login($user_id,$password)
	{
		$datestring = '%Y-%m-%d %h:%i:%s';

		$this->db->select('*');
		$this->db->from('administrators');
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

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from('administrators');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get($where)
	{
		$this->db->select('*');
		$this->db->from('administrators');
		$this->db->where('id_administrator', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function delete($where)
	{
		$this->db->where('id_administrator', $where);
		$this->db->delete('administrators');
	}

	public function update($where,$data)
	{
		$this->db->where('id_administrator', $where);
		$this->db->update('administrators', $data);
	}

}

/* End of file administrators_model.php */
/* Location: ./application/models/administrators_model.php */