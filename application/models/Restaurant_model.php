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

}

/* End of file Restaurant_model.php */
/* Location: ./application/models/Restaurant_model.php */ 