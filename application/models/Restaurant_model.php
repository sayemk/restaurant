<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users functionalities.
*/
class Restaurant_model extends CI_Model {

	private $table = 'restaurants';

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
		 return $this->db->get($this->table, $limit, $offset)->result();
	}

	public function count($conditions=array())
	{
		$this->db->where($conditions);
		return $this->db->count_all_results($this->table);
	}

	public function getWithAddress($id)
	{
		$restaurant = $this->find($id);

		if($restaurant){

			$this->db->where('id', $restaurant[0]->address_id);
			$query = $this->db->get('addresses');

			$data['restaurant'] = $restaurant[0];
			unset($restaurant);
			$data['addresses'] = $query->result();

			return $data;

							
		} else {
			return 0;
		}

	}

	public function find($id)
	{
		$query = $this->db->get_where($this->table, array('id' => $id), 1);
		if ($query->num_rows()==1) {
			return $query->result();
		} else {
			return 0;
		}
		
	}

	public function delete($id)
	{
		
		try {
				$addresses = $this->getAddressID($id);			
				
				$this->db->trans_start();
				try {
					foreach ($addresses as $address) {

						$this->address_model->delete($address->address_id);
					}


				}catch (Exception $e) {
					log_message('debug', $e->getMessage());
				}

				$this->db->where('id',$id);
				$this->db->delete($this->table);

				$this->db->trans_complete();
				
				return true;

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
		return $this->db->get($this->table)->result();
	}


}

/* End of file Restaurant_model.php */
/* Location: ./application/models/Restaurant_model.php */ 