<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

	public function get_all_categories()
	{
		$this->db->select('*');
		$this->db->from('products_categories');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_all_subcategories()
	{
		$this->db->select('*');
		$this->db->from('products_subcategories');	

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_sub_per_category($where)
	{
		$this->db->select('*');
		$this->db->from('products_subcategories');
		$this->db->join('products_categories', 'products_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->where('products_subcategories.id_category', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

}

/* End of file categories_model.php */
/* Location: ./application/models/categories_model.php */