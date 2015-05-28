<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*Author@Abu Sayem
*Email@sayem@asteriskbd.com
*Controller for Users functionalities.
*/
class Country_model extends CI_Model {
	private $table = 'country';

	public function get()
	{
		$this->db->order_by('name', 'ASC');
		$query = $this->db->get($this->table);

		return $query->result();
	}
	

}

/* End of file Country_model.php */
/* Location: ./application/models/Country_model.php */ ?>