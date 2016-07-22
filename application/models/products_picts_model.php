<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_picts_model extends CI_Model {

	public function insert($data)
	{
		$this->db->insert('products_picts', $data);
	}	

	public function get_per_product($id)
	{
		$this->db->select('*');
		$this->db->from('products_picts');
		$this->db->where('id_product', $id);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_per_product_rows($id)
	{
		$this->db->select('*');
		$this->db->from('products_picts');
		$this->db->where('id_product', $id);

		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_product_thumbnail($id)
	{
		$this->db->select('*');
		$this->db->from('products_picts');
		$this->db->where('id_product', $id);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	public function delete($id)
	{
		$this->db->where('id_pict', $id);
		$this->db->delete('products_picts');
	}

	public function delete_per_product($id)
	{
		$this->db->where('id_product', $id);
		$this->db->delete('products_picts');
	}

}

/* End of file products_picts.php */
/* Location: ./application/models/products_picts.php */