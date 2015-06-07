<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users functionalities.
*/
class Restaurant_model extends CI_Model {

	private $conditions = array();

	private $table = 'restaurants';

	public function __construct()
	{
		parent::__construct();
		if($this->session->type !='Admin')
		{
			$this->conditions = array('owner_id' =>$this->session->uid);
		}
	}

	public function create($address = array(), $restaurant = array())
	{
		try {
			$this->db->trans_start();
			$restaurant['address_id'] = $this->address_model->create($address);

			if ($restaurant['address_id']) {
				
				$this->db->insert($this->table, $restaurant);

				$this->db->trans_complete();
				return true;
			} else {
				$this->db->trans_rollback();
				return FALSE;
			}
			
			
		} catch (Exception $e) {
			$this->db->trans_rollback();
			log_message('error', $e->getMessage());
			return false;
		}
	}

	public function get($limit=20, $offset=0, $conditions=array())
	{
		$this->db->where($conditions);
		$this->db->where($this->conditions);

		return $this->db->get($this->table, $limit, $offset)->result();
	}

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		$this->db->where($this->conditions);

		return $this->db->count_all_results($this->table);
	}

	public function getWithAddress($id)
	{
		$restaurant = $this->find($id);

		if($restaurant){

			$this->db->where('id', $restaurant[0]->address_id);
			$this->db->where($this->conditions);
			$query = $this->db->get('addresses');

			$data['restaurant'] = $restaurant[0];
			$addresses = $query->result();
			$data['addresses']= $addresses[0];
			// echo "<pre>";
			//  print_r($data);
			//  exit();
			return $data;

							
		} else {
			return 0;
		}

	}

	public function find($conditions)
	{
		$this->db->where($this->conditions);
		$query = $this->db->get_where($this->table, $conditions, 1);
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
			return 0;
		}
		
	}

	public function delete($id)
	{
			
			$this->db->trans_start();

			try {
				
				$this->db->where('id',$id);
				$this->db->where($this->conditions);
				if ($this->db->delete($this->table)) {
					foreach ($this->getAddressID($id) as $address) {
						$this->address_model->delete($address->address_id);
					}
					$this->db->trans_complete();
		
					return true;
				}else{
					$this->db->trans_rollback();
				}


			} catch (Exception $e) {
				$this->db->trans_rollback();
				log_message('error', $e->getMessage());
				return false;
			}
	}

	public function getAddressID($id)
	{
		$this->db->select('address_id');

		$query = $this->db->get_where($this->table, array('id' =>$id));

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function getSelect()
	{
		$this->db->select('id,name');
		$this->db->where($this->conditions);

		return $this->db->get($this->table)->result();
	}


	public function update($address = array(), $restaurant = array(), $address_id, $restaurant_id)
	{
		try {

			$this->db->trans_start();
			
			$this->address_model->update($address_id , $address);
			$this->db->where('id', $restaurant_id);	
			$this->db->where($this->conditions);
			$this->db->update($this->table, $restaurant);

			$this->db->trans_complete();
			return true;
		
						
			
		} catch (Exception $e) {
			$this->db->trans_rollback();
			log_message('error', $e->getMessage());
			return false;
		}
	}


}

/* End of file Restaurant_model.php */
/* Location: ./application/models/Restaurant_model.php */ 