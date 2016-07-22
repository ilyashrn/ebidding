<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');	
		if ($this->session->userdata('a_id') == '') {
			redirect('admin/login','refresh');
		}
	}

	public function index()
	{
		$parent_list = $this->categories_model->get_all_categories();
		$child_list = $this->categories_model->get_all_sub();

		$data = array(
			'title' => 'Categories list | ',
			'parent_list' => $parent_list,
			'child_list' => $child_list,
		);
		
		$this->load->view('admin/plugins/css/datatable2');
		$this->load->view('admin/html_header', $data);
		$this->load->view('admin/navbar', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('admin/content/cat-table', $data);
		$this->load->view('admin/footer', $data);		
		$this->load->view('admin/plugins/datatable2');
	}

	public function edit_parent()
	{
		$upd = array('category_name' => $this->input->post('category_name'));
		$this->categories_model->update_category($this->input->post('id_category'),$upd);
		$this->session->set_flashdata('msg', 'Category name has been changed.');
		redirect('admin/categories/','refresh');
	}

	public function edit_child()
	{
		$upd = array('sub_name' => $this->input->post('sub_name'));
		$this->categories_model->update_sub(
			$this->input->post('current_category'),
			$this->input->post('id_category'),
			$this->input->post('id_subcategory'),
			$upd);
		$this->session->set_flashdata('msg', 'Sub category data has been changed.');
		redirect('admin/categories/','refresh');
	}

	public function delete_parent($id_category)
	{
		$this->categories_model->delete_category($id_category);
		$this->session->set_flashdata('msg', 'One parent category has been deleted with the subs and auctions witihin.');
		redirect('admin/categories/','refresh');
	}

	public function delete_child($id_sub)
	{
		$this->categories_model->delete_sub($id_sub);
		$this->session->set_flashdata('msg', 'One child category has been deleted with the auctions witihin.');
		redirect('admin/categories/','refresh');
	}	

	public function add_parent()
	{
		$input = array('category_name' => $this->input->post('category_name'));
		$this->categories_model->insert_category($input);
		$this->session->set_flashdata('msg', 'One new category has been added.');
		redirect('admin/categories/','refresh');
	}

	public function add_child()
	{
		if ($this->input->post('id_category') == '0') {
			$this->session->set_flashdata('warn', 'Please select the parent category first.');
			redirect('admin/categories','refresh');
		}
		$input = array(
			'sub_name' => $this->input->post('sub_name')
		);
		$this->categories_model->insert_sub($input,$this->input->post('id_category'));
		$this->session->set_flashdata('msg', 'One new child category has been added.');
		redirect('admin/categories/','refresh');

	}

}

/* End of file categories.php */
/* Location: ./application/controllers/admin/categories.php */