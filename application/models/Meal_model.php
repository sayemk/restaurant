<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meal_model extends CI_Model {
	private $table = 'meals';
	
	public function create($data=array())
	{
		$this->db->insert($this->table, $data);
		$insert_id=$this->db->insert_id();
		if ($insert_id) {
			return $insert_id;
		} else {
			return FALSE;
		}
	}

	public function get($limit = 20, $offset = 0, $conditions = array())
	{
		$this->db->select('meals.*,mc.name cat_name');
		$this->db->from($this->table);
		$this->db->join('meal_categories mc', 'mc.id = meals.category_id', 'left');
		$this->db->limit($limit, $offset);
		$this->db->where($conditions);

		return $this->db->get()->result();
	}

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		return $this->db->count_all_results($this->table);
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

/* End of file Meal_model.php */
/* Location: ./application/models/Meal_model.php */