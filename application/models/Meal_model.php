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

	public function get($limit = 20, $offset = 0)
	{
		$this->db->select('meals.*,mc.name cat_name');
		$this->db->from($this->table);
		$this->db->join('meal_categories mc', 'mc.id = meals.category_id', 'left');
		$this->db->limit($limit, $offset);

		return $this->db->get()->result();
	}

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		return $this->db->count_all_results($this->table);
	}
	

}

/* End of file Meal_model.php */
/* Location: ./application/models/Meal_model.php */