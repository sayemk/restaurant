<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_meal_model extends CI_Model {

	private $table = 'restaurant_meals';

	public function save($data=array())
	{
		$this->db->insert($this->table, $data);
		$insert_id=$this->db->insert_id();
		if ($insert_id) {
			return $insert_id;
		} else {
			return FALSE;
		}
	}

	public function get($limit = 20, $offset = 0, $conditions = array() )
	{
		$this->db->select('rm.*, m.name AS meal_name,img.name AS image_name,res.name AS res_name');
		$this->db->from($this->table.' rm');
		$this->db->join('meals m', 'm.id = rm.meal_id', 'left');
		$this->db->join('images img', 'img.id = rm.image_id', 'left');
		$this->db->join('restaurants res', 'res.id = rm.restaurant_id', 'left');
		$this->db->limit($limit, $offset);
		
		return $this->db->get()->result();
		
	}

}

/* End of file Restaurant_meal_model.php */
/* Location: ./application/models/Restaurant_meal_model.php */ 