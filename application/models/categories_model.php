<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {

	public function get_all_categories()
	{
		$this->db->select('*,
			(SELECT COUNT(*) FROM PRODUCTS AS PR
			    LEFT JOIN CATEGORIES_SUBCATEGORIES AS S ON PR.ID_CATEGORY = S.ID_SUBCATEGORY
			    LEFT JOIN PRODUCTS_CATEGORIES AS P ON S.ID_CATEGORY = P.ID_CATEGORY
			          WHERE P.ID_CATEGORY = C.ID_CATEGORY)
			as products_count,
			(SELECT COUNT(*) 
				FROM CATEGORIES_SUBCATEGORIES
					WHERE CATEGORIES_SUBCATEGORIES.ID_CATEGORY = C.ID_CATEGORY)
			as child_count');
		$this->db->from('products_categories AS C');

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function get_all_sub()
	{
		$this->db->select('*,
			(SELECT COUNT(*) 
				FROM PRODUCTS 
					WHERE PRODUCTS.ID_CATEGORY = PRODUCTS_SUBCATEGORIES.ID_SUBCATEGORY) 
			as products_count');
		$this->db->from('categories_subcategories');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('products_subcategories', 'categories_subcategories.id_subcategory = products_subcategories.id_subcategory', 'left');
		$this->db->order_by('categories_subcategories.id_subcategory', 'desc');

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
		$this->db->from('categories_subcategories');
		$this->db->join('products_categories', 'categories_subcategories.id_category = products_categories.id_category', 'left');
		$this->db->join('products_subcategories', 'categories_subcategories.id_subcategory = products_subcategories.id_subcategory', 'left');
		$this->db->where('categories_subcategories.id_category', $where);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function insert_category($input)
	{
		$this->db->insert('products_categories', $input);
	}

	public function insert_sub($sub_name,$id_category)
	{
		$this->db->insert('products_subcategories', $sub_name);		
		$input2 = array(
			'id_category' => $id_category,
			'id_subcategory' => $this->db->insert_id());
		$this->db->insert('categories_subcategories', $input2);
	}

	public function delete_sub($id_sub)
	{
		$this->db->where('id_subcategory', $id_sub);
		$this->db->delete('products_subcategories');
	}

	public function delete_category($id_cat)
	{
		$this->db->where('id_category', $id_cat);
		$this->db->delete('products_categories');
	}

	public function update_category($id_cat,$upd)
	{
		$this->db->where('id_category', $id_cat);
		$this->db->update('products_categories', $upd);
	}

	public function update_sub($current_cat,$id_cat,$id_sub,$upd)
	{
		$this->db->where('id_subcategory', $id_sub);
		$this->db->update('products_subcategories', $upd);
		if ($current_cat!==$id_cat) {
			$upd = array(
				'id_category' => $id_cat,
				'id_subcategory' => $id_sub);
			$this->db->where('id_category', $current_cat);
			$this->db->where('id_subcategory', $id_sub);
			$this->db->update('categories_subcategories', $upd);
		}
	}

}

/* End of file categories_model.php */
/* Location: ./application/models/categories_model.php */