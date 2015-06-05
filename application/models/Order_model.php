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
		
		$this->db->select('orders.*, users.fullname');
		$this->db->from($this->table);

		$this->db->join('users', 'users.id = orders.user_id', 'left');
		
		$this->db->where($conditions);
		$this->db->order_by('id', 'desc');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */ 