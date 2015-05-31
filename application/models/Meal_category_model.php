<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Model for Meal Category functionalities.
*/
class Meal_category_model extends CI_Model {

	private $table = 'meal_categories';
	
	public function create($data=array())
	{
		if($this->db->insert($this->table, $data))
		{
			return TRUE;
		}else {
			return FALSE;
		}
	}

	public function get()
	{
		return $this->db->get($this->table)->result();
	}

	public function find($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table,1)->result();
	}

	public function update($data=array(), $id)
	{
		try {
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return TRUE;
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function delete($id)
	{
		try {
			$this->db->where('id',$id);
			$this->db->delete($this->table);
			return TRUE;
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

}

/* End of file Meal_category_model.php */
/* Location: ./application/models/Meal_category_model.php */ ?>