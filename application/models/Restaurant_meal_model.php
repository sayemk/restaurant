<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_meal_model extends CI_Model {

	private $table = 'restaurant_meals';

	private $owner_ids = array();
	private $accessPerm = FALSE;

	public function __construct()
	{
		parent::__construct();
		if($this->session->type !='Admin')
		{
			$this->load->model('restaurant_model');

			$restaurant_id = $this->restaurant_model->getRestaurantByowner($this->session->uid);
			$this->owner_ids = $restaurant_id;
			$this->accessPerm = TRUE;

		}
	}


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
		$this->db->select('restaurant_meals.*, m.name AS meal_name,img.name AS image_name,img.id AS image_id,res.name AS res_name');
		$this->db->from($this->table.' restaurant_meals');
		$this->db->join('meals m', 'm.id = restaurant_meals.meal_id', 'left');
		$this->db->join('images img', 'img.id = restaurant_meals.image_id', 'left');
		$this->db->join('restaurants res', 'res.id = restaurant_meals.restaurant_id', 'left');
		$this->db->limit($limit, $offset);
		$this->db->where($conditions);

		if ($this->accessPerm) {
			$this->db->where_in('restaurant_meals.restaurant_id', $this->owner_ids);
		}

		$this->db->order_by('restaurant_meals.id', 'ASC');
		
		return $this->db->get()->result();
		
	}

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		if ($this->accessPerm) {
			$this->db->where_in('restaurant_meals.restaurant_id', $this->owner_ids);
		}
		return $this->db->count_all_results($this->table);
	}

	public function update($data=array(), $conditions=array())
	{
		try {
			$this->db->where($conditions);
			if ($this->accessPerm) {
				$this->db->where_in('restaurant_meals.restaurant_id', $this->owner_ids);
			}
			$this->db->update($this->table, $data, $conditions);
			return TRUE;
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function delete($id)
	{
		try {
			$images = $this->getImageID($id);			
			
			$this->db->trans_start();
			try {
				foreach ($images as $image) {

					$this->image_model->delete($image->image_id);
				}


			}catch (Exception $e) {
				log_message('debug', $e->getMessage());
			}

			$this->db->where('id',$id);

			if ($this->accessPerm) {
				$this->db->where_in('restaurant_meals.restaurant_id', $this->owner_ids);
			}
			$this->db->delete($this->table);

			$this->db->trans_complete();
			
			return true;

		} catch (Exception $e) {
			$this->db->trans_rollback();
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function getImageID($id)
	{
		$this->db->select('image_id');
		$query = $this->db->get_where($this->table, array('id' =>$id));

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

}

/* End of file Restaurant_meal_model.php */
/* Location: ./application/models/Restaurant_meal_model.php */ 