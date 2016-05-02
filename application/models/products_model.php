<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

	public function insert($data)
	{
		$this->db->insert('products', $data);
		return $this->db->insert_id();
	}

	public function update($data,$where)
	{
		$this->db->where('id_product', $where);
		$this->db->update('products', $data);
	}

	public function get_name($where)
	{
		$this->db->select('name');
		$this->db->from('products');
		$this->db->where('id_product', $where);

		$query = $this->db->get();
		$query = $query->row();
		return $query->name;
	}

}

/* End of file products_model.php */
/* Location: ./application/models/products_model.php */