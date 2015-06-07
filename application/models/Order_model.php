<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

	private $table = 'orders';

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		return $this->db->count_all_results($this->table);
	}

	public function get($limit=20, $offset=0, $conditions=array())
	{
		
		$this->db->select('orders.*, users.fullname, rs.name AS rs_name');
		$this->db->from($this->table);

		$this->db->join('users', 'users.id = orders.user_id', 'left');
		$this->db->join('restaurants rs', 'rs.id = orders.restaurant_id', 'left');
		
		$this->db->where($conditions);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}

	public function getDetails($order_id, $conditions=array())
	{
		$this->db->select('orders.*, addr.name AS addr_name, addr.address_line_1, addr.city,addr.state,
						 addr.zip, addr.country, cus.fullname, rs.name AS rs_name');
		$this->db->from($this->table);

		$this->db->join('users cus', 'cus.id = orders.user_id', 'left');
		$this->db->join('addresses addr', 'addr.id = orders.shipping_address', 'left');
		$this->db->join('restaurants rs', 'rs.id = orders.restaurant_id', 'left');

		$this->db->where($conditions);

		$data['order'] = $this->db->get()->result();

		//order Items
		$this->db->select('om.quantity,om.sub_total, meal.name AS meal_name, rm.price');
		$this->db->from('order_meal om');
		$this->db->join('restaurant_meals rm', 'rm.id = om.restaurant_meal_id', 'left');
		$this->db->join('meals meal', 'meal.id = rm.meal_id', 'left');
		$this->db->where('om.order_id', $conditions['orders.id']);
		
		$data['meals'] = $this->db->get()->result();

		return $data;
	}

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */ 